<?php

namespace App\Models\Material;

use Illuminate\Database\Eloquent\Model;
use App\Models\Material\Traits\Attribute\Attribute;
use App\Models\Material\Traits\Relationship\Relationship;

class Material extends Model
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
    	$this->table = config("access.material_table");
    }
}
