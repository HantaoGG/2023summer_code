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

    $username=$_SESSION['username'];

    $sql="select * from users where user = '$username'";

    $result=$conn->query($sql);

    $result=mysqli_fetch_array($result);

    $name=$result[2];

    $email=$result[3];

    ?>

    <h1 class="info_h1">个人主页</h1>

    <div class="info_div">

    <?php

        echo '<p class="info_show">'."用户名：".$username.'</p>';

        echo '<p class="info_show">'."姓名：".$name.'</p>';

        echo '<p class="info_show">'."Email：".$email.'</p>';

        ?>

    <a  href="new_article.html">发布文章</a>

    <a  href="article_list.php">查看文章</a>

    <a  href="update.php">修改资料</a>

    <a  href="logout.php">退出登录</a>

    </div>

</body>

</html>

