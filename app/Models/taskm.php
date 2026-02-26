<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class taskm extends Model
{
    //
    protected $table = 'taskms';
    protected $primaryKey = 'id';
    public function Users(){
        return $this->belongsTo(Userm::class,'user_id','id');   
    }
}
