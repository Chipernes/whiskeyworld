<?php

namespace models;

class Cart
{
    public static function addProduct($productId, $count = 1)
    {
        if (!is_array($_SESSION['cart']))
            $_SESSION['cart'] = [];

        $_SESSION['cart'][$productId] += $count;
    }

    public static function deleteProduct($productId)
    {
        unset($_SESSION['cart'][$productId]);

        if (empty($_SESSION['cart']))
            self::resetCart();
    }

    public static function resetCart()
    {
        $_SESSION['cart'] = null;
    }

    public static function getProductsInCart(): ?array
    {
        if (is_array($_SESSION['cart'])) {
            $result = [];
            $products = [];
            $totalPrice = 0;
            foreach ($_SESSION['cart'] as $productId => $count) {
                $product =  Products::getProductById($productId);
                $totalPrice += $product['Price'] * $count;
                $products [] = ['products' => $product, 'count' => $count];
            }

            $result['products'] = $products;
            $result['totalPrice'] = $totalPrice;
            return $result;
        }

        return null;
    }
}