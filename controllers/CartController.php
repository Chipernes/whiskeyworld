<?php

namespace controllers;

use core\Controller;
use models\Cart;

class CartController extends Controller
{
    public function indexAction()
    {
        $cart = Cart::getProductsInCart();
        return $this->render(null,
            [
                'cart' => $cart
            ]);
    }
}