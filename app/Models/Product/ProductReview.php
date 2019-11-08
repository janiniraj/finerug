<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product.
 */
class ProductReview extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "reviews";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'star',
        'product_id',
        'title',
        'content',
        'created_at',
        'updated_at'
        ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'reviews';
    }
}
