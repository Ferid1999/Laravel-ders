<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\users;

class kullanicikayitmail extends Mailable
{
    use Queueable, SerializesModels;
    public $kullanici;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(users $kullanici)
    {
        $this->kullanici=$kullanici;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(config('app.name') . ' - Kullanici kaydi')->view('mails.kullanici_kayit');
    }
}
