<?php

namespace App\Http\Controllers\Wo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Womodel;
use Illuminate\Support\Facades\Redis;

class WoController extends Controller
{
    public function login(){
        
        return view('wo/wo');

    }
    //注册
    public function save(Request $request){
      //执行注册
        $data=$request->except("_token");
        // dd($data);
        $data['reg_time'] = time();
        // dd($data);
         $data['password']=md5($data['password']);
        $Wo_model=new Womodel();
        $res=$Wo_model->insert($data);
        // dd($res);
        if($res){
            return redirect('/wo/logindo');
        }
    }
    //登录
    public function logindo(Request $request){
        // $num=Redis::incr('shop_couont');
        // echo $num;exit;
        // phpinfo();die;
        return view('wo/logindo');
    }
    //执行登录
    public function logindo2(Request $request){
        // dd('11');
        $data=$request->except("_token");
        // except为排除函数
        $user_name=$request->input('user_name');
        $user_password=$request->input('password');
        //最后登录的ip
        $ip=$_SERVER['REMOTE_ADDR'];
        $res_login=Womodel::where(['user_name'=>$user_name])
        ->orwhere(['email'=>$user_name])
        ->orwhere(['tel'=>$user_name])
        ->first();
        if($res_login){
            session('res',['user_name'=>$data['user_name']]);
            $last_login=$res_login['last_login']=time();
            //修改最后登录时间
            $last_login=Womodel::where(['uid'=>$res_login['uid']])->update(['last_login'=>$last_login]);
            //登录次数
            $login=$res_login['login_count']=$res_login->login_count+1;
            //修改登录的ip
            $ip= Womodel::where(['uid'=>$res_login['uid']])->update(['last_ip'=>$ip]);
           //修改登录的次数
            Womodel::where(['uid'=>$res_login['uid']])->update(['login_count'=>$login]);
        //    dd($ip);
            return redirect('/wo/aaa');
        }else{
            // $res=Womodel::where(['password'=>$user_password]);
            // dd($res);
            return redirect('/wo/logindo')->with(['password'=>'密码错误']);
        }
    }
    //后台页面
    public function aaa(){
        echo 11;
    }
}
