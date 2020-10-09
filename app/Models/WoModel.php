<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WoModel extends Model
{
    protected $table = "p_users";
    protected $primaryKey = "uid";
    public $timestamps = false;   //created_at  &updated_at
    protected $guarded = [];
}
