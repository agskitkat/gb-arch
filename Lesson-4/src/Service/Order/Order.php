<?php


namespace Service\Order;


use Model\Repository\ProductRepository;
use Service\Billing\BillingInterface;
use Service\Communication\CommunicationInterface;
use Service\Discount\DiscountInterface;
use Service\User\SecurityInterface;

/**
 * Класс с паттерном строитель,
 * Логика как набросок, в данном случае можно долго очень улучшать.
 * Class Order
 * @package Service\Order
 */
class Order
{

    private $discount;
    /**
     * @var BillingInterface
     */
    private $billing;
    /**
     * @var SecurityInterface
     */
    private $security;
    /**
     * @var CommunicationInterface
     */
    private $communication;

    private $totalPrice = 0;
    /**
     * @var array
     */
    private $products;

    /**
     * @param array $products
     * @return Order
     */
    public function setProducts(Array $products):Order {
        $this->products = $products;

        foreach ($this->products as $product) {
            $this->totalPrice += $product->getPrice();
        }

        return $this;
    }

    /**
     * @param DiscountInterface $discount
     * @return Order
     */
    public function setDiscount(DiscountInterface $discount):Order {
        $this->discount = $discount;

        $discountValue =  $this->discount->getDiscount();
        $this->totalPrice = $this->totalPrice - $this->totalPrice / 100 * $discountValue;

        return $this;
    }

    /**
     * @param BillingInterface $billing
     * @return Order
     * @throws \Service\Billing\Exception\BillingException
     */
    public function setBilling(BillingInterface $billing):Order {
        $this->billing = $billing;

        $this->billing->pay($this->totalPrice);

        return $this;
    }

    /**
     * @param SecurityInterface $security
     * @return Order
     */
    public function setSecurity(SecurityInterface $security):Order {
        $this->security = $security;
        return $this;
    }

    /**
     * @param CommunicationInterface $communication
     * @return Order
     */
    public function setCommunication(CommunicationInterface $communication):Order {
        $this->communication = $communication;
        return $this;
    }

    public function process() {
        $user = $this->security->getUser();
        $this->communication->process($user, 'checkout_template');
    }
}