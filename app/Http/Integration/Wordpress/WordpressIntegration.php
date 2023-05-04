<?php

namespace App\Http\Integration\Wordpress;

use Automattic\WooCommerce\Client;

class WordpressIntegration
{
    protected $wordpress;

    public function __construct()
    {
        $this->wordpress = new Client(
            env('WOOCOMMERCE_STORE_URL'),
            env('WOOCOMMERCE_CONSUMER_KEY'),
            env('WOOCOMMERCE_CONSUMER_SECRET'),
            [
                'wp_api' => true,
                'version' => 'wp/v2',
                'verify_ssl' => false,
            ]
        );
    }

    public function execute($type, $endpoint, $data = [])
    {
        return match ($type) {
            'GET' => $this->get($endpoint),
            'POST' => $this->post($endpoint, $data),
            'PUT' => $this->put($endpoint, $data),
            'DELETE' => $this->delete($endpoint)
        };
    }

    private function get($endpoint)
    {
        $response = $this->wordpress->get($endpoint);
        return $response;
    }

    private function post($endpoint, $data)
    {
        $response = $this->wordpress->post($endpoint, $data);
        return $response;
    }

    private function put($endpoint, $data)
    {
        $response = $this->wordpress->put($endpoint, $data);
        return $response;
    }

    private function delete($endpoint)
    {
        $response = $this->wordpress->delete($endpoint);
        return $response;
    }
}