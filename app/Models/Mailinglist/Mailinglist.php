<?php

namespace App\Models\Mailinglist;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mailinglist\Traits\Attribute\Attribute;
use App\Models\Mailinglist\Traits\Relationship\Relationship;

class Mailinglist extends Model
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
    	$this->table = config("access.mailinglist_table");
    }
}
