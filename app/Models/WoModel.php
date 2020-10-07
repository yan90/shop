<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    protected $table = "wo";
    protected $primaryKey = "uid";
    public $timestamps = false;
    protected $guarded = [];
}
