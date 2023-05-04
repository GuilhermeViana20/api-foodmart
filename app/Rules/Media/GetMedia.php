<?php

namespace App\Rules\Media;

use App\Http\Integration\Wordpress\WordpressIntegration;

class GetMedia
{
    public function execute($id)
    {
        $media = (new WordpressIntegration)->execute('GET', "medias/{$id}");
        return $media->guid->rendered;
    }
}
