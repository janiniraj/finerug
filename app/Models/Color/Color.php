<?php

namespace App\Models\Color;

use Illuminate\Database\Eloquent\Model;
use App\Models\Color\Traits\Attribute\Attribute;
use App\Models\Color\Traits\Relationship\Relationship;

class Color extends Model
{
    use Relationship,
        Attribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["name", "display_name", "status", "is_menu"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.color_table");
    }
}
