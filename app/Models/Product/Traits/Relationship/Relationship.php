<?php

namespace App\Models\Product\Traits\Relationship;

use App\Models\Color\Color;
use App\Models\Categories\Category;
use App\Models\SubCategories\SubCategory;
use App\Models\Style\Style;
use App\Models\Material\Material;
use App\Models\Weave\Weave;
use App\Models\Product\ProductSize;
use App\Models\Product\ProductReview;
use App\Models\Product\ProductColor;

/**
 * Class Relationship.
 */
trait Relationship
{

	public function category()
	{
		return $this->hasOne(Category::class, 'id', 'category_id');
	}

	public function subcategory()
	{
		return $this->hasOne(SubCategory::class, 'id', 'subcategory_id');
	}

	public function borderColor()
	{
		return $this->hasOne(Color::class, 'id', 'border_color_id');
	}

	public function color()
	{
		return $this->hasOne(Color::class, 'id', 'color_id');
	}

	public function style()
	{
		return $this->hasOne(Style::class, 'id', 'style_id');
	}

	public function material()
	{
		return $this->hasOne(Material::class, 'id', 'material_id');
	}

	public function weave()
	{
		return $this->hasOne(Weave::class, 'id', 'weave_id');
	}

    public function size()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function review()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function colors()
	{
		return $this->hasMany(ProductColor::class);
	}
}
