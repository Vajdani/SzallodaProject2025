<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = "reviews";
    public $timestamps = false;
    public $primaryKey = "review_id";
}
