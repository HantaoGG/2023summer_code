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
    $title = preg_replace( "/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t>/i","", @$_POST['title']);

    $author=$_SESSION['username'];

    $content=$_POST['content'];
    $content = preg_replace( "/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t>/i","", @$_POST['content']);
    if ($title && $author && $content) {
        $sql = "INSERT INTO articles(title, author, content) VALUES(?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $title, $author, $content);
        $stmt->execute();
        $stmt->close();
    
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

