<?php
namespace Admin\Controller;
use Think\Controller;
class SiteController extends CommonController {
    public function index(){
        $m = M("site");
        $arr = $m->find(1);
        $this->assign("arr",$arr);
        $this->display();
    }

    public function upload_logo(){
        $name = I('post.name');
        $result = $this->common_ajax_upload($name,1);
        $this->ajaxReturn($result);
    }

    public function doedit(){
        $m = M("site");
        $data = $m->create();
        $data['statistics']= $_POST['statistics'];
        $data['icp']= $_POST['icp'];
        $result = $m->where("id = 1")->save($data);
        if($result){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

}
