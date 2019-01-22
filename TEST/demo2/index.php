<?php
/**
 * Created by PhpStorm.
 * User: DollarKiller
 * Date: 2019/1/21
 * Time: 下午 06:42
 */
$cache = new Memcached('dollar');

//重置服务器地址池
//$cache->resetServerList();

if(!$cache->getServerList())
{
    $cache->addServers(  //不会排重
        array(
            array('127.0.0.1',11211,60),//ip 地址 权重 对应服务器池中服务器权重(服务器被选中的概率,越大机率越高)
//            array('127.0.0.1',11311.40)
        )
    );
}



//$serverList = $cache->getServerList();//获取服务器地址
//var_dump($serverList);

//设置缓存
//$cache->set();  //一次性增加一条记录
//$result = $cache->setMulti(   //通过数组的形式增加 (array,)  过期时间为时间戳
//    [
//        'key1'=>'value1',
//        'key2'=>'value2',
//        'key3'=>'value3',
//    ],time()+900
//);
//var_dump($result);

//取缓存
//$cache->get();    //一次取一对 KEY:回调函数
//$result = $cache->getMulti([  // 传入数组 批量获取  $cas cas_totals
//'key1','key2','key3'
//],$cas
//);
//
//var_dump($result,$cas);

//cas 数据唯一性
//$result = $cache->get('key1',null,$cas);//key,回调函数,cas
//
//sleep(10);
//var_dump($result,$cache);
//
//if (!$cache->cas($cas,'key1','hello',time()+900))
//{
//    var_dump($cache->getResultMessage());//getResultMessage()返回变更失败的返回值
//}
//
//$result = $cache->get('key1',null,$cas);
//
//var_dump($result);


//add 抢座 秒杀
//if (!$cache->add('key.add','1',time()+900))
//{
//    echo '不对其,作为被占用了';
//}else
//{
//    echo '抢座成功';
//}

//increment 自增 decrement 自减
//$cache->set('k.no',0,time()+900);
//var_dump($cache->increment('k.no',2)); //(key,offset步长) 返回值成功最好一个key的值 失败返回false
//var_dump($cache->decrement('k.no',1));

// prepend()前追加 append()后追加

$cache->setOption(memcached::OPT_COMPRESSION,false);//使用追加要关闭压缩

$cache->set('k.s','World',time()+900);
$cache->replace('k.s','Hello '); //返回bool
$cache->append('k.s',' Memcached');

$result = $cache->get('k.s');
var_dump($result);