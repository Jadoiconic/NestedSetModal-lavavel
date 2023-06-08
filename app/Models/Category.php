<?php

namespace App\Models;
use Kalnoy\Nestedset\NodeTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $fillable = ['name'];
}
