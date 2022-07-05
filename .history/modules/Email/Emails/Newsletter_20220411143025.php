<?php

    namespace Modules\Email\Emails;

    use App\User;
    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    class Newsletter extends Mailable
    {
        use Queueable, SerializesModels;
        /**
         * Create a new message instance.
         *
         * @return void
         */
        public $array;

        public function __construct($array)
        {
            $this->array = $array;
        }
        /**
         * Build the message.
         *
         * @return $this
         */
        public function build()
        {
            return $this->view($this->array['view'])
                        ->from($this->array['from'],  env('MAIL_FROM_NAME'))
                        ->subject($this->array['subject']);
        }
    }
