<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends BaseController
{
    public function __construct()
    {
        $this->classe = Product::class;
    }
}
