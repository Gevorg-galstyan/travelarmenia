<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderTour extends Mailable
{
    use Queueable, SerializesModels;
    protected $data_price;
    protected $data;
    protected $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_price, $data, $request)
    {
        $this->data_price = $data_price;
        $this->data = $data;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.orders.tour')->with($this->data_price, $this->data, $this->request);
    }
}
