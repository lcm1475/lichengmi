<?php
namespace Admin\Controller;
use Think\Controller;
class YaoqingController extends CommonController {
    public function index(){
            $m=M("code");
            $count      = $m->count();
            $Page       = new \Think\Page($count,20);
            $show       = $Page->show();// 分页显示输出
            $list = $m->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign("arr",$list);
            $this->assign('page',$show);// 赋值分页输出
            $this->display();
    }

    public function add(){
        $this->display();
    }

    public function doadd(){
        $m = M("code");
        $data = $m->create();
        $data['status'] = 0;
        $result = $m->add($data);
        if($result>0){
            $this->success("添加成功！");
        }else{
            $this->error("添加失败！");
        }
    }

    public function delete(){
        $m=M("code");
        $id = $_GET['id'];
        $result = $m->delete($id);
        if($result>0){
            $this->success("删除成功！");
        }else{
            $this->error("删除失败！");
        }
    }

    public function production(){
        $this->display();
    }

    public function doProduction(){
        $number = I("post.number");
        $name = I("post.name");
        if(is_numeric($number) == false || $number <1){
            $this->error("数量不是数字或者小于1");
        }else{
            $m = M("code");
            $count =intval($number);
            for ($i=0; $i <$count; $i++) {
                $code['code'] = $name.substr(time(),-6).rand(0,9999);
                $code['status'] = 0;
                $check = $m->where("code = '{$code['code']}'")->find();
                if($check ==null || $check ==false){
                    $result = $m->add($code);
                }else{
                    continue;
                }
            }
            $this->myRelust($result);
        }
    }














}
