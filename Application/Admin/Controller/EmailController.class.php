<?php
namespace Admin\Controller;
use Think\Controller;
class EmailController extends CommonController {
    public function index(){
            $m = M("email_set");
            $arr = $m->where("id= 1")->find();
            $this->assign("arr",$arr);
            $m = M("email_type");
            $email = $m->find(1);
            $this->assign("email",$email);
            $this->display();
    }

    public function changeSet(){
        $m =M("email_set");
        $data = $m->create();
        $result = $m->where("id=1")->save($data);
        if($result){
            $this->success("操作成功");
        }else{
            $this->error("操作失败");
        }
    }

    public function saveEmail(){
        $m = M("email_type");
        $result = $m->where("id = 1")->save($_POST);
        if($result){
            $this->success("操作成功");
        }else{
            $this->error("操作失败");
        }
    }


}
