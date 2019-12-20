<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $vendor_id
 * @property string $created_at
 * @property string $updated_at
 * @package App
 */
class Product extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_products()
    {
        return $this->hasMany('App\OrderProduct');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
}
