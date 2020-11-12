<?php

namespace App\Http\Controllers\Wo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Womodel;
use Illuminate\Support\Facades\Redis;
use Validator;
use Illuminate\Validation\Rule;
class WoController extends Controller
{
    public function login(){
        return view('wo/wo');
    }
    //注册
    public function save(Request $request){
      //执行注册
        $data=$request->except("_token");
        //验证
        $validator=Validator::make($request->all(),[
            'user_name'=>'required|unique:p_users',
            'password'=>'required',
        ],[
            'user_name.required'=>'用户名名称必填',
            'user_name.unique'=>'用户名名称已存在',
            'password.required'=>'密码不能为空',
        ]);
            if($validator->fails()){
                return redirect('wo/logindo')
                ->withErrors($validator)
                ->withInput();
            }
         
            $Wo_model=new Womodel();
        $Wo_model->user_name=$request->user_name;
        $Wo_model->password=$request->password;
        $res=$Wo_model->save();
        $data['reg_time'] = time();
        // dd($data);
         $data['password']=md5($data['password']);
        if($res){
            return redirect('/wo/logindo');
        }
        
    }
    //登录
    public function logindo(Request $request){
        // $num=Redis::incr('shop_couont');
        // echo $num;exit;
        
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
        if(empty($res_login)){
            die('用户不存在');
        }
        // 如果根据用户输入的账号没有在库中查到，则输入以下内容
        if(empty($res_login)){
            return redirect('wo/logindo')->with(['msg'=>'您输入的账号或密码有误']);
        }
         // 可有可无
        /**
         * 判断这个变量是不是一个对象
         * 如果是一个对象则转换为数组
         */
        if(is_object($res_login)){
            $res_login=$res_login->toArray();
        }
         // 测试使用，打印出用户剩余的时间
        // dd(Redis::TTL("last_login:".$res_login['uid']));
        /** @var
         * $login_time
         * 如果用户的一小时锁定时间 去 / (除以) 60去取整
         * 反馈给用户还剩余多少时间可重新操作登录
         */
        $login_time = ceil(Redis::TTL("last_login:".$res_login['uid']) / 60);
        if(!empty(Redis::get("last_login:".$res_login['uid']))){
            return redirect('admin/login')->with(['msg'=>'该账户密码输入错误次数过多,已锁定一小时,剩余时间'.$login_time.'分钟']);
        }
            // 判断用户是否已经锁定
            if(Redis::get("login_count:".$res_login['uid']) >= 4){
                Redis::setex("login_time:".$res_login['uid'],3600,Redis::get("login_count:".$res_login['uid']));
                return redirect('wo/logindo')->with(['msg'=>'该账户密码输入错误次数过多,已锁定一小时']);
            }
        if($res_login['password']==md5($user_password)){
            session(['uid'=>$res_login['uid'],'user_name'=>$res_login['user_name'],'user_tel'=>$res_login['tel'],'email'=>$res_login['email']]);
            //  dump(session());exit;
            
            $last_login=$res_login['last_login']=time();    
            //修改最后登录时间
            $last_login=Womodel::where(['uid'=>$res_login['uid']])->update(['last_login'=>$last_login]);
            //登录次数
            // $login=$res_login['login_count']=$res_login->login_count+1;
            //修改登录的ip
            $ip= Womodel::where(['uid'=>$res_login['uid']])->update(['last_ip'=>$ip]);
           //修改 登录的次数
            // Womodel::where(['uid'=>$res_login['uid']])->update(['login_count'=>$login]);
        //    dd($ip);
         /** @var
             * $logininfo
             * 将用户的最后一次登录的时间以及用户登录的次数从基础上来 + 1
             */
            $Womodel=new Womodel();
            $logininfo = ['login_count'=>$res_login['login_count']+1];
            $Womodel->where('uid',$res_login['uid'])->update($logininfo);
            return redirect('/wo/list');
            // }
        }else{
            // 判断用户是不是第一次错误 如果是第一次错误则释放出一个属于第一次的时间领域
            /**
             * Redis::setex
             * 使用Redis来定义一个
             * 第一个参数为键
             * 第二个参数为过期时间(单位为:秒)
             * 第三个参数设置为键所对应的值
             */
            if(empty(Redis::get("login_count:".$res_login['uid']))){//设置一个10分钟的时间领域
                Redis::setex("login_count:".$res_login['uid'],600,Redis::get("login_count:".$res_login['uid']));
            }
            //// 来设置用户的错误次数
            Redis::incr("login_count:".$res_login['uid']);
            // echo '密码错误次数：'.$count;die;
            // return redirect('/wo/logindo')->with(['password'=>'密码错误']);
            return redirect('/wo/logindo')->with(['msg'=>'您输入的账号或密码有误,错误次数:'.Redis::get("login_count:".$res_login['uid'])]);//获取用户的错误次数，反馈给视图界面
        }
    }
    //后台页面
    public function list(){
        // echo storage_path('img/aaa.jpg');
        return view('wo/list');
    }
    //处理文件上传
    public function aaa(Request $request){
        $f=$request->file('img');
        // echo '<pre>';print_r($f);echo'</pre>';
        $name1=$f->getClientOriginalName();
        $ext=$f->getClientOriginalExtension();
        $size=$f->getSize();
        //保存
        $path='public/img';
        $name='aaa.'.$ext;
        // echo $name;die;
        $res=$f->storeAs($path,$name);
        var_dump($res);
    }
    //退出
    public function exit(Request $request){
        session(['uid'=>null,'user_name'=>null,'tel'=>null,'email'=>null]);
        $user_id = $request->session()->get('uid');
        if(empty($user_id)){
            return redirect('wo/logindo')->with(['msg'=>'退出成功']);
        }
    
    }

}
