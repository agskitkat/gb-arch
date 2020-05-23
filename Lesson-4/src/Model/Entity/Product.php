<?php

declare(strict_types=1);

namespace Model\Entity;

class Product
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @param int $id
     * @param string $name
     * @param float $price
     */
    public function __construct(int $id = 0, string $name = "Пустой товар", float $price = 0.0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * Создаём магический метод для назначени приватных свойств
     * Ксати, считается ли это антипеттерном ?
     * Вроде же мы прячем свойства, а тут преназначаем.
     * Хотя...
     */
    public function __set ($name, $value) {
        /**
         * Хоят логику назначения переменных можно и тут переопределить
         */
        $this->$name = $value;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
        ];
    }
}
