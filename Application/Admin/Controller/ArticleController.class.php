<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends CommonController {
    // 文章列表
    public function index(){
            $m = M("article");
            $prefix  = C('DB_PREFIX');
            $count      = $m->where("status = 0")->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $list = $m->field("a.*,(SELECT count(id) FROM {$prefix}comment where aid = a.id) as comment")->table("{$prefix}article as a")->where("status = 0")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign("list",$list);
            $this->assign('page',$show);// 赋值分页输出
    	$this->display();
    }

    // 文章修改
    public function update(){
        $m = M('category');
        $category = $m->order('sort desc')->select();
        $category = $this->tree($category);
        $this->assign('category',$category);
        $now_them = include "./Application/Home/Conf/config.php";
        $them_dir = "./Application/Home/View/";
        $article_type = include $them_dir.$now_them['DEFAULT_THEME']."/info.php";
        $this->assign('article_type',$article_type['article_type']);
        $article_info = M('article');
        $article_info = $article_info->find(I('get.id'));
        if($article_info) $this->assign('article_info',$article_info);
        $this->display();
    }

    /*执行文章修改*/
    public function do_update(){
        $id = I('get.id');
        $m = M('article');
        $data = $m->create();
        $data['content'] = $_POST['content'];
        $data['edittime'] = time();
        $result = $m->where("id = {$id}")->save($data);
        $this->myRelust($result);
    }

    // 回收站
    public function recovery(){
            $m = M("article");
            $count      = $m->where("status = 1")->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $list = $m->where("status = 1")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign("list",$list);
            $this->assign('page',$show);// 赋值分页输出
            $this->display();
    }

    // 放回回收站
    public function delete(){
        $id = I("get.id");
        $m =M("article");
        $result = $m->where("id = {$id}")->setField('status',1);
        if($result>0){
            $this->success("文章放入回收站！");
        }else{
            $this->error("失败！");
        }
    }

    // 拿出回收站
    public function xianshi(){
        $id = I("get.id");
        $m =M("article");
        $result = $m->where("id = {$id}")->setField('status',0);
        if($result>0){
            $this->success("成功！");
        }else{
            $this->error("失败！");
        }
    }

    // 确认删除
    public function reallydelete(){
        $id = I("get.id");
        if(empty($id)){
            $this->error("非法操作");
        }else{
            $m = M("article");
            $result = $m->where("id = {$id}")->delete();
            if($result){
                $m = M('comment');
                $check = $m->where("aid = {$id}")->select();
                if($check){
                    $result = $m->where("aid = {$id}")->delete();
                }
                $this->myRelust($result);
            }

        }
    }

    // 改变置顶状态
    public function changeTop(){
        $id = I("get.id");
        $status = I('get.status');
        $m = M('article');
        $result = $m->where("id = {$id}")->setField('istop',$status);
        $this->myRelust($result);
    }

    // 评论列表
    public function commentList(){
        $id = I('get.id');
        $m = M('comment');
        $count      = $m->where("aid = {$id}")->count();
        $Page       = new \Think\Page($count,10);
        $show       = $Page->show();// 分页显示输出
        $list = $m->where("aid = {$id}")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign("list",$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    // 改变评论状态
    public function changeCommentStatus(){
        $m = M('comment');
        $id = I("get.id");
        $status = I('get.status');
        $result = $m->where("id = {$id}")->setField('status',$status);
        $this->myRelust($result);
    }

    // 删除评论
    public  function delComment(){
        $m = M('comment');
        $id = I("get.id");
        $result = $m->delete($id);
        $this->myRelust($result);
    }

    /*添加文章页面*/
    public function add(){
        $m = M('category');
        $category = $m->order('sort desc')->select();
        $category = $this->tree($category);
        $this->assign('category',$category);
        $now_them = include "./Application/Home/Conf/config.php";
        $them_dir = "./Application/Home/View/";
        $article_type = include $them_dir.$now_them['DEFAULT_THEME']."/info.php";
        $this->assign('article_type',$article_type['article_type']);
        $this->display();
    }

    /*富文本编辑器上传方法*/
    public function doUploadPic(){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $data['success'] = false;
                $data['msg'] = $upload->getError();
                $data['file_path'] = '';
                $this->ajaxReturn($data);
            }else{// 上传成功
                $data['success'] = true;
                $data['msg'] = '上传成功么么哒';
                $data['file_path'] ='./Public/Uploads/'.$info['upload_file']['savepath'].$info['upload_file']['savename'];
                $this->ajaxReturn($data);
            }
    }

    /*添加文章上传文件*/
    public function ajax_upload(){
        $name = I('post.name');
        switch ($name) {
            case 'mp3':
                $type = 2;
                break;
            case 'file':
                $type = 3;
                break;
            case 'pic':
                $type = 1;
                break;
            case 'video':
                $type = 4;
                break;
            default:
                return;
                break;
        }
        $result = $this->common_ajax_upload($name,$type);
        $this->ajaxReturn($result);
    }

    /*文章保存方法*/
    public function doadd(){
        $m = M('article');
        $data = $m->create();
        $data['content'] = $_POST['content'];
        $data['uid'] = 1;
        $data['ctime'] = time();
        $data['edittime'] = time();
        $result = $m->add($data);
        $this->myRelust($result);
    }




}
