<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product.
 */
class UserFavourite extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "user_favourites";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
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
        $this->table = 'user_favourites';
    }
}
