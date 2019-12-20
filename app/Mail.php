<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mail
 * @property int $id
 * @property string $email
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @package App
 */
class Mail extends Model
{
    const STATUS_NEW = 0;
    const STATUS_COMPLETE = 10;

    static $statusList = [
        self::STATUS_NEW => 'В очереди',
        self::STATUS_COMPLETE => 'Отправлено'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderProduct()
    {
        return $this->belongsTo('App\OrderProduct', 'order_product_id', 'id');
    }
}