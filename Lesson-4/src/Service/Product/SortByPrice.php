<?php


namespace Service\Product;


use Model\Entity\Product;

class SortByPrice implements SortIntarface
{
    /**
     * @param Product[] $productList
     * @return Product[]
     */
    function sortProducts(array $productList): Array
    {
        // TODO: Сортируем по цене
        return $productList;
    }
}