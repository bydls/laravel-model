# laravel-model
模块初始化
##### 用途：

一键快速生成指定的Model层实例。

##### 指定框架：

laravel



##### 使用方法：

1. 安装组件

   ```
   composer require bydls/laravel-model
   ```

   

2. 注册服务（bootstrap/app.php）

   ```
   $app->register( bydls\LaravelModel\Provider\GeneratorServiceProvider::class);
   ```

   

3. 查看命令

   ```
   $ php artisan bydls:laravel-model --help
   ```

   看到如下提示：

   ```
   Usage:
     bydls:laravel-model [options]
   
   Options:
         --table-name[=TABLE-NAME]            表名称
         --class-name[=CLASS-NAME]            类名称 [default: "表名称的驼峰写法"]
         --base-class-name[=BASE-CLASS-NAME]  继承的基类名称
         --output-path[=OUTPUT-PATH]          生成文件地址,相对路径 [default: "./Models"]
         --namespace[=NAMESPACE]              命名空间 [default: "App\Models"]
         --no-timestamps[=NO-TIMESTAMPS]      将timestamps属性设置为false [default: true]
         --connection[=CONNECTION]            连接的数据库
         --backup                             是否备份源文件,默认不备份
     -h, --help                               Display this help message
   ```

   



##### 快速生成model实类的命令：

```
php artisan bydls:laravel-model --table-name  account_bank
```

执行完毕，在app/Models 下生成一个对应的文件 AccountBank.php，内容如下：

```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id 
 * @property int $app_id 平台ID
 * @property int $plat_member_id 用户ID
 * @property string $account_name 用户名
 * @property string $account_bank 银行卡名称
 * @property string $account_number 银行卡号
 * @property int $state 1正常  2 已上传 申请书  3审核中  7审核不通过 -1禁用 
 * @property string $create_time 
 * @property string $old_account_number 上一次有效卡
 */
class AccountBank extends Model
{
    /**
     * 与模型关联的表
     * 
     * @var string
     */
    protected $table = 'account_bank';

    /**
     * @var array
     */
    protected $fillable = ['app_id', 'plat_member_id', 'account_name',  'account_bank', 'account_number', 'state', 'create_time',  'old_account_number'];

    /**
     * 是否应为模型添加时间戳
     * 
     * @var bool
     */
    public $timestamps = false;

}

```





参考文件：

[^https://github.com/krlove/eloquent-model-generator]: 
[^https://learnku.com/docs/laravel/6.x/migrations/5173]: 

