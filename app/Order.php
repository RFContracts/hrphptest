<?php

namespace App;

use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @property int $id
 * @property int $status
 * @property string $client_email
 * @property int $partner_id
 * @property string $delivery_dt
 * @property string $created_at
 * @property string $updated_at
 * @package App
 */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo('App\Partner', 'partner_id', 'id');
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        $result = '';
        if (isset(static::$statusList[$this->status])) {
            $result = static::$statusList[$this->status];
        }
        return $result;
    }
}
