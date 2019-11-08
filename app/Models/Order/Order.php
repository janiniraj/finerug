<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order\Traits\Attribute\Attribute;
use App\Models\Order\Traits\Relationship\Relationship;

class Order extends Model
{
    use Relationship,
        Attribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["user_id", "status", "user_address_id", "subtotal", "ship_rate", "total", "other", "created_at", "updated_at"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.order_table");
    }
}
