<?php


namespace Service\Product;


use Model\Entity\Product;

interface SortIntarface
{
    /**
     * Метод интерфейса, отвечающий за получение результата сортировки
     *
     * @param array $productList
     * @return Product[]
     */
    function sortProducts(Array $productList): Array;
}