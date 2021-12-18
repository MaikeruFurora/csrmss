<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function getBrideFullnameAttribute()
    {
        return ucwords("{$this->bride_first_name} {$this->child_middle_name} {$this->bride_last_name}");
    }
    public function getGroomFullnameAttribute()
    {
        return ucwords("{$this->groom_first_name} {$this->child_middle_name} {$this->groom_last_name}");
    }
}
