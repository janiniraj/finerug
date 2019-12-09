<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order\Traits\Attribute\Attribute;
use App\Models\Order\Traits\Relationship\Relationship;
use App\Models\Product\Product;

class OrderProduct extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["order_id", "product_id", "price", "attributes", "created_at", "updated_at", "quantity"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.order_product_table");
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
