<?php

namespace App\Console\Commands;

use App\Mail;
use Illuminate\Console\Command;
use MailSender;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправка почты.';

    /**
     * @var MailSender
     */
    protected $sender;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MailSender $sender)
    {
        parent::__construct();

        $this->sender = $sender;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $models = Mail::where(['status' => Mail::STATUS_NEW])->get();
        foreach ($models as $model) {
            $this->sender->sendEmailOrder($model);
        }
    }
}