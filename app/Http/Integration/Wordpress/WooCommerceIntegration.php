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
            'POST' => $this->post($endpoint, $data),
            'PUT' => $this->put($endpoint, $data),
            'GET' => $this->get($endpoint, $params),
            'DELETE' => $this->delete($endpoint, $params),
            'OPTIONS' => $this->options($endpoint)
        };
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

    private function get($endpoint, $params)
    {
        $response = $this->woocommerce->get($endpoint, $params);
        return $response;
    }

    private function delete($endpoint, $params)
    {
        $response = $this->woocommerce->delete($endpoint, $params);
        return $response;
    }

    private function options($endpoint)
    {
        $response = $this->woocommerce->options($endpoint);
        return $response;
    }
}