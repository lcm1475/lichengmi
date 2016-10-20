<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    protected $email_set;
    protected $admin_email;
    protected $CAPTCHA_ID = "c6a8f518771d8ea164fd92890d5685b7";
    protected $PRIVATE_KEY = "5eff47a446c7f4958cef79f9e16b16c7";
    public function _initialize(){
        $fenlei = M("category");
        $fenleiListone = $fenlei->where("fid = 0")->order('sort desc')->select();
        $fenleiListtwo = $fenlei->where("fid != 0")->order('sort desc')->select();
        $this ->assign("fenleiListone",$fenleiListone);
        $this->assign("fenleiListtwo",$fenleiListtwo);
        $Site = M("site");
        $SiteInfo =$Site->find(1);
        $this->SiteInfo = $SiteInfo;
        $this->assign("SiteInfo",$SiteInfo);
        /*查询邮件配置*/
        $emailModel = M("email_set");
        $email_set = $emailModel->find(1);
        $this->email_set = $email_set;
        /*设置管理员邮箱*/
        $this->admin_email = $SiteInfo['admin_email'];
        /*查询友情链接*/
        $m = M("friendlink");
        $friendlinkarr = $m->order("id desc")->select();
        $this->assign("friendlinkarr",$friendlinkarr);
    }

    /*发送邮件方法*/
    protected function MySmtp($smtpemailto,$mailtitle,$mailcontent){
        $email = new \Org\Util\Smtp();
        $email->smtp($this->email_set['smtpserver'],$this->email_set['smtpserverport'],true,$this->email_set['smtpuser'],$this->email_set['smtppass']);
        $email->debug = false;//是否显示发送的调试信息
        $state = $email->sendmail($smtpemailto,$this->email_set['smtpusermail'], $mailtitle, $mailcontent,"HTML");
    }


    /*极验验证验证码*/
    public function EchoMyVerify(){
        $GtSdk = new \Org\Util\GeetestLib($this->CAPTCHA_ID,$this->PRIVATE_KEY);
        $user_id = "test";
        $status = $GtSdk->pre_process($user_id);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $user_id;
        echo $GtSdk->get_response_str();
    }

    public function CheckMyVerify(){

    }

}
