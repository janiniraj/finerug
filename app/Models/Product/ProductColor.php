<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use App\Models\Color\Color;

/**
 * Class Product.
 */
class ProductColor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "product_colors";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'color_id',
        'product_id',
        'created_at',
        'updated_at'
        ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'product_colors';
    }

    public function color()
    {
        return $this->hasOne(Color::class, 'id', 'color_id');
    }
}
