<?php

namespace App\Models\Visitor;

use Illuminate\Database\Eloquent\Model;
use App\Models\Visitor\Traits\Attribute\Attribute;
use App\Models\Visitor\Traits\Relationship\Relationship;

class Visitor extends Model
{
    use Relationship,
        Attribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["ip", "country_code", "zip_code", "latitude", "longitude", "count", "created_at", "updated_at"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.visitor_table");
    }
}
