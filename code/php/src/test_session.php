<?php
	session_start();
	echo "所在文件：".$_SERVER["PHP_SELF"]."<br/>";
	echo "用户名：{$_SESSION['login']} <br/>密码：{$_SESSION['password']}";
?>