<?php

namespace App\Helpers;

use Mail;

/**
 * Class Mail
 * @package App\Helpers
 */
class MailSender {
    public static function add(string $email, int $orderProductId) {
        $model = new \App\Mail();
        $model->email = $email;
        $model->order_product_id = $orderProductId;
        $model->save();
    }

    public static function sendEmailOrder($model) {
        Mail::send(['text' => 'mail'], [
            'id' => $model->order_product_id,
            'product' => $model->orderProduct->product,
        ], function ($message) use ($model) {
            $message->from(env('MAIL_USERNAME'), 'Отправка письма');
            $message->to($model->email, 'Заказ завершен')->subject('Заказ завершен');
        });
        $model->status = \App\Mail::STATUS_COMPLETE;
        $model->save();
    }
}