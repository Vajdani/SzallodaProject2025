<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyRank extends Model
{
    protected $table = "loyaltyrank";
    public $timestamps = false;
    public $primaryKey = "rank_id";
}
