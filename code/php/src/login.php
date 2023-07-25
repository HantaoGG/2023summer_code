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
    
    if($username && $password){

        include "connect.php";
        $hashed_password= hash("sha256", $password);
        
        $sql = "select * from users where user = '$username' and pwd='$hashed_password'";
        $result = $conn->query($sql);
        $rows=$result->num_rows;
        $row = $result->fetch_assoc();
        if($row){

            $_SESSION['username']=$username;
            $_SESSION['password']=$password;
            $_SESSION['login']=mt_rand(0,100000);

            header("refresh:0;url=personal.php");

            exit;

        }else{  

        ?>

            <script>

                alert("用户名或密码错误!");

            </script>

            <script>

               window.location.href='index.html';

            </script>

        <?php

        }

    }else{
        ?>

            <script>

                alert("用户名或密码为空!");

            </script>

            <script>

                window.location.href='index.html';

            </script>

    <?php

    }

    ?>

