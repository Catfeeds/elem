<?php

namespace App\Http\Controllers\api;

use App\Models\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Mrgoon\AliSms\AliSms;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TraitUseAdaptation\Alias;

class MemberController extends BaseController
{
    //用户注册
    public function reg( Request $request )
    {
        $data=$request->post();
        //验证规则
        $validate=Validator::make($data,[
            'username'=>'required|unique:members',
            'sms'=>'required|integer|min:1000|max:999999',
            'tel'=>[
                'required',
                'regex:/^0?(13|14|15|16|17|18|19)[0-9]{9}$/',
//                'unique:members'
            ],
          'password' => 'required|min:6'
        ]);

        //验证 如果有错
        if($validate->fails()){
            //返回错误
            return[
                'status'=>"false",
                //获取错误信息
                'message'=>$validate->errors()->first()
            ];
    }
        //dd($data);
        $code=Redis::get('tel_'.$data['tel']);
//        dd($code);
        if($data['sms']==$code){
            $data['password']=Hash::make($data['password']);

            if (Member::create($data)) {
                $data = [
                    'status' => "true",
                    'message' => "注册成功 请登录",
                ];
            } else {
                $data = [
                    'status' => false,
                    'message' => "注册失败",

                ];
            }
            return $data;

        }


    }
        //生成验证码
    public  function sms(Request $request){
        //接收参数
        $tel=$request->get("tel");
        //随机生成验证码6位数
        $code=mt_rand(100000,999999);
        //把验证码存起来
        Redis::setex("tel_".$tel,20,$code);
        //把验证码发给手机号
        $config = [
            'access_key' => 'LTAIDfquOiW3GTXE',//appID
            'access_secret' =>'0TSZHs648qsTAvv7YAUi9B2seVr9cf',//appKey
            'sign_name' => '个人学习分享',//签名
        ];
        $aliSms = new AliSms();
        $response = $aliSms->sendSms($tel, 'SMS_149417370', ['code'=> $code], $config);
       // dd($response);
        if ($response->Code=="OK"){
            $data = [
                "status" => true,
                "message" => "获取短信验证码成功" . $code
            ];
        }else{
            $data = [
                "status" => false,
                "message" => "获取短信验证码失败"
            ];
        }
        //返回

        return $data;

    }
    //登录
    public function login(){
        //1.接收用户名和密码
        $name=\request()->name;
        $password=\request()->password;

        //2. 判断用户名是否存在
         $member=Member::where('username',$name)->first();
        //. 再判断密码是否正确
        if($member && Hash::check($password,$member->password)){
            $data = [
                'status' => "true",
                'message' => "登录成功",
                'username' => $name,
                'user_id'=>$member->id,
            ];

        }else{
            $data = [
                'status' => "false",
                'message' => "登录失败",
            ];
        }
        return $data;

    }
//忘记密码
public function forget(Request $request){
   //接收参数
    $data=$request->post();
    $code=Redis::get('tel_'.$data['tel']);
    if($data['sms']==$code){
        $tel = $data['tel'];
        $member = Member::where('tel',$tel)->first();
        $data['password']=Hash::make($data['password']);

        if ($member->update($data)) {
            $data = [
                'status' => "true",
                'message' => "修改成功 请登录",
            ];
        } else {
            $data = [
                'status' => false,
                'message' => "修改失败",

            ];
        }
        return $data;

    }


}
//修改密码
public function change( Request $request){
        $data=$this->validate($request,[
           "oldPassword"=>"required",
            "newPassword"=>"required",
            'id'=>"required"
        ]);
    //旧密码和数据库密码对比
    $oldPassword=$request->post('oldPassword');
    $rePassword=$request->post('newPassword');
//加密
    $new=Hash::make($rePassword);
    $member = Member::where("id", $data['id'])->first();
//hash旧密码对比
    if(Hash::check($oldPassword,$member->password)){
     //修改密码
        Member::where('id',$data['id'])->update(['password'=>$new]);
        $data=[
            "status"=>"true",
            "message"=>"修改成功"
        ];
    }else{
        $data=[
            "status"=>"false",
            "message"=>"修改失败"
        ];
    }
return $data;
}

//用户信息
 public function detail(Request $request){
     return Member::find($request->get('user_id'));
 }
}
