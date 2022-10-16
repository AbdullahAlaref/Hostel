<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    public function room(){
        return $this->hasOne('App/room');
    }
    public function rooms(){
        return $this->hasMany('App\models\RoomType','id','room_type_id');
    }
}
