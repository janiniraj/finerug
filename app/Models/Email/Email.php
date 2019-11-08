<?php

namespace App\Models\Email;

use Illuminate\Database\Eloquent\Model;
use App\Models\Email\Traits\Attribute\Attribute;
use App\Models\Email\Traits\Relationship\Relationship;

class Email extends Model
{
    use Relationship,
        Attribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["users", "mailinglist", "subject", "content", "status"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.email_table");
    }
}
