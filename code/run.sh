#!/bin/bash

/entrypoint.sh

/usr/local/bin/permission.sh

# 启动 Apache web 服务器
apache2-foreground

echo "$@"
