<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends BaseController
{
    //
    public function index(){
        $members=Member::all();
       return view("admin.member.index",compact("members"));
    }
    //修改会员状态
//    public function status(Request $request,$id){
//    $member=Member::find($id);
//    if($member->status==0){
//        $member['status']=1;
//        return view("admin.member.index")->with("禁用成功");
//    }
//    }



}
