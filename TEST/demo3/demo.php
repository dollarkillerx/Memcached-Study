<?php
/**
 * Created by PhpStorm.
 * User: DollarKiller
 * Date: 2019/1/21
 * Time: 下午 08:24
 */
require_once './lib/MemCache.php';

$cache = new \lib\Memcache\MemCache();

$result = $cache->set('key','value1',300);
var_dump($result);
$result = $cache->get('key');
var_dump($result);