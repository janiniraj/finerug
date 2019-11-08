<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;
use App\Models\Store\Traits\Attribute\Attribute;
use App\Models\Store\Traits\Relationship\Relationship;

class Store extends Model
{
    use Relationship,
        Attribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["firstname", "lastname", "email", "address", "street", "pobox", "city", "state", "country", "phone"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.store_table");
    }
}
