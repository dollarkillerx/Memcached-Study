<?php
//设置session储存介质为memcached
ini_set('session.save_handler','memcached');

//设置session储存memcached服务器的端口地址
ini_set('session.save_path','127.0.0.1:11211');

//设置cookie名称
ini_set('session.name','dollar_id');

//设置session生存时间
ini_set('session.gc_maxlifetime',3600);

//设置session存储在memcached key前缀
ini_set('memcached.sess_prefix','memc.dollar.');

session_start();
