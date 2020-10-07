<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        
        return view('admin.admin');
    }
    //添加
    public function save(Request $request){
        $data= $request->except("_token");
        //    dd($data);
        $admin_model = new AdminModel();
        $res = $admin_model->insert($data);
        // dd($res);
        if($res){
            return redirect('/admin/zhan');
        }else{
            return redirect('/admin/index');
        }
    }
    //展示
    public function zhan(){
        $admin = AdminModel::get();
        // dd($admin);
        return view('admin.zhan',["admin"=>$admin]);
    }
    // 删除
    public function delete($c_id){
        $c_id=request()->c_id??'';
        //dd($c_id);
        // dd(11);
        $res=AdminModel::destroy($c_id);
        // dd($res);
        if($res){
            return redirect('admin/zhan');
        }
    }
    //修改
    public function update(Request $request,$c_id){
        $c_id=request()->c_id??'';
        // dd($c_id);
        $res=AdminModel::find($c_id);
        return view('admin/updatedo',['res'=>$res]);
    }
    public function updatedo(Request $request,$c_id){
        $data= $request->except("_token");
      $c_id=request()->c_id??'';
      $res=AdminModel::where('c_id',$c_id)->update($data);
      if($res){
          return redirect('admin/zhan');
      }
    }
}
