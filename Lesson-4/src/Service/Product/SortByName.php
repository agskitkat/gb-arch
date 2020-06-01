<?php


namespace Service\Product;


use Model\Entity\Product;

class SortByName implements SortIntarface
{
    /**
     * @param Product[] $productList
     * @return Product[]
     */
    function sortProducts(array $productList): Array
    {
        // TODO: Сортируем по имени
        return $productList;
    }
}