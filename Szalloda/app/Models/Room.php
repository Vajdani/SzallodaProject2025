<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = "room";
    public $timestamps = false;
    public $primaryKey = "room_id";
}
