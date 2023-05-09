<?php

namespace App\Http\Controllers;

use App\Http\Integration\Wordpress\WooCommerceIntegration;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->query('categoryId');
        $params = [];

        if ($categoryId != 0) {
            $params = [
                'category' => $categoryId,
            ];
        }

        $products = collect((new WooCommerceIntegration)->execute('GET', 'products', $params));

        return $products;
    }
}
