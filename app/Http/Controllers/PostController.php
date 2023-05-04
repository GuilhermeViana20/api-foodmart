<?php

namespace App\Http\Controllers;

use App\Http\Integration\Wordpress\WordpressIntegration;
use App\Rules\Media\GetMedia;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $posts = collect((new WordpressIntegration)->execute('GET', 'posts'));

        $response = $posts->map(function ($post) {
            $return['id'] = $post->id;
            $return['title'] = $post->title->rendered;
            $return['slug'] = $post->slug;
            $return['image'] = (new GetMedia)->execute($post->featured_media);
            $return['description'] = $post->content->rendered;
            $return['date'] = Carbon::parse($post->date)->isoFormat('DD MMM, YYYY');
            $return['time'] = $post->acf->minutes;
            return $return;
        });

        return $response;
    }
}
