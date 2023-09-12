<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Category extends Model
{
    use HasFactory;
    use BelongsToTenant;
    protected $fillable = [
        'name',
        'status',
    ];

}
