<?php

namespace App;

use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_NEW = 0;
    const STATUS_APPROVE = 10;
    const STATUS_COMPLETE = 20;

    static $statusList = [
        self::STATUS_NEW => 'Новый',
        self::STATUS_APPROVE => 'Подтвержден',
        self::STATUS_COMPLETE => 'Завершен'
    ];

    public function partner()
    {
        return $this->belongsTo('App\Partner', 'partner_id', 'id');
    }

    public function getStatusName()
    {
        $result = '';
        if (isset(static::$statusList[$this->status])) {
            $result = static::$statusList[$this->status];
        }
        return $result;
    }
}
