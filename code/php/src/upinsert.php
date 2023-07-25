<?php

    $host = 'db';

    // Database use name
    $user = 'MYSQL_USER';

    //database user password
    $pass = 'MYSQL_PASSWORD';

    //  $conn=mysqli_connect("localhost","root","kali","blog");
    $conn=mysqli_connect($host,$user,$pass,"blog");

    include "session.php";

    $username=$_SESSION["username"];

    $sql="select * from users where user='$username'";

    $result=$conn->query($sql);

    $result=mysqli_fetch_array($result);

    $password=$result[2];

    //判断密码是否输入正确
    $hashed_password = hash("sha256", $_REQUEST["oldpassword"]);

    if(trim($password)!==$hashed_password){

        ?>

        <script> 

            alert("账户信息有误!"); 

            window.location.href="update.php"; 

        </script>

        <?php

    }
    
    
     $oldpassword=$_REQUEST["oldpassword"];

    $newpassword=$_REQUEST["newpassword"];

    $repassword=$_REQUEST["repassword"];



    $name=$_REQUEST['name'];
    
    $sql_2 = "SELECT * FROM users WHERE user='$username' AND name='$name'";
    
    $result_2=$conn->query($sql_2);
 
     if (mysqli_num_rows($result_2) == 0) {
    echo "<script>alert('账户信息有误!'); window.location.href='update.php';</script>";}

    
   
  

 

    if($newpassword!=$repassword){

        echo "<script>alert('前后输入的密码不一致!'); window.location.href=\"update.php\";</script>";}

   
  if (trim($newpassword) === trim($oldpassword)) {
    echo '<script>';
    echo 'alert("新密码不可与近期使用过的相同！");';
   
    echo 'window.location.href = "update.php";';
    echo '</script>';
  } else {
    $hashed_password = hash("sha256", $newpassword);
    $sql_3 = "UPDATE users SET pwd='$hashed_password' WHERE user='$username'";
    $result_3 = $conn->query($sql_3);
    
    // 更新密码的操作需要在这里进行
    if ($result_3) {
            echo "<script>alert('密码已更新！'); window.location.href='personal.php';</script>";
        } else {
            echo "<script>alert('密码更新失败，请重试！'); window.location.href='update.php';</script>";
        }
  }
?>

