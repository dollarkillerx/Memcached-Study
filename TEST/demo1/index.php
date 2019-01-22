<?php
require_once 'config.php';

echo "session:{$_SESSION['user_no']}".var_dump($_SESSION['user_no']);

//用户已经登录
if(isset($_SESSION['user_no']) && !empty($_SESSION['user_no']))
{
    echo "欢迎回来 {$_SESSION['user_name']} 你已经登录";
}else{
    if(isset($_GET['user_no']) && intval($_GET['user_no']) == 2019)
    {
        $_SESSION['user_no'] = intval($_GET['user_no']);
        $_SESSION['user_name'] = trim($_GET['user_name']);
        $key = ini_get('memcached.sess_prefix').session_id();
        echo "登录成功 {$_SESSION['user_no']} key:{$key}";
    }else{
        echo '参数错误请重新输入';
    }
}
