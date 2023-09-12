<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Posts extends Model
{
    use HasFactory;
    use BelongsToTenant;
    public $fillable = [
        'title', 'photo', 'description','category_id','short_description','slug',
    ];

}
