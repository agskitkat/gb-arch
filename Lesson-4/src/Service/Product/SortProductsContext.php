<?php


namespace Service\Product;

use Model\Entity\Product;

/**
 * Контекст стратегии
 *
 * Class SortProductsContext
 * @package Service\Product
 */
class SortProductsContext
{
    private $sort;

    /**
     * SortProductsContext constructor.
     * @param SortIntarface $sort
     */
    public function __construct(SortIntarface $sort)
    {
        $this->sort = $sort;
    }

    /**
     * "Горячая" замена сортировки
     *
     * @param SortIntarface $sort
     */
    public function setSort(SortIntarface $sort)
    {
        $this->sort = $sort;
    }

    /**
     * Выполняет сортировку по заднной стратегии
     *
     * @param Product[] $productList
     * @return Product[]
     */
    public function doSort(Array $productList): Array
    {
        return $this->sort->sortProducts($productList);
    }
}