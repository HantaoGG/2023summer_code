<?php

    // error_reporting(0);

    $host = 'db';

    // Database use name
    $user = 'MYSQL_USER';

    //database user password
    $pass = 'MYSQL_PASSWORD';

    $conn=@mysqli_connect($host,$user,$pass,"blog");

    session_start();

    $username=$_POST['username'];

    $password=$_POST['password'];


if ($username && $password) {

    include "connect.php";

    // 使用参数化查询
    $sql = "SELECT * FROM users WHERE user = ? AND pwd = ?";
    $stmt = $conn->prepare($sql);

    // 绑定
    $stmt->bind_param("ss", $username, hash("sha256", $password));

    // 执行
    $stmt->execute();

    // 获取结果
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['login'] = mt_rand(0, 100000);

        header("refresh:0;url=personal.php");
        exit;
    } else {
        ?>

        <script>
            alert("用户名或密码错误!");
        </script>
        <script>
            window.location.href='index.html';
        </script>

        <?php
    }

} else {
    ?>

    <script>
        alert("用户名或密码为空!");
    </script>
    <script>
        window.location.href = 'index.html';
    </script>

<?php
}
?>
