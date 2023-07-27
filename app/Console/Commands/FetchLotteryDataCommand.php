<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Livewire\FetchLotteryData;

class FetchLotteryDataCommand extends Command
{
    protected $signature = 'fetch:lottery-data';

    protected $description = 'Fetch lottery data from the API';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $component = new FetchLotteryData();
        $component->fetchLotteryData();

        $this->info('Lottery data fetched successfully.');
    }
    
}

