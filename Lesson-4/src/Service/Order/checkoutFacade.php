<?php


namespace Service\Order;


use Service\Billing\Transfer\Card;
use Service\Communication\Sender\Email;
use Service\Discount\NullObject;
use Service\User\Security;

class checkoutFacade
{
    private $session;
    /**
     * @var Card
     */
    private $billing;
    /**
     * @var NullObject
     */
    private $discount;
    /**
     * @var Email
     */
    private $communication;
    /**
     * @var Security
     */
    private $security;

    public function checkout() {
        // Здесь должна быть некоторая логика выбора способа платежа
        $this->billing = new Card();

        // Здесь должна быть некоторая логика получения информации о скидке
        // пользователя
        $this->discount = new NullObject();

        // Здесь должна быть некоторая логика получения способа уведомления
        // пользователя о покупке
        $this->communication = new Email();

        $this->security = new Security($this->session);

        return $this;
    }



    function __get($name)
    {
        return $this->$name;
    }

}