## 安装指南

- 插件引入

1.0 引入redis组件
```
composer -vvv require illuminate/redis:^5.6
```

1.1 在composer.json文件里添加如下配置

```
"repositories": [
    {
        "name": "sky/base-queue",
        "type": "vcs",
        "url": "git@github.com:wangyulu/base-queue.git"
    }
]

```

1.2 在项目根目录执行

```
composer -vv require sky/base-queue:dev-master
```

- 添加ENV配置

1.1 队列配置

```
QUEUE_REDIS_CONNECTION=queue

# 忽略队列失败时默认的处理逻辑
QUEUE_FAILED_TABLE=null
```

1.2 COMMON_DB数据库配置

```
#COMMON_DB
DB_COMMON_HOST=xx
DB_COMMON_PORT=3306
DB_COMMON_DATABASE=common
DB_COMMON_USERNAME=xx
DB_COMMON_PASSWORD=xx
```

- config/database.php
```
// redis下添加如下代码
'queue' => [
    'host'     => env('QUEUE_REDIS_HOST', '127.0.0.1'),
    'port'     => env('QUEUE_REDIS_PORT', 6379),
    'database' => env('QUEUE_REDIS_DATABASE', 2),
    'password' => env('QUEUE_REDIS_PASSWORD', null),
],
```

- bootstrap/app.php
```
// 去除如下代码的注释

// $app->withFacades();

// $app->withEloquent();


// 添加如下代码
$app->singleton(Illuminate\Contracts\Bus\Dispatcher::class,
    \Sky\BaseQueue\Providers\AdapterBusServiceProvider::class
);

$app->register(Illuminate\Redis\RedisServiceProvider::class);
$app->register(\Sky\BaseQueue\Providers\AdapterBusServiceProvider::class);
```