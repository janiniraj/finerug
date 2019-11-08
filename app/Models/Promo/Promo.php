<?php

namespace App\Models\Promo;

use Illuminate\Database\Eloquent\Model;
use App\Models\Promo\Traits\Attribute\Attribute;
use App\Models\Promo\Traits\Relationship\Relationship;

class Promo extends Model
{
    use Relationship,
        Attribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["name", "code", "discount", "type", "category", "status", "created_at", "updated_at"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.promo_table");
    }
}
