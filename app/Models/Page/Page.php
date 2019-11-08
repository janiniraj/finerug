<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;
use App\Models\Page\Traits\Attribute\Attribute;
use App\Models\Page\Traits\Relationship\Relationship;

class Page extends Model
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
