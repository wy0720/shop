<?php
date_default_timezone_set('PRC');
return array
(
//    $config = array(
//        'rewrite' => array(
////            'admin/index.html' => 'admin/main/index',
////            'admin/<c>_<a>.html'    => 'admin/<c>/<a>',
//            '<c>/<a>'          => '<c>/<a>',
////            '/'                => 'main/index',
//        ),
//    ),
    'spUrlRewrite' => array(
        'suffix' => '.html',
        'sep' => '-',

        'map' => array(),
        'args' => array(),
    ),

    'url' => array(
        'url_path_info' => TRUE, // 是否使用path_info方式的URL
        'url_path_base' => '/index.php', // URL的根目录访问地址
    ),
    'mysql' => array
    (
        'MYSQL_HOST' => 'localhost',
        'MYSQL_PORT' => '3306',
        'MYSQL_USER' => 'root',
        'MYSQL_DB'   => 'verydows',
        'MYSQL_PASS' => '',
        'MYSQL_DB_TABLE_PRE' => 'verydows_',
        'MYSQL_CHARSET' => 'UTF8',
    ),
    
    'verydows' => array
    (
        'VERSION' => '2.0',
        'RELEASE' => '20161112',
        'COMMENCED' => '1555084800',
    ),
);