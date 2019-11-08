<?php

namespace App\Models\MakeanOffer;

use Illuminate\Database\Eloquent\Model;
use App\Models\MakeanOffer\Traits\Attribute\Attribute;
use App\Models\MakeanOffer\Traits\Relationship\Relationship;

class MakeanOffer extends Model
{
    use Relationship,
        Attribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = [
        'first_name',
        'last_name',
        'product_id',
        'phone',
        'price',
        'created_at',
        'updated_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = "makeanoffer";//config("access.review_table");
    }
}
