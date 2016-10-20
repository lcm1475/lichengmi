<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends CommonController {
    public function index(){
            $m=M("category");
            $arr = $m->select();
            $arr = $this->tree($arr);
            $this->assign("arr",$arr);
    	$this->display();
    }

    public function catadd(){
    	$this->display();
    }

    public function add(){
        $m=M("category");
        $arr = $m->select();
        $arr = $this->tree($arr);
        $this->assign("arr",$arr);
        $now_them = include "./Application/Home/Conf/config.php";
        $them_dir = "./Application/Home/View/";
        $category_type = include $them_dir.$now_them['DEFAULT_THEME']."/info.php";
        $this->assign('category_type',$category_type['category_type']);
        $this->display();
    }

    public function doadd(){
        $m = M("category");
        $result = $m->add($m->create());
        if($result>0){
            $this->success("添加成功！");
        }else{
            $this->error("添加失败！");
        }
    }

    public function delete(){
        $m=M("category");
        $id = $_GET['id'];
        $check = $m->where("fid= {$id}")->find();
        if($check != null){
            $this->error("你小弟还没清理干净呢");
        }else{
            $result = $m->delete($id);
        }
        if($result>0){
            $this->success("删除成功！");
        }else{
            $this->error("删除失败！");
        }
    }


    public function edit(){
        $id = $_GET['id'];
        $m=M("category");
        $arr = $m->where("id = {$id}")->find();
        $this->assign("arr",$arr);
        $arrs = $m->select();
        $arrs = $this->tree($arrs);
        $this->assign("arrs",$arrs);
        $now_them = include "./Application/Home/Conf/config.php";
        $them_dir = "./Application/Home/View/";
        $category_type = include $them_dir.$now_them['DEFAULT_THEME']."/info.php";
        $this->assign('category_type',$category_type['category_type']);
        $this->display();
    }

    public function doedit(){
        $id = $_GET['id'];
        $m = M("category");
        $result = $m->where("id = {$id}")->save($m->create());
        if($result>0){
            $this->success("修改成功！");
        }else{
            $this->error("修改失败！");
        }
    }














}
