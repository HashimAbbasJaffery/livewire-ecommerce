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

    public function createOrder(array $order, $version = "v3") {
        $response = Http::withHeader("token", $this->key)
                        ->post("{$this->endpoint}/{$version}/create-order", [
                            "orderRefNumber" => "REF-" . $order["ref"],
                            "invoicePayment" => $order["price"],
                            "customerName" => $order["name"],
                            "customerPhone" => $order["phone"],
                            "deliveryAddress" => $order["email"],
                            "transactionNotes" => $order["order_notes"] ?? null,
                            "cityName" => $order["city"],
                            "invoiceDivision" => 0,
                            "items" => $order["items_count"],
                            "orderType" => "Normal",
                            "pickupAddressCode" => "001"
                        ])
                        ->json();
        return $response;
    }
    public function generateLoadsheet() {

    }
    public function getCities($version = "v2")  {

        $response = cache()->remember("cities", 86400, function() use ($version){
            return Http::withHeader("token", $this->key)
                        ->get("{$this->endpoint}/{$version}/get-operational-city")
                        ->json();
        });
        return $response;
    }
    public function track($tracking_number, $version = "v1") {
        $response = Http::withHeader("token", $this->key)
                        ->get("{$this->endpoint}/{$version}/track-order/{$tracking_number}")
                        ->json();
        return $response;
    }
}
