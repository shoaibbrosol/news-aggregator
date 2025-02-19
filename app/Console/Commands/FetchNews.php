<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NewsFetcherService;

class FetchNews extends Command
{
    protected $signature = 'news:fetch';
    protected $description = 'Fetch news articles from different sources';

    public function handle(NewsFetcherService $newsFetcher)
    {
        $newsFetcher->fetchAndStore();
        $this->info('News articles fetched successfully!');
    }
}
