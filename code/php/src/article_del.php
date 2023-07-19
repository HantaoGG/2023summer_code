<?php
    session_start();
    $host = 'db';

    // Database use name
    $user = 'MYSQL_USER';

    //database user password
    $pass = 'MYSQL_PASSWORD';

    // $conn=mysqli_connect("localhost","root","kali","articles");
    $conn=mysqli_connect($host,$user,$pass,"blog");

    include "session.php";

    include "connect.php";

    $id=$_GET['id'];
    $author=$_SESSION['username'];

    $sql="delete from articles where id='$id' AND author='$author'";
    //$sql="select from articles where id='$id' AND author='$author'";
    $conn->query($sql);

   if (mysqli_affected_rows($conn) == 0) {
    echo "<script>alert('删除失败！');window.location.href='article_list.php';</script>";
} else {
    echo "<script>alert('删除成功！');window.location.href='article_list.php';</script>";
}
?>
