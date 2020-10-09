<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use App\Models\PModel;
use App\Models\GoodesModel;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    //视图俩表
    public function index(){
        
        $PModel=new PModel();
        $PModelInfo=$PModel->get();
         //dd($PModelInfo);
        return view('goods.index',['PModelInfo'=>$PModelInfo]);
    }
    //执行添加
    public function save(Request $request){
        // 
        $data=$request->except("_token");
        // dd($data);
        $GoodesModel=new GoodesModel();
        $GoodesInfo=$GoodesModel->insert($data);
        if($GoodesInfo){
            return redirect('/goods/list');
        }
    }
    public function list(){
        // $Goodes=GoodesModel::join('p_goods p','p.cat_id=p_p.cat_id')->limit(10)->get();
        //  dd($Goodes);

        return view('/goods/list',['Goodes'=>$Goodes]);

    }
}
