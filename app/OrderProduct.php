<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class OrderProduct
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property int $price
 * @property string $created_at
 * @property string $updated_at
 * @package App
 */
class OrderProduct extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    /**
     * @return mixed
     */
    public static function overdueList()
    {
        return self::withCount('order')
            ->join('orders as o', 'o.id', '=', 'order_products.order_id')
            ->orderBy('o.delivery_dt', 'desc')
            ->where(['o.status' => Order::STATUS_APPROVE])
            ->where('o.delivery_dt', '<=', Carbon::now()->toDateTimeString());
    }

    /**
     * @return mixed
     */
    public static function nowList()
    {
        return self::withCount('order')
            ->join('orders as o', 'o.id', '=', 'order_products.order_id')
            ->orderBy('o.delivery_dt', 'asc')
            ->where(['o.status' => Order::STATUS_APPROVE])
            ->whereRaw("o.delivery_dt >= ? AND o.delivery_dt < ?",
                [Carbon::now()->toDateTimeString(), Carbon::now()->addDay()->toDateTimeString()]);
    }

    /**
     * @return mixed
     */
    public static function newList()
    {
        return self::withCount('order')
            ->join('orders as o', 'o.id', '=', 'order_products.order_id')
            ->orderBy('o.delivery_dt', 'asc')
            ->where(['o.status' => Order::STATUS_NEW])
            ->where('o.delivery_dt', '>=', Carbon::now()->toDateTimeString());
    }

    /**
     * @return mixed
     */
    public static function completeList()
    {
        return self::withCount('order')
            ->join('orders as o', 'o.id', '=', 'order_products.order_id')
            ->orderBy('o.delivery_dt', 'desc')
            ->where(['o.status' => Order::STATUS_COMPLETE])
            ->whereRaw("o.delivery_dt >= ? AND o.delivery_dt < ?",
                [Carbon::now()->toDateString(), Carbon::now()->addDay()->toDateString()]);
    }
}
