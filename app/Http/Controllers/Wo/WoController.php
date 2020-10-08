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
          //dd($data);
        $ip=$_SERVER['REMOTE_ADDR'];
        // print_r($ip);exit;
        $res_login=Womodel::where(['user_name'=>$data['user_name'],'password'=>$data['password']])->first();
        //dd($res_login);exit;
        $data['password']=md5($data['password']);
        if($res_login){
            session('res',['user_name'=>$data['user_name']]);
           $ip= Womodel::where(['uid'=>$res_login['uid']])->update(['last_ip'=>$ip]);
        //    dd($ip);
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
