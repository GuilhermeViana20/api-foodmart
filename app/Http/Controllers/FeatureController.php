<?php

namespace App\Http\Controllers;

use App\Http\Integration\Wordpress\WordpressIntegration;
use App\Rules\Media\GetMedia;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $features = collect((new WordpressIntegration)->execute('GET', 'features'));

        $response = $features->map(function ($feature) {
            $return['id'] = $feature->id;
            $return['title'] = $feature->title->rendered;
            $return['slug'] = $feature->slug;
            $return['image'] = (new GetMedia)->execute($feature->featured_media);
            $return['description'] = $feature->content->rendered;
            return $return;
        });

        return $response;
    }
}
