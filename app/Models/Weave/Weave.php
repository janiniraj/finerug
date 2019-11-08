<?php

namespace App\Models\Weave;

use Illuminate\Database\Eloquent\Model;
use App\Models\Weave\Traits\Attribute\Attribute;
use App\Models\Weave\Traits\Relationship\Relationship;

class Weave extends Model
{
    use Relationship,
        Attribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["name", "status"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.weave_table");
    }
}
