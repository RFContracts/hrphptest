<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class OrderProduct extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public static function overdueList()
    {
        return self::withCount('order')
            ->join('orders as o', 'o.id', '=', 'order_products.order_id')
            ->orderBy('o.delivery_dt', 'desc')
            ->where(['o.status' => Order::STATUS_APPROVE])
            ->where('o.delivery_dt', '<=', Carbon::now()->toDateString());
    }

    public static function nowList()
    {
        return self::withCount('order')
            ->join('orders as o', 'o.id', '=', 'order_products.order_id')
            ->orderBy('o.delivery_dt', 'asc')
            ->where(['o.status' => Order::STATUS_APPROVE])
            ->whereRaw("o.delivery_dt >= ? AND o.delivery_dt <= ?",
                array(Carbon::now()->toDateTimeString(), Carbon::now()->addDay()->toDateTimeString()));
    }

    public static function newList()
    {
        return self::withCount('order')
            ->join('orders as o', 'o.id', '=', 'order_products.order_id')
            ->orderBy('o.delivery_dt', 'asc')
            ->where(['o.status' => Order::STATUS_NEW])
            ->where('o.delivery_dt', '>=', Carbon::now()->toDateString());
    }

    public static function completeList()
    {
        return self::withCount('order')
            ->join('orders as o', 'o.id', '=', 'order_products.order_id')
            ->orderBy('o.delivery_dt', 'desc')
            ->where(['o.status' => Order::STATUS_COMPLETE])
            ->whereRaw("o.delivery_dt >= ? AND o.delivery_dt <= ?",
                array(Carbon::now()->toDateString()." 00:00:00", Carbon::now()->toDateString()." 23:59:59"));
    }
}
