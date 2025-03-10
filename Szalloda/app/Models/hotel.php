<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = "hotel";
    public $timestamps = false;
    public $primaryKey = "hotel_id";
}
