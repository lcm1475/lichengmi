<?php
namespace Admin\Controller;
use Think\Controller;
class ThemeController extends CommonController {
    public function index(){
            // 寻找有多少主题
            $them_dir = "./Application/Home/View/";
            if($dh = opendir($them_dir)){
                while (($file = readdir($dh)) !== false){
                    if((is_dir($them_dir."/".$file)) && $file!="." && $file!=".." && $file != "Default"){
                        $a = include $them_dir."/".$file.'/info.php';
                        $a['root_dir'] = $them_dir."/".$file.'/';
                        $a['dir_name'] = $file;
                        $them_list[] = $a;
                    }
                }
                closedir($dh);
                if($them_list){
                    $this->assign("them_list",$them_list);
                }
            }
            // 查出当前主题
            $now_them = include "./Application/Home/Conf/config.php";
            $this->assign("now_them",$now_them['DEFAULT_THEME']);
    	$this->display();
    }

    /*改变当前主题*/
    public function change_them(){
        $them = I('get.them');
        $str = "<?php return array('DEFAULT_THEME'    =>    '{$them}'); ?>";
        $file = "./Application/Home/Conf/config.php";
        $result = file_put_contents($file,$str);
        if($result){
            $this->success('主题切换成功');
        }else{
            $this->error('失败，请检查是否有Home文件夹写入权限');
        }
    }

    /*删除主题方法*/

    public function del_them(){
        header("Content-type:text/html;charset=utf-8");
        $str = I('get.dir_str');
        $arr = explode(',',$str);
        array_pop($arr);
        for ($i=0; $i <count($arr) ; $i++) {
            $this->deldir($arr[$i]);
        }
        $this->success('删除成功');
    }

    /*递归删除文件夹方法*/
    public function deldir($path){
            $dh = opendir($path);
            if(!$dh){
                $this->error('当前目录不存在');
            }
             while(($d = readdir($dh)) !== false){
                 if($d == '.' || $d == '..'){//如果为.或..
                    continue;
                 }
                 $tmp = $path.'/'.$d;
                 if(!is_dir($tmp)){//如果为文件
                    unlink($tmp);
                 }else{//如果为目录
                    $this->deldir($tmp);
                 }
             }
             closedir($dh);
             rmdir($path);
     }







}
