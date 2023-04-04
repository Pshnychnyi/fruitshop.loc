<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'title', 'description', 'first_link_name', 'second_link_name', 'first_link_path', 'second_link_path'];
}
