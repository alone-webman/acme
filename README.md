# acme证书转换成各种环境

### 安装

```text
composer require alone-webman/acme
```

### 使用方法

```php
/**
 * @param string $path 证书绝对路径目录
 * @param string $save 保存绝对路径目录
 * @return array|string
 */
alone_acme(string $path, string $save);
```

## 在webman中使用

* 使用此仓库要安装 https://www.workerman.net/doc/webman/plugin/console.html

```text
composer require webman/console
```

### 配置 `config/plugin/alone/acme/app.php`

```php
<?php
return [
    'enable' => true,
    /*
     * 证书转换配置
     * php webman alone:acme [name]
     */
    'config' => [
        'demo' => [
            'path' => "证书绝对路径目录",
            'save' => "保存绝对路径目录"
        ]
    ]
];
  ```

### 命令 `php webman alone:acme [name]`

* [name]是config中的key
* 没有输入name默认第1个

```text
php webman alone:acme demo
```