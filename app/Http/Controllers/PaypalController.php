<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPalServerSdk\{Environment, PayPalServerSdkClient};
use PayPalServerSdk\Authentication\ClientCredentialsAuthCredentialsBuilder;
use PayPalServerSdk\Models\Builders\{AmountWithBreakdownBuilder, OrderRequestBuilder, PurchaseUnitBuilder};

class PaypalController extends Controller
{
    private $client;

    public function __construct()
    {
        // Initialize the PayPal Client
        $this->client = new PayPalServerSdkClient([
            'clientCredentialsAuthCredentials' => ClientCredentialsAuthCredentialsBuilder::init(
                env('PAYPAL_CLIENT_ID'),
                env('PAYPAL_CLIENT_SECRET')
            ),
            'environment' => Environment::SANDBOX, // Change to Environment::PRODUCTION for live
        ]);
    }

    public function createOrder(Request $request)
    {
        $orderRequest = OrderRequestBuilder::init('CAPTURE')
            ->purchaseUnits([
                PurchaseUnitBuilder::init(
                    AmountWithBreakdownBuilder::init('USD', '19.00')->build() // Price is set on server
                )->build()
            ])->build();

        try {
            $response = $this->client->getOrdersController()->ordersCreate($orderRequest);
            return response()->json($response->getResult());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function captureOrder(Request $request)
    {
        $orderId = $request->orderID;

        try {
            $response = $this->client->getOrdersController()->ordersCapture($orderId);
            $result = $response->getResult();

            if ($result->status === 'COMPLETED') {
                // SUCCESS: Upgrade the user
                auth()->user()->update(['plan' => 'premium']);
                
                return response()->json(['status' => 'success']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}