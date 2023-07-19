<?php 
    $host = 'db';

    // Database use name
    $user = 'MYSQL_USER';

    //database user password
    $pass = 'MYSQL_PASSWORD';
    $sql=mysqli_connect($host,$user,$pass,"blog");

if (!$sql){

    die("链接失败：".mysqli_err());

}

mysqli_select_db($sql,"blog");

mysqli_query($sql,"set names 'gbk'");

?>