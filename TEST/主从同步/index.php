<?php
header('content-type:text/html;charset=utf8');
/**
 * Created by PhpStorm.
 * User: DollarKiller
 * Date: 2019/1/21
 * Time: 下午 09:31
 */

//用户设置转赠


$donation = [
    'user_id' => 1,
    'integral'=> 30,
    'time' => $_SERVER['REQUEST_TIME'],
    'status' => 1
];

//写入数据库转正表
$donationId = 123;

//donation.php?id=123 控制器

