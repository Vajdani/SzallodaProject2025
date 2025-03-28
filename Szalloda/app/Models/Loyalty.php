<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loyalty extends Model
{
    protected $table = "loyalty";
    public $timestamps = false;
    public $primaryKey = "loyalty_id";
}
