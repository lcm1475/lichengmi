<?php
namespace Admin\Controller;
use Think\Controller;
class SlidesController extends CommonController {
    public function index(){
            $m=M("slides");
            $arr = $m->order("id desc")->select();
            $this->assign("arr",$arr);
    	$this->display();
    }

    public function add(){
        $this->display();
    }

    public function upload_img(){
        $name = I('post.name');
        $result = $this->common_ajax_upload($name,1);
        $this->ajaxReturn($result);
    }

    public function doadd(){
        $m = M("slides");
        $data = $m->create();
        $data['ctime']=time();
        $result = $m->add($data);
        if($result>0){
            $this->success("发布成功！");
        }else{
            $this->error("发布失败！");
        }
}
    public function delete(){
        $m=M("slides");
        $id = $_GET['id'];
        $result = $m->delete($id);
        if($result>0){
            $this->success("删除成功！");
        }else{
            $this->error("删除失败！");
        }
    }


    public function edit(){
        $id = $_GET['id'];
        $m=M("slides");
        $arr = $m->where("id = {$id}")->find();
        $this->assign("arr",$arr);
        $this->display();
    }

    public function doedit(){
        $id = $_GET['id'];
        $m = M("slides");
        $data = $m->create();
        $result = $m->where("id = {$id}")->save($data);
        if($result>0){
            $this->success("修改成功！");
        }else{
            $this->error("修改失败！");
        }
    }













}
