#!/bin/bash

# 设置目标文件夹的权限为 777
chmod -R 777 /var/www/html/php/src/upload

chmod -R 777 /var/www/html/php/src

# 运行传递给容器的命令
exec "$@"
