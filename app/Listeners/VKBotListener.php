<?php

namespace App\Listeners;

use App\Events\VKBotEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use VK\Client\VKApiClient;

class VKBotListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(VKBotEvent $event)
    {
        if (is_null($event))
            return;

        $access_token = env("VK_SECRET_KEY");
        $vk = new VKApiClient();
        $vk->messages()->send($access_token, [
            'peer_id' => $event->chatId ?? "14054379",
            'message' => $event->message,
            'random_id' => random_int(0, 10000000000),

        ]);

        //
    }
}
