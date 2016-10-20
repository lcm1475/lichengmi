<?php
namespace Admin\Controller;
use Think\Controller;
class AdminerController extends CommonController {
    public function index(){
            $m = M('user');
            $id = $_SESSION['admin_id'];
            $arr = $m->find($id);
            $this->assign("arr",$arr);
            $this->display();
    }

    public function saveDetail(){
        $id = $_SESSION['admin_id'];
        $m=M("userinfo");
        $result=$m->where("uid = {$id}")->save($m->create());
        if($result>0){
            $this->success("更新成功！");
        }else{
            $this->error("更新失败！");
        }
    }

    public function changePass(){
            $one = $_POST['passone'];
            $two = $_POST['passtwo'];
            if($one != $two || $one == '' || $two == ''){
                $this->error("对不起，两次密码不一致");
            }else{
                $m=M("user");
                $id = $_SESSION['admin_id'];
                $pass = md5($one);
                $result = $m->where("id={$id}")->setField('password',$pass);
                if($result>0){
                    $this->success("修改成功!");
                }else{
                    $this->error("修改失败！");
                }
            }
    }

    public function changePic(){
            if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $_POST['data'], $result)){
                $type = $result[2];
                $id = $_SESSION['admin_id'];
                $new_file = "./Public/Uploads/UserPic/{$id}.{$type}";
                if(!in_array($type,array('jpg', 'gif', 'png', 'jpeg'))){
                    echo '2';exit;
                }else{
                    if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $_POST['data'])))){
                        $m = M('user');
                        $id = $_SESSION['admin_id'];
                        $result = $m->where("id={$id}")->setField('pic',"./Public/Uploads/UserPic/{$id}.{$type}");
                        echo '1';exit;
                    }else{
                        echo '2';exit;
                    }
                }
            }
    }



}
