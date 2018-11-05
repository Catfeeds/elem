<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends BaseController
{


    //显示所有收货地址
    public function index(Request $request){
        $id=$request->post('user_id');
        $address=Address::where('user_id',$id)->get();
        return $address;
    }
    //添加收货地址
    public function add(Request $request){
      $data=$request->post();
        //验证规则
        $validate=Validator::make($data,[
            'tel'=>[
                'required',
                'regex:/^0?(13|14|15|16|17|18|19)[0-9]{9}$/',
                'unique:members'
            ],
        ]);
        //验证 如果有错
        if($validate->falis()){
            //返回错误
            return[
                'status'=>"false",
                //获取错误信息
                'message'=>$validate->errors()->first()
            ];
        }
        if (Address::create($data)) {
            $data = [
                'status' => "true",
                'message' => "添加成功 请登录",

            ];
        } else {
            $data = [
                'status' => false,
                'message' => "添加失败",

            ];
        }
        return $data;
    }
    //修改收货地址
    public function edit(Request $request){
        $id=\request()->get("id");
        $address=Address::find($id);
       $data = $request->all();
        if ($address->update($data)) {
           return [
                'status' => "true",
                'message' => "修改成功 请登录",

            ];
        } else {
            return [
                'status' => false,
                'message' => "修改失败",

            ];
        }

    }

    //回显数据
    public function getOne(){
       $id=\request()->get("id");
       $address=Address::find($id);
       return $address;

    }
}
