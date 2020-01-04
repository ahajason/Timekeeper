# 2020/01/02
今天重新在本地部署了我的Timekeeper，没想到部署地并不顺利，自己的项目花了一个多小时。  
想laravel和php内置的服务器启动项目比较麻烦每次需要手动启动服务器，故想用nginx来作为服务器。linux上的会自动配置，而且工作比较熟用的比较多，公司有文档比较好解决。但window，好像没有拆分出子配置文件，需配置开机自启服务。
### 1. 下载安装配置  
下载:  没问题；  
安装:  自己喜欢的目录；  
命令（win）: 要到nginx根目录才能跑nginx？  
`start nginx` 启动nginx  
`nginx -s reload` 重新加载nginx  
`php-cgi.exe -b 127.0.0.1:9000 -c D:\env\php-7.0.31-nts-Win32-VC14-x64\php.ini`
配置: 
```
## nginx-1.17.7\confnginx.conf
    server {
        listen       80;
        server_name  timekeeper.dev.com;
        root D:\Projects\Timekeeper\public;
        location / {
            index  index.php index.html index.htm;
            try_files $uri $uri/ /index.php?$query_string;
        }
        error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root   html;
        }
        location ~ \.php$ {
            fastcgi_split_path_info ^(.+\.php)(/.+)$;
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            include        fastcgi_params;
        }
    }
```
windows10 安装php-cgi.exe为服务:  
1. [下载WinSW工具](https://github.com/kohsuke/winsw/releases)  
 （下载 .exe 文件即可，根据系统选择，Win 10 选择 .NET4 版本，以下选择 .NET2 版本）  
2. [下载xxfpm，用来开启 php-cgi 多进程](https://codeload.github.com/78/xxfpm/zip/master)  
3. php的服务注册需要先下载xxfpm，将下载的xxfpm.exe 和 pthreadGC2.dll 扔进php-cgi.exe所在的目录
4. 安装php-cgi为服务  
将下载到的`WinSW.NET4.exe`更名为`php-cgi-service.exe`  
放到`php-cgi.exe`所在的目录下，在该目录下新增文件   
`php-cgi-service.xml`，修改`php-cgi-service.xml`配置如下：  
```
<service>
    <id>php-cgi</id>
    <name>php-cgi</name>
    <description>php-cgi</description>
    <executable>xxfpm.exe</executable>
    <startargument>"D:/php/php-cgi.exe -c D:/php/php.ini"</startargument>
    <startargument>-n</startargument>
    <startargument>1</startargument>
    <startargument>-i</startargument>
    <startargument>127.0.0.1</startargument>
    <startargument>-p</startargument>
    <startargument>9000</startargument>
    <stopexecutable>taskkill</stopexecutable>
    <stopargument>/F</stopargument>
    <stopargument>/IM</stopargument>
    <stopargument>xxfpm.exe</stopargument>
    <logpath>logs</logpath>
</service>
```
5.使用管理员权限打开CMD执行

php-cgi-service.exe install，即可生成windows服务
 
# 开启php-cgi服务
net start php-cgi
```
配置env；
php artisan key:generate

mysql -r root -p
CREATE DATABASE `timekeeper` DEFAULT CHARACTER SET utf-8 COLLATE utf8_general_ci;
# DROP DATABASE `xxx`; 删除数据库
# ALTER DATABASE `db_name` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci

php artisan migrate
```
### 3.nginx开机自启
[Windows service wrapper](https://github.com/kohsuke/winsw/releases)  
`winsw-1.18-bin.xml`  
```
<service>
  <id>nginx</id>
  <name>Nginx Service</name>
  <description>High Performance Nginx Service</description>
  <logpath>D:\env\nginx-1.17.7\logs</logpath>
  <log mode="roll-by-size">
    <sizeThreshold>10240</sizeThreshold>
    <keepFiles>8</keepFiles>
  </log>
  <executable>D:\env\nginx-1.17.7\nginx.exe</executable>
  <startarguments>-p D:\env\nginx-1.17.7</startarguments>
  <stopexecutable>D:\env\nginx-1.17.7nginx.exe</stopexecutable>
  <stoparguments>-p D:\env\nginx-1.17.7 -s stop</stoparguments>
</service>
```

```
winsw-1.18-bin.exe install
```
不过window下次还是使用IIS或集成的apache\nginx， 毕竟IIS更适配window，效率更高，安装配置更方便。

遗留问题：前端编译的webpack配置

# 2020/01/01
`composer require`  
`yarn`  
 etc.  