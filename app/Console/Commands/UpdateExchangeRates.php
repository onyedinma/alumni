<?php

namespace App\Console\Commands;

use App\Services\ExchangeRateService;
use Illuminate\Console\Command;

class UpdateExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'rates:update';

    /**
     * The console command description.
     */
    protected $description = 'Update exchange rates from external API for all gateway currencies';

    /**
     * Execute the console command.
     */
    public function handle(ExchangeRateService $exchangeRateService)
    {
        $this->info('Fetching latest exchange rates...');

        $result = $exchangeRateService->updateGatewayCurrencies();

        if ($result['success']) {
            $this->info("✓ {$result['message']}");

            if (isset($result['rates'])) {
                $this->table(
                    ['Currency', 'Rate'],
                    collect($result['rates'])
                        ->take(10)
                        ->map(fn($rate, $currency) => [$currency, number_format($rate, 4)])
                        ->toArray()
                );
            }

            return self::SUCCESS;
        }

        $this->error("✗ {$result['message']}");
        return self::FAILURE;
    }
}
