<?php

use AloneWebMan\Acme\Facade;

/**
 * @param string $path 证书绝对路径目录
 * @param string $save 保存绝对路径目录
 * @return array|string
 */
function alone_acme(string $path, string $save): array|string {
    return Facade::exec($path, $save);
}