<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = "service";
    public $timestamps = false;
    public $primaryKey = "service_id";
}
