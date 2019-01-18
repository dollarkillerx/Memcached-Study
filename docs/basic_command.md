## set命令

将 value(数据值) 存储在指定的 key(键) 中。  
如果set的key已经存在，更新key所对应的数据。

### 语法：
```
set key flags exptime bytes [noreply]
value
```

### 参数:
  * `key`: 键值 key-value 结构中的 key，用于查找缓存值
  * `flags`：可以包括键值对的整型参数，客户机使用它存储关于键值对的额外信息
  * `exptime` : 在缓存中保存键值对的时间长度（以秒为单位，0 表示永远）
  * `bytes` : 在缓存中存储的字节长度
  * `noreply（可选）` : 该参数告知服务器不需要返回数据(若设置了noreply参数则没有输出)
  * `value` : 存储的值 (回车第二行)

### 输出信息:
  * `STORED` : 保存成功后输出
  * `ERROR` : 保存出错或语法错误

### 示例:

  ```
  set db 0 900 5 noreply
  hello
  ```

## get命令
  获取存储在 key(键) 中的 value(数据值)  
  如果 key 不存在，则返回空。

### 语法：
  ```
  get key key1 key2
  ```

## gets命令

获取带有 CAS 令牌存 的 value(数据值)  
如果 key 不存在，则返回空。

### 语法：

  ```
  gets key key1 key2
  ```

在 使用 gets 命令的输出结果中，在最后一列的数字 代表当前key 的 CAS 令牌。

## cas命令

  CAS（Check-And-Set 或 Compare-And-Swap） 命令用于执行一个"检查并设置"的操作  
  仅当前客户端最后一次取值后，该key 对应的值没有被其他客户端修改的情况下， 才能够将值写入。  
  检查是通过cas_token参数进行的， 这个参数是Memcach指定给已经存在的元素的一个唯一的64位值。

### 语法：

  ```
  cas key flags exptime bytes unique_cas_token [noreply]
  value
  ```

### 参数说明:

  * `key`: 键值 key-value 结构中的 key，用于查找缓存值
  * `flags`：可以包括键值对的整型参数，客户机使用它存储关于键值对的额外信息
  * `exptime` : 在缓存中保存键值对的时间长度（以秒为单位，0 表示永远）
  * `bytes` : 在缓存中存储的字节长度
  * `unique_cas_token` : 通过 gets 命令获取的一个唯一的64位值。
  * `noreply（可选）` : 该参数告知服务器不需要返回数据(若设置了noreply参数则没有输出)
  * `value` : 存储的值 (回车第二行)

### 输出信息说明:

  * `STORED` : 保存成功后输出
  * `ERROR ` : 保存出错或语法错误
  * `EXISTS ` : 在最后一次取值后另外一个用户也在更新该数据
  * `NOT_FOUND ` : Memcached 服务上不存在该键值

### 示例:

      ```
      add db 0 900 5
      hello
      ```

## add命令

  将 value(数据值) 存储在指定的 key(键) 中。  
  如果 add 的 key 已经存在，则不会更新数据，之前的值将仍然保持相同，并且您将获得响应 `NOT_STORED`。

### 语法：

  ```
  add key flags exptime bytes [noreply]
  value
  ```

### 参数说明:

  * `key`: 键值 key-value 结构中的 key，用于查找缓存值
  * `flags`：可以包括键值对的整型参数，客户机使用它存储关于键值对的额外信息
  * `exptime` : 在缓存中保存键值对的时间长度（以秒为单位，0 表示永远）
  * `bytes` : 在缓存中存储的字节长度
  * `noreply（可选）` : 该参数告知服务器不需要返回数据(若设置了noreply参数则没有输出)
  * `value` : 存储的值 (回车第二行)

### 输出信息说明:

  * `STORED` : 保存成功后输出
  * `NOT_STORED ` : key已存在, value不变
  * `ERROR` : 保存出错或语法错误

### 示例:

    ```
    add db 0 900 5
    hello
    ```

## delete 命令

删除已存在的 key(键)。

### 语法：
  ```
  delete key [noreply]
  ```
### 参数说明:

  * `key`: 键值 key-value 结构中的 key，用于查找缓存值
  * `noreply（可选）` : 该参数告知服务器不需要返回数据(若设置了noreply参数则没有输出)

### 输出信息说明:

  * `DELETED` : 成功
  * `ERROR ` : 语法错误或删除失败
  * `NOT_FOUND ` ：key 不存在     



## replace命令

替换已存在的 key(键) 的 value(数据值)。  
如果 key 不存在，则替换失败，并且您将获得响应 NOT_STORED。

### 语法：
  ```
  replace key flags exptime bytes [noreply]
  value
  ```

### 参数说明:

  * `key`: 键值 key-value 结构中的 key，用于查找缓存值
  * `flags`：可以包括键值对的整型参数，客户机使用它存储关于键值对的额外信息
  * `exptime` : 在缓存中保存键值对的时间长度（以秒为单位，0 表示永远）
  * `bytes` : 在缓存中存储的字节长度
  * `noreply（可选）` : 该参数告知服务器不需要返回数据(若设置了noreply参数则没有输出)
  * `value` : 存储的值 (回车第二行)    

### 输出信息说明:
  * `STORED` : 成功
  * `NOT_STORED ` : key 不存在，替换失败      

### 示例:

  ```
  add db 0 900 5
  hello

  replace db 0 900 5
  world
  ```



## prepend / append 命令

向已存在 key(键) 的 value(数据值) 前面（后面）追加数据 。

### 语法：

  ```
  # 在前面追加

  prepend key flags exptime bytes [noreply]
  value

  # 在后面追加

  append key flags exptime bytes [noreply]
  value
  ```
### 参数说明:

  * `key`: 键值 key-value 结构中的 key，用于查找缓存值
  * `flags`：可以包括键值对的整型参数，客户机使用它存储关于键值对的额外信息
  * `exptime` : 在缓存中保存键值对的时间长度（以秒为单位，0 表示永远）
  * `bytes` : 在缓存中存储的字节长度
  * `noreply（可选）` : 该参数告知服务器不需要返回数据(若设置了noreply参数则没有输出)
  * `value` : 存储的值 (回车第二行)    

### 输出信息说明:
  * `STORED` : 成功
  * `NOT_STORED ` : 失败  
  * `CLIENT_ERROR` :错误    

### 示例:

  ```
  set db 0 900 5
  world

  prepend db 0 900 6
  hello

  apeend db 0 900 1
  !
  ```

## incr  / decr  命令

对已存在的 key(键) 的数字值进行自增或自减操作。  
incr 与 decr 命令操作的数据必须是十进制的32位无符号整数。  
如果 key 不存在返回 NOT_FOUND，如果键的值不为数字，则返回 CLIENT_ERROR，其他错误返回 ERROR。
### 语法：
```
incr key increment_value
decr key decrement_value
```

### 参数说明:

  * `key`: 键值 key-value 结构中的 key，用于查找缓存值
  * `increment_value`：增加的数值。  
  * `decrement_value`：减少的数值。

### 输出信息说明:
  * `NOT_FOUND：key ` : key 不存在
  * `CLIENT_ERROR ` : value不是数字 
  * `ERROR` :其他错误，如语法错误等   

### 示例:

  ```
  set db 0 900 5
  1

  incr db 3
  4

  decr db 2
  2
  ```