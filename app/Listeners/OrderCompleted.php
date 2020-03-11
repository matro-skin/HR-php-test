<?php

namespace App\Listeners;

use App\Events\OrderCompleted as Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use Mockery\Exception;

class OrderCompleted
{

	protected $order;

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
     * @param  Event  $event
     * @return void
     */
    public function handle(Event $event)
    {
    	$this->order = $event->order;
    	$this->send_notifications();
    }

    protected function send_notifications()
    {

	    $partner = $this->order->partner;
	    $vendors = $this->order->products->map(function ($product) {
		    return $product->vendor;
	    });

	    $recipients = collect([ $partner ])->merge( $vendors );

	    if( $recipients->isEmpty() ) {
	    	return;
	    }

	    try {
		    Notification::send( $recipients, new \App\Notifications\OrderCompleted( $this->order ) );
	    }
	    catch (Exception $e) {
	    	report($e);
	    }

    }

}
