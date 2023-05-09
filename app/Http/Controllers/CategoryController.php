<?php

namespace App\Http\Controllers;

use App\Http\Integration\Wordpress\WooCommerceIntegration;
use App\Rules\Format\MapFields;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return (new WooCommerceIntegration)->execute('GET', 'products/categories');
    }

    public function cards_categories()
    {
        $categories = $this->index();
        return collect($categories)->reject(function($category) {
            return empty($category->image);
        })->values();
    }

    public function menus_categories()
    {
        $options = [
            'id' => 0,
            'name' => 'TODOS',
            'slug' => 'todos',
            'image' => null
        ];

        $categories = $this->index();
        $categories = collect($categories)->reject(function($category) {
            return empty($category->image);
        })->values();

        return (new MapFields)->execute($categories, ['id', 'name', 'slug', 'image'])->prepend($options);
    }
}