<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mass extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $casts =[
        'mass_first_name'=>'array',
        'mass_middle_name'=>'array',
        'mass_last_name'=>'array',
        'mass_option'=>'array',
    ];
}
