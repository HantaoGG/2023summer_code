<?php

    $host = 'db';

    // Database use name
    $user = 'MYSQL_USER';

    //database user password
    $pass = 'MYSQL_PASSWORD';

    // $conn=mysqli_connect("localhost","root","kali","articles");
    $conn=mysqli_connect($host,$user,$pass,"blog");

    include "session.php";

    include "connect.php";

    $title=$_POST['title'];
    $title = preg_replace( "/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t>/i", "", @$_POST['title']);
    $title = str_replace('alert', '', $title);  //替换alert
    $title = htmlentities($title) ;
 
    $author=$_SESSION['username'];

    $content=$_POST['content'];
    $content = preg_replace( "/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t>/i","", @$_POST['content']);
    $content = str_replace('alert', '', $content);  //alert
    $content = htmlentities($content) ;

    if($title&&$author&&$content){

        $sql="INSERT INTO articles(title,author,content) VALUES('$title','$author','$content')";

        $conn->query($sql);

        ?>

        <script>

            alert("文章发布成功!");

            window.location.href="personal.php";

    </script>

    <?php

    }else{

        ?>

        <script>

            alert("文章发布失败!标题、作者、内容可能为空！");

            window.location.href="new_article.html";

    </script>

    <?php

    }

    ?>

