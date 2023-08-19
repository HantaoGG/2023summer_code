<?php
    include "session.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>个人信息</title>

    <link href="personal.css" rel="stylesheet" type="text/css"/>

</head>

<body>

<?php
    // include "session.php";
    $conn=mysqli_connect('db','MYSQL_USER','MYSQL_PASSWORD',"blog");
    
    if($_SESSION['username']){

    $username=$_SESSION['username'];
    
    $username = addslashes($username);

    $sql="select * from users where user = '$username'";

    $result=$conn->query($sql);

    $result=mysqli_fetch_array($result);

    if (empty($result[4])) { // 如果 $email 为空
    // 在客户端弹出提示框
    $flag = file_get_contents('/flag1');
    echo "恭喜你成功利用SQL注入漏洞！";
    $email=$flag;
}   
    else{ $email=$result[4];}}
    else{$username="bug";
    $email="bug";}
    ?>

    <h1 class="info_h1">个人主页</h1>

    <div class="info_div">

    <?php

        echo '<p class="info_show">'."用户名：".$username.'</p>';

        echo '<p class="info_show">'."Email：".$email.'</p>';

        ?>
        
    <h2 class="info_h1">功能列表</h2>

    <a  href="new_article.html">发布文章</a>

    <a  href="article_list.php">查看文章</a>
        
    <a  href="form.php">随手分享</a>
        
    <a  href="update.php">修改资料</a>

    <a  href="logout.php">退出登录</a>

    </div>

</body>

</html>

