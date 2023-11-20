<?php

namespace controllers;

use core\Controller;
use core\Core;
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

    public function addAction($params)
    {
        $id = intval($params[0]);
        Cart::addProduct($id);
        $this->redirect('/cart');
    }

    public function deleteAction($params)
    {
        $id = intval($params[0]);
        Cart::deleteProduct($id);
        $this->redirect('/cart');
    }
}