<?php

namespace App\Http\Integration\Wordpress;

use Automattic\WooCommerce\Client;

class WooCommerceIntegration
{
    protected $woocommerce;

    public function __construct()
    {
        $this->woocommerce = new Client(
            env('WOOCOMMERCE_STORE_URL'),
            env('WOOCOMMERCE_CONSUMER_KEY'),
            env('WOOCOMMERCE_CONSUMER_SECRET'),
            [
                'wp_api' => true,
                'version' => 'wc/v3',
                'verify_ssl' => false,
            ]
        );
    }

    public function execute($type, $endpoint, $params = [], $data = [])
    {
        return match ($type) {
            'GET' => $this->get($endpoint, $params),
            'POST' => $this->post($endpoint, $data),
            'PUT' => $this->put($endpoint, $data),
            'DELETE' => $this->delete($endpoint)
        };
    }

    private function get($endpoint)
    {
        $response = $this->woocommerce->get($endpoint, $params);
        return $response;
    }

    private function post($endpoint, $data)
    {
        $response = $this->woocommerce->post($endpoint, $data);
        return $response;
    }

    private function put($endpoint, $data)
    {
        $response = $this->woocommerce->put($endpoint, $data);
        return $response;
    }

    private function delete($endpoint)
    {
        $response = $this->woocommerce->delete($endpoint);
        return $response;
    }
}