<?php
header('content-type:text/html;charset=utf8');
/**
 * Created by PhpStorm.
 * User: DollarKiller
 * Date: 2019/1/21
 * Time: 下午 09:31
 */
$cache = new lib\Memcache\MemCache();

$id = intval($_GET['id']);

//查询转赠记录表

//查询记录
$where = [
  'id'=>$id,
  'status'=>1,//未被转赠
];

//查询结果
$result = true;

if ($result){
    //其他人已经领取了主从未同步的情况
    if ($cache->get("donation:{$id}")) {
        echo '已被领取';
    }else{
        if ($cache->add("donation:{$id}",true,1200)){
            $update = [
                'to_user_id'=>'b',
                'status'=>2,
                'donation_time'=>$_SERVER['REQUEST_TIME']
            ];
            echo '恭喜你领取成功';
        }else{
            echo '已经被领取';
        }
    }
}else{
    echo '已被领取';
}