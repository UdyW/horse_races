<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunDataPump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'datapump:horse_racing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Command to import data from a source
     *
     * @return int
     */
    public function handle()
    {
        $this->dataTransferService = new \App\DataPump\DataTransferService(
            'xml',
            'horse_racing',
            base_path('public/PA_horse_feed.xml')
        );

        $this->dataTransferService->storeData();

        return 0;
    }
}
