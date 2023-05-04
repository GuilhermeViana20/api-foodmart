<?php

namespace App\Http\Controllers;

use App\Http\Integration\Wordpress\WooCommerceIntegration;

class ProductController extends Controller
{
    public function index()
    {
        $woocommerce = (new WooCommerceIntegration)->execute('GET', 'products');

        $products = collect($woocommerce);

        $response = $products->map(function ($product) {
            $product->id = $product->id;
            $product->name = $product->name;
            $product->slug = $product->slug;
            $product->image = $product->image->src;
            return $product;
        });
        
        return $response;
    }
}
