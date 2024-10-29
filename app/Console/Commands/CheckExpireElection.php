<?php

namespace App\Console\Commands;

use DateTime;
use App\Models\Election;
use Illuminate\Console\Command;

class CheckExpireElection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkExpire:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to check if the election date is expire';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        info("Running the job that check if election is expired" . now());
        Election::all()->filter(function ($item) {
            return $this->checkExpiredElections($item->close_date);
        })->values()->toQuery()->update(["status" => Election::CLOSE]);
        return 0;
    }

    public function checkExpiredElections($closeDate)
    {
        $today = (new DateTime())->format('Y-m-d'); //use format whatever you are using
        $expiry = (new DateTime($closeDate))->format('Y-m-d');
        return strtotime($today) > strtotime($expiry);
    }
}


 //false or true