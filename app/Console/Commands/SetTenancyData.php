<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Gateway;
use App\Models\GatewayCurrency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SetTenancyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set-tenancy-data {--tenant=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            $tenantId = $this->option('tenant');

            $gatewaysData = [
                ['title' => 'Paypal', 'slug' => 'paypal', 'image' => 'assets/images/gateway-icon/paypal.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
                ['title' => 'Stripe', 'slug' => 'stripe', 'image' => 'assets/images/gateway-icon/stripe.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
                ['title' => 'Razorpay', 'slug' => 'razorpay', 'image' => 'assets/images/gateway-icon/razorpay.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'INR', 'conversion_rate' => 80.00]]],
                ['title' => 'Instamojo', 'slug' => 'instamojo', 'image' => 'assets/images/gateway-icon/instamojo.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'INR', 'conversion_rate' => 80.00]]],
                ['title' => 'Mollie', 'slug' => 'mollie', 'image' => 'assets/images/gateway-icon/mollie.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
                ['title' => 'Paystack', 'slug' => 'paystack', 'image' => 'assets/images/gateway-icon/paystack.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'NGN', 'conversion_rate' => 464.00]]],
                ['title' => 'Sslcommerz', 'slug' => 'sslcommerz', 'image' => 'assets/images/gateway-icon/sslcommerz.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'BDT', 'conversion_rate' => 100.00]]],
                ['title' => 'Flutterwave', 'slug' => 'flutterwave', 'image' => 'assets/images/gateway-icon/flutterwave.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'NGN', 'conversion_rate' => 464.00]]],
                ['title' => 'Mercadopago', 'slug' => 'mercadopago', 'image' => 'assets/images/gateway-icon/mercadopago.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'BRL', 'conversion_rate' => 5.00]]],
                ['title' => 'Bank', 'slug' => 'bank', 'image' => 'assets/images/gateway-icon/bank.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
            ];

            $gatewayCurrenciesData = [
                // Gateway 1 (Paypal) Currencies
                [['currency' => 'USD', 'conversion_rate' => 1.00]],

                // Gateway 2 (Stripe) Currencies
                [['currency' => 'USD', 'conversion_rate' => 1.00]],

                // Gateway 3 (Razorpay) Currencies
                [['currency' => 'INR', 'conversion_rate' => 80.00]],

                // Gateway 4 (Instamojo) Currencies
                [['currency' => 'INR', 'conversion_rate' => 80.00]],

                // Gateway 5 (Mollie) Currencies
                [['currency' => 'USD', 'conversion_rate' => 1.00]],

                // Gateway 6 (Paystack) Currencies
                [['currency' => 'NGN', 'conversion_rate' => 464.00]],

                // Gateway 7 (Sslcommerz) Currencies
                [['currency' => 'BDT', 'conversion_rate' => 100.00]],

                // Gateway 8 (Flutterwave) Currencies
                [['currency' => 'NGN', 'conversion_rate' => 464.00]],

                // Gateway 9 (Mercadopago) Currencies
                [['currency' => 'BRL', 'conversion_rate' => 5.00]],

                // Gateway 10 (Bank) Currencies
                [['currency' => 'USD', 'conversion_rate' => 1.00]]
            ];


            foreach ($gatewaysData as $index => $gatewayData) {
                // Create the gateway with the tenant ID
                $createdGateway = Gateway::create(array_merge($gatewayData, ['tenant_id' => $tenantId]));

                // Insert each currency for this gateway
                foreach ($gatewayCurrenciesData[$index] as $currencyData) {
                    GatewayCurrency::create(array_merge($currencyData, ['gateway_id' => $createdGateway->id]));
                }
            }

            $currenciesData = [
                ['currency_code' => 'USD', 'symbol' => '$', 'currency_placement' => 'before', 'current_currency' => 1],
                ['currency_code' => 'BDT', 'symbol' => '৳', 'currency_placement' => 'before', 'current_currency' => 0],
                ['currency_code' => 'INR', 'symbol' => '₹', 'currency_placement' => 'before', 'current_currency' => 0],
                ['currency_code' => 'GBP', 'symbol' => '£', 'currency_placement' => 'after', 'current_currency' => 0],
                ['currency_code' => 'MXN', 'symbol' => '$', 'currency_placement' => 'before', 'current_currency' => 0],
                ['currency_code' => 'SAR', 'symbol' => 'SR', 'currency_placement' => 'before', 'current_currency' => 0]
            ];

            foreach ($currenciesData as $currencyData) {
                Currency::create(array_merge($currencyData, ['tenant_id' => $tenantId]));
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage() . $exception->getFile() . $exception->getLine());
            return false;
        }

        return true;
    }
}
