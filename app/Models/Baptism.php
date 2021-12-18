<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baptism extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    public function getFullnameAttribute()
    {
        return ucwords("{$this->child_first_name} {$this->child_middle_name} {$this->child_last_name}");
    }

    public function getFatherFullnameAttribute()
    {
        return ucwords("{$this->parent_father_first_name} {$this->parent_father_last_name}");
    }

    public function getMotherFullnameAttribute()
    {
        return ucwords("{$this->parent_mother_first_name} {$this->parent_mother_last_name}");
    }
    public function getGodFatherFullnameAttribute()
    {
        return ucwords("{$this->god_father_first_name} {$this->god_father_last_name}");
    }
    public function getGodMotherFullnameAttribute()
    {
        return ucwords("{$this->god_mother_first_name} {$this->god_mother_last_name}");
    }
}
