<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vendor
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @package App
 */
class Vendor extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Products');
    }
}
