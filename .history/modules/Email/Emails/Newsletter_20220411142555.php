<?php

    namespace Modules\Email\Emails;

    use App\User;
    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    class Newsletter extends Mailable
    {
        use Queueable, SerializesModels;


        public function __construct()
        {

        }

        public function build()
        {
            $subject = 'Email testing';
            return $this->subject($subject)->view('Email::emails.test');
        }
    }
