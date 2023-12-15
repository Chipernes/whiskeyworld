<?php

namespace controllers;

use core\Controller;
use models\Categories;
use models\Orders;
use models\Products;
use models\User;

class StatisticsController extends Controller
{
    public function indexAction()
    {
        $orders = Orders::getOrders();
        $groupedOrdersByDateAndPrice = Orders::getGroupedOrdersByDateAndPrice();
        $products = Products::getAllProduct();
        $categories = Categories::getCategories();
        $totalPriceOfProductsInCategories = Products::getGroupedProduct('CategoryId, SUM(Price * Count) AS TotalCategoryPrice', null, 'CategoryId');
        $totalCountOfProductsInCategories = Products::getGroupedProduct('CategoryId, SUM(Count) AS TotalCategoryCount', null, 'CategoryId');

        $tableNames = ['Categories', 'Products', 'OrderItems'];
        $joinFields = ['CategoryId', 'ProductId'];
        $selectedFields = ['Categories.CategoryId', 'Categories.Name', 'SUM(OrderItems.Count)', 'SUM(OrderItems.Price)'];
        $asAliases = ['CategoryId', 'Name', 'TotalCount', 'TotalPrice'];
        $groupBy = ['Categories.CategoryId', 'Categories.Name'];
        $totalPopularity = Categories::getJoinedCategory($tableNames, $joinFields, $selectedFields, $asAliases, $groupBy);

        $userGenders = User::getGroupedGenders();
        $ordersStatuses = Orders::getGroupedOrderStatuses();

        return $this->render(null,
            [
                'orders' => $orders,
                'groupedOrdersByDateAndPrice' => $groupedOrdersByDateAndPrice,
                'products' => $products,
                'categories' => $categories,
                'totalPriceOfProductsInCategories' => $totalPriceOfProductsInCategories,
                'totalCountOfProductsInCategories' => $totalCountOfProductsInCategories,
                'totalPopularity' => $totalPopularity,
                'userGenders' => $userGenders,
                'ordersStatuses' => $ordersStatuses,
            ]);
    }
}