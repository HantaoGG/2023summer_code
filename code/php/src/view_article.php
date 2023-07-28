<?php
    $host = 'db';

    // Database use name
    $user = 'MYSQL_USER';

    //database user password
    $pass = 'MYSQL_PASSWORD';

    //  $conn=mysqli_connect("localhost","root","kali","articles");
    $conn=mysqli_connect($host,$user,$pass,"blog");

    include "session.php";

    include "connect.php";

    $id=$_GET['id'];

    $sql="select * from articles where id='$id'";

    $result=$conn->query($sql);

    $result=mysqli_fetch_array($result);
    
    $content = $result[3];
    
    $has_alert = strpos($content, 'alert(')  !== false;
    // 输出文章内容
    //echo $content;
    // 如果文章内容中包含弹窗函数，则输出提示信息
    if ($has_alert) {
        $flag = file_get_contents('/flag2');
        echo '<div style="color:red;font-weight:bold;text-align:center;">'.$flag.'</div>';
}
    ?>
   
    <link href="view.css" rel="stylesheet" type="text/css"/>

    <div class="view_div">

    <form>

        <h1>文章内容</h1>

        <h3>标题</h3>

        <?php echo $result[1];?>

        <h3>作者</h3>

        <?php echo $result[2];?>

        <h3>内容</h3>

        <?php echo $result[3];?>

        <a href="personal.php">返回主页</a>

    </form>

    </div>

