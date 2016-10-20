<?php
return array(
    //'配置项'=>'配置值'
        'DB_TYPE'   => '[DB_TYPE]', // 数据库类型
        'DB_HOST'   => '[DB_HOST]', // 服务器地址
        'DB_NAME'   => '[DB_NAME]', // 数据库名
        'DB_USER'   => '[DB_USER]', // 用户名
        'DB_PWD'    => '[DB_PWD]',  // 密码
        'DB_PORT'   => '[DB_PORT]', // 端口
        'DB_PREFIX' => '[DB_PREFIX]', // 数据库表前缀
        'SHOW_PAGE_TRACE' =>false,  //
        'SHOW_ERROR_MSG' =>    false,
        'MODULE_DENY_LIST'      =>  array('Common','Runtime'),
        'URL_MODEL'             =>  0,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
        // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
        'URL_HTML_SUFFIX'       =>  'html',  // URL伪静态后缀设置
        'ERROR_MESSAGE'  =>    '哎呦呦，一不小心就走丢了！',
        'ERROR_PAGE' =>'./Public/Default/error_page/error.html',
         );
