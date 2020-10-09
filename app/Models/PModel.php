<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PModel extends Model
{
    protected $table = "p_p";
    protected $primaryKey = "cat_id";
    public $timestamps = false;   //created_at  &updated_at
    protected $guarded = [];
}
