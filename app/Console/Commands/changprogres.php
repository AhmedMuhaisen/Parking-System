<?php

namespace App\Console\Commands;

use App\Events\NewSystemNotification;
use App\Events\notification;
use Illuminate\Console\Command;

class changprogres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:progress {--progress=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $progress=$this->option('progress');
        broadcast(new NewSystemNotification($progress,'success'));
    }
}
