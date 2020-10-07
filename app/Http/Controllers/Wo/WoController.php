<?php

namespace App\Http\Controllers\Wo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Womodel;
class WoController extends Controller
{
    public function login(){
        
        return view('wo/wo');

    }
    public function save(Request $request){
      //执行注册
        $data=$request->except("_token");
        // dd($data);
        $data['reg_time'] = time();
        // dd($data);
        $Wo_model=new Womodel();
        $res=$Wo_model->insert($data);
        // dd($res);
        if($res){
            return redirect('/wo/logindo');
        }
    }
    //登录
    public function logindo(Request $request){
        return view('wo/logindo');
    }
    //执行登录
    public function logindo2(Request $request){
        $data=$request->except("_token");
        //  dd($data);
     
        $res_login=Womodel::where(['user_name'=>$data['user_name'],'password'=>$data['password']])->first();
        // dd($res_login);
        // $reg_pwd=decrypt($res_login['password']);
        $data['password']=md5($data['password']);
        //  dd($data);
        if($res_login){
            session('res',['user_name'=>$data['user_name'],'login_count'=>$data['login_count']]);
            return redirect('/wo/aaa');
        }else{
            return redirect('/wo/logindo')->with(['password'=>'密码错误']);
        }
    }
    //后台页面
    public function aaa(){
        echo 11;
    }
}
