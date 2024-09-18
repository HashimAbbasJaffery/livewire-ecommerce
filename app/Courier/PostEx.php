<?php

namespace App\Courier;
use App\Services\Interface\CourierService;
use Illuminate\Support\Facades\Http;

class PostEx implements CourierService
{
    /**
     * Create a new class instance.
     */
    protected $endpoint = "https://api.postex.pk/services/integration/api/order";
    protected $key;
    public function __construct($key)
    {
        $this->key = $key;
    }

    public function createOrder() {

    }
    public function generateLoadsheet() {

    }
    public function getCities($version = "v2") {

        $response = cache()->remember("cities", 86400, function() use ($version){
            return Http::withHeader("token", $this->key)
                        ->get("{$this->endpoint}/{$version}/get-operational-city")
                        ->json();
        });
        return $response;
    }
    public function track() {

    }
}
