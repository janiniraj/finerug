<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Traits\Attribute\Attribute;
use App\Models\Product\Traits\Relationship\Relationship;

/**
 * Class Product.
 */
class Product extends Model
{
    use Attribute,
        Relationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'detail',
        'category_id', 
        'main_image', 
        'created_at', 
        'updated_at',
        'sku',
        'supplier_sku',
        'barcode',
        'brand',
        'category_id',
        'subcategory_id',
        'style_id',
        'material_id',
        'weave_id',
        'color_id',
        'border_color_id',
        'shape',
        'length',
        'width',
        'foundation',
        'knote_per_sq',
        'shop',
        'country_origin',
        'type',
        'age',
        'design',
        'dimension',
        'status',
        'price',
        'price_affiliate',
        'msrp',
        'is_stock',
        'weight',
        'generalsize'
        ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'products';
    }
}
