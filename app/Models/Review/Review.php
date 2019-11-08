<?php

namespace App\Models\Review;

use Illuminate\Database\Eloquent\Model;
use App\Models\Review\Traits\Attribute\Attribute;
use App\Models\Review\Traits\Relationship\Relationship;

class Review extends Model
{
    use Relationship,
        Attribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = [
        'user_id',
        'star',
        'product_id',
        'title',
        'content',
        'created_at',
        'updated_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.review_table");
    }
}
