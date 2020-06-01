<?php

declare(strict_types = 1);

namespace Service\Discount;

class NullObject implements DiscountInterface
{
    /**
     * Этот конкретный класс реализует интерфейс шаблона с единственным методом
     * @inheritdoc
     */
    public function getDiscount(): float
    {
        // Скидка отсутствует
        return 0;
    }
}
