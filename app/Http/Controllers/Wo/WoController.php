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
      
    }
}
