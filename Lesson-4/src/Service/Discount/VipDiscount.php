<?php

declare(strict_types = 1);

namespace Service\Discount;

use Model\Entity\User;

class VipDiscount implements DiscountInterface
{
    /**
     * @var string
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Этот конкретный класс реализует интерфейс шаблона с единственным методом
     * @inheritdoc
     */
    public function getDiscount(): float
    {
        // Получаем индивидуальную скидку VIP пользователя
        // $discount = $this->find($this->user)->discount();
        $discount = 20;

        return $discount;
    }
}
