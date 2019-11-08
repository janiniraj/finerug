<?php

namespace App\Models\Activity;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity\Traits\Attribute\Attribute;
use App\Models\Activity\Traits\Relationship\Relationship;

class Activity extends Model
{
    use Relationship,
        Attribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["user_id", "product_id", "activity", "created_at", "updated_at"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.activity_table");
    }
}
