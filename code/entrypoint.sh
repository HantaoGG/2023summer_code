#!/bin/bash

# 进入容器后执行的命令
echo 'flag{xxx1}' > /flag1
echo 'flag{xxx2}' > /flag2
echo 'flag{xxx3}' > /flag3

# 运行传递给容器的命令
exec "$@"
