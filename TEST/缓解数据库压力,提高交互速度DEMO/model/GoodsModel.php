<?php
header('content-type:text/html;charset=utf8');
/**
 * Created by PhpStorm.
 * User: DollarKiller
 * Date: 2019/1/21
 * Time: 下午 08:49
 */

namespace GoodModel;

use lib\Memcache;

require_once '../lib/MemCache.php';

class GoodsModel extends BaseModel
{
    /**
     * 查询商品
     * @param $id
     * @return array|bool|mixed
     */
    public function findOneGoodsById($id)
    {
        if (!$id)
        {
            return false;
        }
        $cache = new Memcache\MemCache();
        $key = 'goods.'.$id;
        //判断商品是否存在,if不存在则查询DATABASE并且生成缓存
        if (!$goods = $cache->get(key))
        {
            //查询商品主表
            $goods = array();

            //查询商品详情表
            $goods['info'] = array();

            //查询商品规格表
            $goods['attr'] = array();

            //查询商品图片表
            $goods['pic_list'] = array();

//            生成缓存
            $cache->set($key,$goods,7200);
        }
        return $goods;
    }

    /**
     * 更新数据并且更新缓存
     * @param $array
     * @param $id
     * @return bool
     */
    public function updateGoods($array,$id)
    {
        if (empty($array)||empty($id)||!is_array($array))
        {
            return false;
        }

        //更新数据库处理结果
        $result = true;

        if ($result !== false)
        {
            $this->clearGoods($id);
        }
        return $result;

    }

    /**
     * 删除商品并删除缓存
     * @param $id
     * @return bool
     */
    public function deleteGoods($id)
    {
        //删除数据
        $result = true;
        if ($result)
        {
            $this->clearGoods($id);
        }
        return $result;
    }

    /**
     * 删除缓存
     * @param $id
     * @return bool
     */
    public function clearGoods($id)
    {
        if (!$id)
        {
            return false;
        }
        $cache = new Memcache\MemCache();
        $key = 'goods.'.$id;

        return $cache->clear($key);
    }
}