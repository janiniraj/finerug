<?php

namespace App\Models\Offer;

use Illuminate\Database\Eloquent\Model;
use App\Models\Offer\Traits\Attribute\Attribute;
use App\Models\Offer\Traits\Relationship\Relationship;

class Offer extends Model
{
    use Relationship,
        Attribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["first_name", "last_name", "email", "phone", "offer_price", "product_id"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.offer_table");
    }
}
