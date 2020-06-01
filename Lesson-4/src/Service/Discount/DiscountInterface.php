<?php

declare(strict_types = 1);

namespace Service\Discount;

/**
 * Как мне кажется, это Интерфейс шаблонного метода
 * подклассы реализовывают конкретные шаги этого алгоритма
 *
 * Interface DiscountInterface
 * @package Service\Discount
 */
interface DiscountInterface
{
    /**
     * Определяет метод шаблона. Один единственный "шаг".
     *
     * Получаем скидку в процентах
     * @return float
     */
    public function getDiscount(): float;
}
