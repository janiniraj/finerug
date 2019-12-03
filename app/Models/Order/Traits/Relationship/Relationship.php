<?php

namespace App\Models\Order\Traits\Relationship;

use App\Models\Order\OrderProduct;
use App\Models\UserAddress\UserAddress;
/**
 * Class Relationship.
 */
trait Relationship
{
    /**
     * @return mixed
     */
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * @return mixed
     */
    public function orderShipping()
    {
        return $this->hasOne(UserAddress::class, 'id', 'shipping_address_id');
    }

    /**
     * @return mixed
     */
    public function orderBilling()
    {
        return $this->hasOne(UserAddress::class, 'id', 'billing_address_id');
    }
}
