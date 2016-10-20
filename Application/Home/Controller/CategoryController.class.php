<?php
namespace Home\Controller;
use Think\Controller;
class CategoryController extends BaseController {
    public function index(){
        $id = I('get.id');
        $m =M('category');
        $fenleiInfo = $m ->where("id ={$id}")->find();
        $this ->assign("fenleiInfo",$fenleiInfo);
        $this->assign("is_active",$fenleiInfo['id']);
        $article = D("article");
        $count      = $article->where("fid = '%s' AND status = 0",$id)->count();//
        $Page       = new \Think\Page($count,10);
        $show       = $Page->show();//
        $articleList = $article->field('a.*,b.truename')->table("__ARTICLE__ a,__USER__ b")->where("a.status = 0 and b.id = a.uid and a.fid = {$id}")->order('a.istop desc,a.id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign("articleList",$articleList);
        $this->assign('page',$show);
        $theme = C('DEFAULT_THEME');
        $file = "./Application/Home/View/{$theme}/Category/index{$fenleiInfo['type']}.html";
        if(file_exists($file)){
            $this->display("index{$fenleiInfo['type']}");
        }else{
            $this->display("index");
        }
    }





}
