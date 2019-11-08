<?php

namespace App\Models\SubCategories\Traits\Relationship;

use App\Models\Categories\Category;

/**
 * Class SubCategoryRelationship
 */
trait SubCategoryRelationship
{

    /**
     * Subcategories belongs to relationship with Category
     */
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
