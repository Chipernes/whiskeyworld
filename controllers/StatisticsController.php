<?php

namespace controllers;

use core\Controller;
use models\Categories;
use models\Orders;
use models\Products;

class StatisticsController extends Controller
{
    public function indexAction()
    {
        $orders = Orders::getOrders();
        $products = Products::getAllProduct();
        $categories = Categories::getCategories();
        $totalPriceOfProductsInCategories = Products::getGroupedProduct('CategoryId, SUM(Price * Count) AS TotalCategoryPrice', null, 'CategoryId');

        $tableNames = ['Categories', 'Products', 'OrderItems'];
        $joinFields = ['CategoryId', 'ProductId'];
        $selectedFields = ['Categories.CategoryId', 'Categories.Name', 'SUM(OrderItems.Count)', 'SUM(OrderItems.Price)'];
        $asAliases = ['CategoryId', 'Name', 'TotalCount', 'TotalPrice'];
        $groupBy = ['Categories.CategoryId', 'Categories.Name'];
        $totalPopularity = Categories::getJoinedCategory($tableNames, $joinFields, $selectedFields, $asAliases, $groupBy);


        return $this->render(null,
            [
                'orders' => $orders,
                'products' => $products,
                'categories' => $categories,
                'totalPriceOfProductsInCategories' => $totalPriceOfProductsInCategories,
                'totalPopularity' => $totalPopularity,
            ]);
    }
}