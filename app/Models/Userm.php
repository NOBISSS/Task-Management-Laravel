<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userm extends Model
{
    //
    protected $table = 'userms';
    protected $primaryKey = 'id';
    public function Tasks(){
        return $this->hasMany(Taskm::class,'user_id','id');
    }
}
