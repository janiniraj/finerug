<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use App\Models\Setting\Traits\Attribute\Attribute;
use App\Models\Setting\Traits\Relationship\Relationship;

class Setting extends Model
{
    use Relationship,
        Attribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["name", "slug", "content"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.page_table");
    }
}
