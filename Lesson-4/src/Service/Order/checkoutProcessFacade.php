<?php


namespace Service\Order;


use Service\Billing\BillingInterface;
use Service\Communication\CommunicationInterface;
use Service\Discount\DiscountInterface;
use Service\User\SecurityInterface;

class checkoutProcessFacade
{
    /**
     * Проведение всех этапов заказа
     * @param checkoutFacade $checkout
     * @return void
     * @throws \Service\Billing\Exception\BillingException
     */
    public function checkoutProcess(
        checkoutFacade $checkout
    ): void
    {

        $order = new Order();

        // Вариант 1 использования паттерна строитель
        $order->setProducts($this->getProductsInfo());
        $order->setDiscount($checkout->discount);
        $order->setBilling($checkout->billing);
        $order->setSecurity($checkout->security);
        $order->setCommunication($checkout->communication);
        $order->process();

    }
}