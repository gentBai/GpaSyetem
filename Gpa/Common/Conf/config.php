<?php
return array(
    //'配置项'=>'配置值'
     // 开启调试模式
    'APP_DEBUG' => true,
    //路由模式
    'URL_MODEL'          => '2',
    //大小写不敏感
    'URL_CASE_INSENSITIVE' =>true,
    //路由规则开启
    'URL_ROUTER_ON'   => true,
    //默认模块
    'DEFAULT_MODULE' => 'Teacher',
    //模块列表
    'MODULE_LIST' => 'Teacher,Admin,Student',
    //默认主题
    'DEFAULT_THEME' => 'default',
    //扩展配置文件
    'LOAD_EXT_CONFIG' => 'config_db,config_routes',
    //主页
    'HOME_PAGE' => '/',
    //Public文件目录
    'PUBLIC_URL' => '/Public/',
    //Js
    'JS_URL' => '/Public/Js/',
    //Css
    'CSS_URL' => '/Public/Css/',
    //Image
    'IMG_URL' => '/Public/Image/',
    //Html
    'HTML_URL' => '/Public/Html/',
    //session 自动打开
    'SESSION_AUTO_START' => true,
    // URL变量绑定到操作方法作为参数
    'URL_PARAMS_BIND' => true,
);
