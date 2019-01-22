<?php
/**
 * Created by PhpStorm.
 * User: DollarKiller
 * Date: 2019/1/21
 * Time: 下午 08:05
 */
namespace lib\Memcache;
class MemCache
{
    public  $_memcache;
    public function __construct($persistentId = null)
    {
        $cache = new \Memcached($persistentId);

        if (!$cache->getServerList())
        {
            //从config文件中读取服务器地址
            $cache->addServers(
                ['127.0.0.1',11211,60]
            );
        }

        //key 前缀设置
        $cache->setOption(\Memcached::OPT_PREFIX_KEY,'dollar');
        $this->_memcache = $cache;
    }

    /**
     * 设置缓存
     * @param string    $key   缓存Key
     * @param string|array  $value
     * @param int   $ttl    过期时间
     * @return bool
     */
    public function set($key,$value,$ttl = 3600)
    {
        if (empty($key) || empty($value))
        {
            return false;
        }
        return $this->_memcache->set($key,$value,$_SERVER['REQUEST_TIME']+$ttl);
    }

    /**
     * get缓存
     * @param $key
     * @return bool|mixed
     */
    public function get($key)
    {
        if (empty($key))
        {
            return false;
        }

        return $this->_memcache->get($key);
    }


    /**
     * 清空缓存
     * @param $key
     * @return bool
     */
    public function clear($key)
    {
        if (empty($key))
        {
            return false;
        }
        return $this->_memcache->delete($key);
    }

    /**
     * 自增
     * @param $key
     * @param $offset
     * @return bool|int
     */
    public function incr($key,$offset = 1)
    {
        if (empty($key) || empty($offset))
        {
            return false;
        }
        $offset = intval($offset);
        return $this->_memcache->increment($key,$offset);
    }

    /**
     * 自减
     * @param $key
     * @param int $offset
     * @return bool|int
     */
    public function decr($key,$offset = 1)
    {
        if (empty($key) || empty($offset))
        {
            return false;
        }
        $offset = intval($offset);
        return $this->_memcache->decrement($key,$offset);
    }

    /**
     * add处理
     * @param $key
     * @param $value
     * @param int $ttl
     * @return bool
     */
    public function add($key,$value,$ttl = 3600)
    {
        if (empty($key)||empty($value)||is_numeric($ttl))
        {
            return false;
        }
        return $this->_memcache->add($key,$value,$_SERVER['REQUEST_TIME']+$ttl);
    }

}