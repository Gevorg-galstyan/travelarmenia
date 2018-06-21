<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderExcursion extends Mailable
{
    use Queueable, SerializesModels;
    protected $data_price;
    protected $excursion;
    protected $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_price, $excursion, $request)
    {
        $this->data_price = $data_price;
        $this->excursion = $excursion;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data_price = $this->data_price;
        $excursion = $this->excursion;
        $request = $this->request;
        return $this->from(config('mail.from.address'))->markdown('emails.orders.excursion', compact('data_price','excursion','request'));
    }
}
