<?php
return array(
    //'配置项'=>'配置值'
        // 数据库类型
        'DB_TYPE'   => 'mysql',
        // 服务器地址
        'DB_HOST'   => '127.0.0.1',
        // 数据库名
        'DB_NAME'   => 'lcm',
        // 用户名
        'DB_USER'   => 'root',
        // 密码
        'DB_PWD'    => '',
        // 端口
        'DB_PORT'   => '3306',
        // 数据库表前缀
        'DB_PREFIX' => 'blog_',
        // 打印页面信息
        'SHOW_PAGE_TRACE' =>false,
        // 打印错误信息
        'SHOW_ERROR_MSG' =>    false,
        // 禁止访问的模块列表
        'MODULE_DENY_LIST'      =>  array('Common','Runtime'),
        // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
        'URL_MODEL'             =>  0,
        // URL伪静态后缀设置
        'URL_HTML_SUFFIX'       =>  'html',
        // 错误提示
        'ERROR_MESSAGE'  =>    '哎呦呦，一不小心就走丢了',
        // 错误页面配置
        'ERROR_PAGE' =>'./Public/Default/error_page/error.html',
         );
