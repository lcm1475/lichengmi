<?php
namespace Admin\Controller;
use Think\Controller;
class FriendlinkController extends CommonController {
    public function index(){
            $m = M("friendlink");
            $count      = $m->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $show       = $Page->show();// 分页显示输出
            $list = $m->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('list',$list);// 赋值数据集
            $this->assign('page',$show);// 赋值分页输出
            $this->display();
    }

    public function add(){
        $this->display();
    }

    public function doAdd(){
        $m = M("friendlink");
        $type = array("success","warning","info","danger");
        $num = rand(0,3);
        $data = $m->create();
        $data['ctime'] = time();
        $data['type'] =$type[$num];
        $result = $m->add($data);
        $this->myRelust($result);
    }

    public function update(){
        $m = M("friendlink");
        $arr = $m->find($_GET['id']);
        $this->assign("arr",$arr);
        $this->display("add");
    }

    public function delete(){
        $m = M("friendlink");
        $result = $m->where("id = {$_GET['id']}")->delete();
        $this->myRelust($result);
    }

    public function doUpdate(){
        $m = M("friendlink");
        $data = $m->create();
        $result = $m->where("id = {$_GET['id']}")->save($data);
        $this->myRelust($result);
    }




}
