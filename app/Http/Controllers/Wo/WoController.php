<?php

namespace App\Http\Controllers\Wo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class WoController extends Controller
{
    public function index(){
        
        return view('wo/wo');

    }
    public function save(){
      //执行添加
    }
    public function h(){
        //修改哈哈哈
    }
}
