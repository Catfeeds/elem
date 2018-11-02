<?php

namespace App\Http\Controllers\Admin;

use App\Models\Active;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveController extends BaseController
{
    //

    //显示所有活动列表
    public function index(Request $request)
    {
       $url = $request->query();
       $time =$request->get("time");
        $keyword = $request->get("keyword");
        //有效期内
        //$date = date('Y-m-d',time());
        $query = Active::orderBy("id");
//得到当前时间
        $date=date('Y-m-d H:i:s', time());
//判断时间  1 进行 2 结束 3 未开始
        if( $time == 1 ){
            $query->where("start_time","<=",$date)->where("end_time",">",$date);
        }
        if($time == 2){
            $query->where("end_time","<",$date);
        }
        if($time == 3){
            $query->where("start_time",">",$date);
        }
//内容搜索
        if($keyword !== null){
            $query->where("titlie","like","%{$keyword}%")->orWhere("content","like","%{$keyword}%");
        }

        $actives = $query->paginate(2);
//        dd($date);
       // $actives = Active::paginate(3);
        return view("admin.active.index", compact("actives","url"));

    }

    //添加活动
    public function add(Request $request)
    {
        //判断提交方式
        if ($request->isMethod("post")) {
            //数据验证
            $this->validate($request, [
                "titlie" => "required|unique:actives",
                "content" => "required|",
                "start_time" => "required|",
                "end_time" => "required|",
            ]);
            //接收参数
            $data = $request->post();
//            dd($data);
//            $data['time'] = time();
//            $date = date('Y-m-d');
//            if ($data['start_time'] < $date) {
//                return back()->with("danger","不能输入当前之前时间");
//            }
            if (Active::create($data)) {
                session()->flash("success", "添加成功");
                return redirect("active/index");
            }
        } else {
            return view("admin.active.add");
        }
    }

    //活动修改
    public function edit(Request $request, $id)
    {
        //找到id
        $actives = Active::find($id);

        //判断提交方式
        if ($request->isMethod("post")) {
            //数据验证
            $this->validate($request, [
               "titlie" => "required|",
                "content" => "required|",
                "start_time" => "required|",
                "end_time" => "required|",
            ]);
            //接收数
            $data = $request->post();
//              dd($data);
            if ($actives->update($data)) {
                session()->flash("success", "修改成功");
                return redirect("active/index");
            }
        } else {

            return view("admin.active.edit", compact("actives"));
        }
    }
    //删除活动
    public function  del($id){
        //得到当前分类
        $active=Active::find($id);
        if($active->delete()){
            session()->flash("success", "删除成功");
            return redirect("active/index");
        }

    }
}
