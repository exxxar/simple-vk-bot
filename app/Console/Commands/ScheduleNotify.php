<?php

namespace App\Console\Commands;

use App\Events\VKBotEvent;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ScheduleNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send schedule list to VK ChatBot';

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
        event(new VKBotEvent("Current time: ".Carbon::now("+3:00"), 2000000001));
        $list = \App\ClassCallList::all();
        foreach ($list as $item) {
            $item = (object)$item;
            $start_at = Carbon::parse($item->start_at)->setTimezone("+3:00");
            $end_at = Carbon::parse($item->end_at)->setTimezone("+3:00");


            if (Carbon::now("+3:00") <= $start_at && Carbon::now("+3:00") <= $end_at)
                event(new VKBotEvent("#$item->index [$item->start_at - $item->end_at] $item->title ", 2000000001));
            else
                event(new VKBotEvent("пара еще не началась", 2000000001));

        }

        //event(new VKBotEvent("index method", 2000000001));
        return 0;
    }
}
