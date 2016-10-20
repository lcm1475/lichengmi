<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
            $m = M("article");
            $count      = $m->where("status = 0")->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $list = $m->field('a.*,b.truename')->table("__ARTICLE__ a,__USER__ b")->where("a.status = 0 and b.id = a.uid")->order('a.istop desc,a.id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign("list",$list);
            $this->assign('page',$show);// 赋值分页输出
            $slides = M("slides");
            $slidesList = $slides->order("id desc")->select();
            $this->assign("slidesList",$slidesList);
            $this->assign("slidesLists",$slidesList);
            $this->display();
    }


    public function serch(){
        $keywords = I("post.keywords");
        $m=M("article");
        $where['title']  = array("like","%{$keywords}%");
        $arr = $m->where($where)->select();
        $count = $m->where($where)->count();
        $this->assign("count",$count);
        $this->assign("arr",$arr);
        $this->assign("keywords",$keywords);
        $this->display();
    }

    public function yaoqingma(){
        $this->assign("is_active","003");
        $this->display();
    }
}
