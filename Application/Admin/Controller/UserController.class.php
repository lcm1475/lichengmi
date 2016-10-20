<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
    public function index(){
            $m = M("user");
            $count      = $m->where("status = 0")->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $list = $m->where("status = 0")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign("list",$list);
            $this->assign('page',$show);// 赋值分页输出
    	$this->display();
    }

    public function recovery(){
            $m = M("user");
            $count      = $m->where("status = 1")->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $list = $m->where("status = 1")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign("list",$list);
            $this->assign('page',$show);// 赋值分页输出
            $this->display();
    }

    public function delete(){
        $id = $_GET['id'];
        $m =M("user");
        $result = $m->where("id = {$id}")->setField('status',1);
        if($result>0){
            $this->success("成功！");
        }else{
            $this->error("失败！");
        }
    }

    public function xianshi(){
        $id = $_GET['id'];
        $m =M("user");
        $result = $m->where("id = {$id}")->setField('status',0);
        if($result>0){
            $this->success("成功！");
        }else{
            $this->error("失败！");
        }
    }

    public function reallydelete(){
        $id = $_GET['id'];
        if(empty($id)){
            $this->error("非法操作");
        }else{
            $m = M("user");
            $result = $m->where("id = {$id}")->delete();
            $this->myRelust($result);
        }
    }

}
