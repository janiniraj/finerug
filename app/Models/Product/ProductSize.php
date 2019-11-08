<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product.
 */
class ProductSize extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "product_sizes";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'length',
        'width',
        'product_id',
        'created_at',
        'updated_at',
        'price',
        'quantity',
        'price_affiliate'
        ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'product_sizes';
    }
}
