<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class newRequestPosted extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    /**
     * newRequestPosted constructor.
     *
     * @param $data - данные о запросе передаваемые в текст письма
     * @return void
     */

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.newrequest', $this->data);
    }
}
