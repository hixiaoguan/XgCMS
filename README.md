## 环境要求：
	PHP >= 5.5.9

	OpenSSL PHP Extension

	PDO PHP Extension

	Mbstring PHP Extension

	Tokenizer PHP Extension

## 配置：
复制.env.example 为.env
配置数据库，又拍云地址相关信息

### 1.数据库信息配置
    DB_HOST=localhost
    DB_DATABASE=dbname
    DB_USERNAME=root
    DB_PASSWORD=root

### 2.又拍云信息设置
    UPYUN_BUCKETNAME=bucketname
    UPYUN_USERNAME=username
    UPYUN_PASSWORD=******
    UPYUN_DOMAIN=https://bucketname.b0.upaiyun.com
    UPYUN_PATH=/posts/

### 3.这里是超级管理员账号和域名设置
    SUPER_NAME=admin
    SUPER_PASS=admin888
    SUPER_DOMAIN=localhost


## 安装扩展插件：
    composer install
    
## 项目初始化：    
    php artisan init

