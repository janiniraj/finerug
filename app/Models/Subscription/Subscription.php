<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription\Traits\Attribute\Attribute;
use App\Models\Subscription\Traits\Relationship\Relationship;

class Subscription extends Model
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
        'email',
        'created_at',
        'updated_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.subscription_table");
    }
}
