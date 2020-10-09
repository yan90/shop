<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodesModel extends Model
{
    //
    protected $table = "p_goods";
    protected $primaryKey = "goods_id";
    public $timestamps = false;   //created_at  &updated_at
    protected $guarded = [];
}