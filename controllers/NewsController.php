<?php

namespace controllers;

use core\Controller;

class NewsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction() {
        return $this->render(null, [
            'title' => 'News list',
            'text' => 'Just a text'
        ]);
    }

    public function viewAction() {
        return $this->render();
    }
}