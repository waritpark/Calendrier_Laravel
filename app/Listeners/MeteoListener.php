<?php

namespace App\Listeners;

use App\Events\MeteoEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MeteoListener
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
     * @param  MeteoEvent  $event
     * @return void
     */
    public function handle(MeteoEvent $event)
    {
        //
    }
}
