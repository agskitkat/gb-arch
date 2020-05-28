<?php

declare(strict_types=1);

namespace Model\Repository;

use Model\Entity\Product;

/**
 *  Паттерн фабричный метод применён для класса ProductRepository.
 *  Смею предположить, что в данном случае паттерн исрользуется
 *  для возможности добавить источники продуктов.
 */
class ProductRepository
{
    /**
     * Поиск продуктов по массиву id
     * @param int[] $ids
     * @return ProductRepository[]
     */
    public function search(array $ids = []): array
    {
        if (!count($ids)) {
            return [];
        }

        // Создаём пустышку
        $product = new Product();

        $productList = [];
        foreach ($this->getDataFromSource(['id' => $ids]) as $item) {

            // Клонируем пустышку
            $cloneProduct = clone $product;

            // Назначаем свойства
            $cloneProduct->id =  $item['id'];
            $cloneProduct->name =  $item['name'];
            $cloneProduct->price =  $item['price'];

            $productList[] = $cloneProduct;
        }

        return $productList;
    }

    /**
     * Получаем все продукты
     * @return ProductRepository[]
     */
    public function fetchAll(): array
    {
        $product = new Product();

        $productList = [];
        foreach ($this->getDataFromSource() as $item) {
            $cloneProduct = clone $product;

            $cloneProduct->id =  $item['id'];
            $cloneProduct->name =  $item['name'];
            $cloneProduct->price =  $item['price'];

            $productList[] = $cloneProduct;
        }

        return $productList;
    }

    /**
     * Получаем продукты из источника данных
     * @param array $search
     * @return array
     */
    private function getDataFromSource(array $search = []): array
    {
        $dataSource = [
            [
                'id' => 1,
                'name' => 'PHP',
                'price' => 15300,
            ],
            [
                'id' => 2,
                'name' => 'Python',
                'price' => 20400,
            ],
            [
                'id' => 3,
                'name' => 'C#',
                'price' => 30100,
            ],
            [
                'id' => 4,
                'name' => 'Java',
                'price' => 30600,
            ],
            [
                'id' => 5,
                'name' => 'Ruby',
                'price' => 18600,
            ],
            [
                'id' => 8,
                'name' => 'Delphi',
                'price' => 8400,
            ],
            [
                'id' => 9,
                'name' => 'C++',
                'price' => 19300,
            ],
            [
                'id' => 10,
                'name' => 'C',
                'price' => 12800,
            ],
            [
                'id' => 11,
                'name' => 'Lua',
                'price' => 5000,
            ],
        ];

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return in_array($dataSource[key($search)], current($search), true);
        };

        return array_filter($dataSource, $productFilter);
    }
}
