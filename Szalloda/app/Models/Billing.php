<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
        protected $table = "billing";
        public $timestamps = false;
        public $primaryKey = "billing_id";
        
}
