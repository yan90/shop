<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    protected $table = "a";
    protected $primaryKey = "c_id";
    public $timestamps = false;
    protected $guarded = [];
}
