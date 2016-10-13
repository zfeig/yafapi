# yafapi
扩展yaf框架，封装常用DB类，cache类，Log类,适用于api接口开发，非侵入式，简单快速高效，追求高性能api
----------

> 最快最简洁的c扩展框架+pdo原生操作数据库+c扩展redis/memcache做缓存+c扩展log日志+nginx+php7 = yafapi,使用yafapi开发的api应该不会慢!


# 扩展安装配置篇
需要安装的扩展有redis,memcache,seaslog,yaf
下载地址：[yaf](http://pecl.php.net/package/yaf) | [redis](http://pecl.php.net/package/redis) | [memcache](http://pecl.php.net/package/memcache) |  [seaslog](http://pecl.php.net/package/seaslog)

####安装方法
* 进入到下载的扩展目录，cd  download/xx //下载路径以实际情况为准
* /usr/local/php/bin/phpize  
* ./configure --with-php-config=/usr/local/php/bin/php-config
* make && make install

####php.ini扩展参数，设置好后注意重启php-fpm生效

```
[redis]
extension="redis.so"
[memcahe]
extension="memcache.so"
[opcache]
zend_extension="opcache.so"
opcache.enable=1
opcache.memory_consumption = 100
opcache.interned_strings_buffer = 8
opcache.max_accelerated_files = 5000
opcache.revalidate_freq = 240
opcache.fast_shutdown = 1
opcache.enable_cli = 1
opcache.huge_code_pages=1
[yaf]
extension="yaf.so"
yaf.environ=product
[seaslog]
extension="seaslog.so"
seaslog.level= 0
seaslog.default_basepath= "/webs/yaf/two/logs"  //路径以实际情况为准
seaslog.default_logger = logger
seaslog.disting_type = 1
seaslog.disting_by_hour = 1
seaslog.use_buffer = 1
seaslog.buffer_size = 100
seaslog.level = 0
```

####查看安装模块
命令行下 php -m 查看是否正确安装上面模块


#部署篇
为了追求高性能建议使用nginx替换apache,这里以虚拟域名yaftwo.com为例,php版本为php7



####nginx配置：

```server {
        listen 80;
        server_name [www.yaftwo.com](www.yaftwo.com);
        root /webs/yaf/two/public;
        index index.php index.html index.htm;


         location ~ .*\.(php|php5)?$ {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            include        fastcgi_params;
         }


         if (!-e $request_filename) {
             rewrite ^/(.*) /index.php?$1 last;
          }
}
```


####apache配置：[隐藏index.php的.htaccess文件放在入口文件同目录下]
* .htaccess文件, 当然也可以写在httpd.conf

```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME}
```

* httpd.conf站点配置

```
<VirtualHost *:80>
ServerAdmin zfeig
DocumentRoot /webs/yaf/two/public
ServerName [www.yaftwo.com](www.yaftwo.com)
ErrorLog "/logs/yaftwo.com.log"
CustomLog "/logs/yaftwo.com.log" common
</VirtualHost>
```

####hosts虚拟域名配置

```
127.0.0.1   [www.yaftwo.com](www.yaftwo.com)
```

####测试数据库安装
默认为mysql数据库，将根目录下article.sql导入到test数据库中，编码为utf-8


####启动
确保redis,nginx,php-fpm,mysql相关服务政策开启，即可浏览接口地址


#例子说明
本例子在根目录下application/BootStrap.php中开启了rewrite路由，实现了几个简单的接口实例
* /   默认接口,指向index控制器index方法
* /:ver/test  ,指向index控制器test方法
* /:ver/demo  ,指向index控制器demo方法
* /:ver/user/:id  ,指向index控制器user方法,绑定版本和id参数

####返回结果
访问：[http://www.yaftwo.com/v2/user/8](http://www.yaftwo.com/v2/user/8)，返回一下结果

```
{
    "status": 200,
    "msg": "获取成功",
    "result": {
        "id": "8",
        "author": "admin",
        "cid": "1",
        "add_time": "1448333293",
        "title": "关于住房公积金的管理",
        "content": "关于住房公积金的管理，由于新的政策发布，住房公积金政策继续调整，这将会日益影响一些异地工作打算回家置业的人员，这里为您详细介绍下公积金相关知识",
        "brief": "由于新的政策发布，住房公积金政策继续调整，这将会日益影响一些异地工作打算回家置业的人员",
        "version": "2"
    }
}
```