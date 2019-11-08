<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\Traits\Attribute\CategoryAttribute;
use App\Models\Categories\Traits\Relationship\CategoryRelationship;

class Category extends Model
{
    use CategoryRelationship,
        CategoryAttribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["category", "status"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.categories_table");
    }
}
