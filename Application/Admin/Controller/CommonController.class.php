<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller
{
      //初始化方法
      protected function _initialize()
      {
            $m   = M("user");
            $arr = $m->where("username = '%s'", $_SESSION['username'])->find();
            if ($_SESSION['username'] == "" || $arr == null || $_SESSION['kouling'] != md5(md5($arr['username']))) {
                  $this->error('非法操作', U('Admin/Login/login'), 3);
            }
      }

      /*返回结果判断方法*/
      protected function myRelust($result)
      {
            if ($result == false) {
                  $this->error("操作失败！");
            } else {
                  $this->success("操作成功！");
            }
      }

      protected function deleteAll()
      {
            $m = M("{$_GET['model']}");
            if (empty($_POST['xuanze'])) {
                  $this->error("认真选择");
            } else {
                  $count = count($_POST['xuanze']);
                  for ($i = 0; $i < $count; $i++) {
                        $str .= $_POST['xuanze'][$i] . ",";
                  }
                  $str    = substr($str, 0, strlen($str) - 1);
                  $result = $m->where("id in ({$str})")->delete();
                  $this->myRelust($result);
            }
      }

      /*AJAX上传*/
      protected function common_ajax_upload($input_name,$exts = 1,$file_name = false,$path = './Public/Uploads/'){
            $m = M('site');
            $size = $m->where('id = 1')->getField('file_size');
            $size = intval($size)*1048576;
            switch ($exts) {
              case 1:
                    $exts_arr = array('jpg', 'gif', 'png', 'jpeg');
                    break;
                case 2:
                    $exts_arr = array('mp3', 'wam', 'wma', 'aac','mod','cd');
                    break;
                case 3:
                    $exts_arr = array('rar', 'zip', 'doc', 'pdf');
                    break;
                case 4:
                    $exts_arr = array('mp4', 'avi', 'wmv', 'mov','flv','3gp','navi','mkv');
                    break;
                default:
                    return;
                    break;
            }
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =  $size ;// 设置附件上传大小
            $upload->exts      =     $exts_arr;// 设置附件上传类型
            $upload->rootPath  =  $path; // 设置附件上传根目录
            if($file_name){$upload->saveName = $file_name;$upload->replace= true;};
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
              $data['success'] = false;
              $data['msg'] = $upload->getError();
              $data['file_path'] = '';
            }else{// 上传成功
              $data['success'] = true;
              $data['name'] = $info[$input_name]['savename'];
              $data['msg'] = '上传成功';
              $data['size'] = round($info[$input_name]['size']/1024,2);
              $data['file_path'] = $path.$info[$input_name]['savepath'].$info[$input_name]['savename'];
            }
            return $data;
      }

      /*无限分类*/
          protected function tree(&$list,$pid=0,$level=0,$html='|—'){
          static $tree = array();
          foreach($list as $v){
              if($v['fid'] == $pid){
                  $v['sorts'] = $level;
                   $v['html'] = str_repeat($html,$level);
                  $tree[] = $v;
                  $this->tree($list,$v['id'],$level+1);
              }
          }
          return $tree;
      }



}
