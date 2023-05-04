<?php

namespace App\Http\Controllers;

use App\Http\Integration\Wordpress\WooCommerceIntegration;
use App\Http\Integration\Wordpress\WordpressIntegration;
use App\Rules\Media\GetMedia;

class AttributeController extends Controller
{
    public function index()
    {
        $woocommerce = (new WooCommerceIntegration)->execute('GET', 'products/attributes');

        $attributes = collect($woocommerce);

        $response = $attributes->map(function ($atribute) {
            return [
                'id' => $atribute->id,
                'name' => $atribute->name,
                'slug' => $atribute->slug,
                'image' => $atribute->image->src ?? null
            ];
        });
        
        return $response;
    }

    public function terms()
    {
        $terms = (new WordpressIntegration)->execute('GET', 'product_marca');

        $terms = collect($terms)->map(function ($term) {
            return [
                'id' => $term->id,
                'description' => $term->description,
                'name' => $term->name,
                'slug' => $term->slug,
                'image' => (new GetMedia)->execute($term->acf->image),
            ];
        });
    
        return $terms;
    }
}
