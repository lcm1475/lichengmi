<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
    	$this->display();
    }
    public  function checklogin(){
    	$username = I('post.username');
    	$password = md5(I('post.password'));
    	$M = M('user');
    	$result = $M->where("username='%s' AND password='%s' AND status ='0' AND admin = 1",$username,$password)->find();
    	if($result){
    		$_SESSION['username'] = $result['username'];
                          $_SESSION['admin_id'] = $result['id'];
    		$_SESSION['kouling'] = md5(md5($result['username']));
    		$this->success('登陆成功',U('Admin/Index/index'),3);
    	}else{
    		$this->error('登陆失败');
    	}
    }

    public  function logout(){
    	session(null);
    	$this->success('欢迎再来',U('Admin/Login/login'),3);
    }

}
