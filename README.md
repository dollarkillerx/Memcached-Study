# Memcached-Study
Memcached Study

## Memcached
内存对象缓存系统 KEY:VALUE存储
- 数据缓存
- 存储session
- 短信验证码存储

>安装
- 先安装libevent
```
   yum install gcc
   curl -O https://github.com/libevent/libevent/releases/download/release-2.1.8-stable/libevent-2.1.8-stable.tar.gz
   tar -xzf libevent-2.1.8-stable.tar.gz
   ./contigure --prefix=/usr
   这里遇到很多坑真的编译安装好麻烦啊
   WARNING: 'aclocal-1.15' is missing on your system
   aclocal --version
   本地版本1.11.1低了
   安装aclocal还需要一个autoconf
   curl -O http://ftp.gnu.org/gnu/autoconf/autoconf-2.69.tar.gz
   curl -O http://ftp.gnu.org/gnu/automake/automake-1.15.tar.gz
   然后就惯例./configure make && make install
   网络真慢
   ls -a /usr/lib |grep libevent
```

- 校验下载文件是否正确
``` 
    MD5:
    md5sum file
    
    SHA1:
    sha1sum file
```

- 安装Memcached
``` 
    curl -O http://memcached.org/files/memcached-1.5.12.tar.gz
    tar -zxvf memcached-1.5.12.tar.gz
    ./configure --prefix=/usr/loacl/mecacched --whit-libevent=/usr
    && make && make install
```
- 运行
``` 
    /usr/local/memcached/bin/memcached -d start -u nobody -m 1024 -p 11211 -c 2048 -P /tmp/memcached.pid
    telnet 127.0.0.1 11211 #测试服务是否开启
    ps -ef|grep memcached  #查看memcached进程 
```

- memcached运行参考
    -   -d 启动一个守护进程
    -   -m 分配给Memcached使用内存数量,单位MB,默认64MB
    -   -u 运行Memcached的用户
    -   -l 是监听服务器的IP地址,默认是所有网卡
    -   -p 设置Memcached监听的TCP端口 默认11211
    -   -c 最大运行的并发连接数 默认1024
    -   -p 设置保存Memcached的pid文件,我们这里保存到/tmp/memcached.pid
    -   -vv 用very vrebose模式启动,调试信息和错误输出到控制台
    