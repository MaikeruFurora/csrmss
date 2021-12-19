<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function getFullnameAttribute()
    {
        return ucwords("{$this->confirmation_first_name} {$this->confirmation_middle_name} {$this->confirmation_last_name}");
    }
}
