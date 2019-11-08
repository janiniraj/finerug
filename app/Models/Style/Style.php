<?php

namespace App\Models\Style;

use Illuminate\Database\Eloquent\Model;
use App\Models\Style\Traits\Attribute\Attribute;
use App\Models\Style\Traits\Relationship\Relationship;

class Style extends Model
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
    	$this->table = config("access.style_table");
    }
}
