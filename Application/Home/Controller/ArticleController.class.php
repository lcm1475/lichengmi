<?php
namespace Home\Controller;
use Think\Controller;
class ArticleController extends BaseController {
    public function index(){
        $id = I("get.id");
        $m=M("article");
        $prefix  = C('DB_PREFIX');
         $articleInfo = $m->field("a.*,(SELECT count(id) FROM {$prefix}comment where aid = {$id}) as comment")->table("{$prefix}article as a")->where("status = 0 AND id = {$id}")->find();
        if($articleInfo){
            $mm=D("user");
            $m->where("id = {$id}")->setInc('view',1);
            $userInfo = $mm->find($articleInfo['uid']);
            $mmm=M("category");
            $fenleiInfo = $mmm->where("id = {$articleInfo['fid']}")->find();
            $zuixin = $m->where("uid = {$userInfo['id']} AND status = 0")->limit(5)->order("id desc")->select();
            $xihuan = $m->where("status = 0")->limit(5)->order("rand()")->select();
            $this->assign("zuixin",$zuixin);
            $this->assign("xihuan",$xihuan);
            $this->assign("articleInfo",$articleInfo);
            $this->assign("userInfo",$userInfo);
            $this->assign("fenleiInfo",$fenleiInfo);
            $this->assign("is_active",$fenleiInfo['id']);
            $theme = C('DEFAULT_THEME');
            $file = "./Application/Home/View/{$theme}/Article/index{$articleInfo['type']}.html";
            if(file_exists($file)){
                $this->display("index{$articleInfo['type']}");
            }else{
                $this->display("index");
            }
        }else{
            $this->error('该文章正在审核中',U('Index/index'));
        }

    }

    public function replay(){
        $GtSdk = new \Org\Util\GeetestLib($this->CAPTCHA_ID,$this->PRIVATE_KEY);
        $user_id = $_SESSION['user_id'];
        if ($_SESSION['gtserver'] == 1) {
            $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $user_id);
            if (!$result) {
                $this->error("验证码不正确");
            }
        }else{
            if (!$GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
                $this->error("验证码不正确");
            }
        }
        if($_POST['name'] == '' || $_POST['email'] == '' || $_POST['content'] == ''){
            $this->error("最恨提交空数据");
        }
        $aid = I("get.id");
        $m =M("comment");
        $data = $m->create();
        $data['aid'] = $aid;
        $data['ctime']=time();
        if($_SESSION['muser']!=null || $_SESSION['muser']!= ''){
            $data['uid'] = $_SESSION['mid'];
        }
        $result = $m->add($data);
        if($result>0){
            $mm = M("article");
            if(!$this->email_set['comment_set']){
                $m = M('email_type');
                $info= $m->find(1);
                $article= $mm->find($aid);
                $info['send_comment_content'] = $info['send_comment_content']."<br/>回复帖子标题：<a href = '".$_SERVER['HTTP_REFERER']."' target = '_blank'>{$article['title']}</a><br/>回复署名：{$_POST['name']}<br/>回复内容：{$_POST['content']}";
                $this->MySmtp($this->admin_email,$info['send_comment_title'],$info['send_comment_content']);
            }
            $this->success("回复成功！");
        }else{
            $this->error("回复失败！");
        }
    }

    public function get_replay(){
        $id  = intval(I("post.id"));
        $num = intval(I("post.num"));
        $prefix  = C('DB_PREFIX');
        $m = M("comment");
        $sql=  "SELECT a.*,b.pic FROM {$prefix}comment a left join {$prefix}user b ON a.uid = b.id  where a.status = 0 and a.aid = {$id} and a.replay = 0 limit {$num},10";
        $arr = $m->query($sql);
        if(!empty($arr)){
            $arr = $this->get_son_comment($arr,$m,$prefix);
            $this->ajaxReturn($arr);
        }else{
            echo 5;
            exit;
        }
    }

    public function enarticlepassword(){
        $id = I('get.id');
        $password = I('post.password');
        $_SESSION["article_{$id}"] = $password;
        $this->success('输入成功');
    }

        /**
     * 创建父节点树形数组
     * 参数
     * $ar 数组，邻接列表方式组织的数据
     * $id 数组中作为主键的下标或关联键名
     * $pid 数组中作为父键的下标或关联键名
     * 返回 多维数组
     **/
    protected function find_parent($ar, $id='id', $pid='pid') {
      foreach($ar as $v) $t[$v[$id]] = $v;
      foreach ($t as $k => $item){
        if( $item[$pid] ){
          if( ! isset($t[$item[$pid]]['parent'][$item[$pid]]) )
             $t[$item[$id]]['parent'][$item[$pid]] =& $t[$item[$pid]];
        }
      }
      return $t;
    }

    /*获取子回复*/
    protected function get_son_comment($arr,$m,$prefix,&$newarr){
        foreach ($arr as $key => $value) {
            $newarr[$value['id']] = $arr[$key];
            $sql=  "SELECT a.*,b.pic FROM {$prefix}comment a left join {$prefix}user b ON a.uid = b.id  where a.replay = {$value['id']} and a.status = 0 ORDER BY a.id asc ";
            $check = $m->query($sql);
            if($check){
                foreach ($check as $k => $v) {
                    $newarr[$v['replay']]['son'][] = $v['id'];
                }
                $this->get_son_comment($check,$m,$prefix,$newarr);
            }
        }
        return $newarr;
    }



}
