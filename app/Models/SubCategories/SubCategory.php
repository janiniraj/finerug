<?php

namespace App\Models\SubCategories;

use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategories\Traits\Attribute\SubCategoryAttribute;
use App\Models\SubCategories\Traits\Relationship\SubCategoryRelationship;

class SubCategory extends Model
{
    use SubCategoryRelationship,
        SubCategoryAttribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["subcategory", "category_id", "status"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.subcategories_table");
    }
}
