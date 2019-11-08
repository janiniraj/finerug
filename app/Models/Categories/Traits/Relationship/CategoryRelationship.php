<?php

namespace App\Models\Categories\Traits\Relationship;

use App\Models\SubCategories\SubCategory;

/**
 * Class CategoryRelationship.
 */
trait CategoryRelationship
{
    /**
     * Categories has many relationship with subcategories
     */
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
