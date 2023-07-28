<?php
// print_r(traverseDir('./upload'));
include 'functions.php';

$prin = traverseDir('./upload');
 
$num = count($prin);
 
echo '
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>beink</title>
    <link rel="shortcut icon " type="images/x-icon" href="https://beink.cn/4.png">
    <link href="form.css" rel="stylesheet" type="text/css"/>

</head>
<body>
    <div class="all">
        <form action="form.php" method="post" onsubmit="return checkinput();" enctype="multipart/form-data">
            <br><br><br><input type="file" name="file" id="file"><br><br><br>
            <input type="submit" class="submit"  onclick="validate()" name="submit" value="上  传">
        </form>
            <script>
                var a = true;
                function validate(){
                    var file = document.getElementById("file").value;
                    if(file==""){
                        const int = document.querySelector(".submit");
                        int.style.backgroundColor="red";
                        int.style.fontSize = "25px";
                        int.value = "失  败"
                        function move(){
                            int.style.backgroundColor="#00a1d6";
                            int.value = "上  传"
                            int.style.fontSize = "16px";
                        }
                        setTimeout(move,2000);
                        a=false;
                        return;
                    }else{
                        a=true;
                    }
                }
                function checkinput(){
                    return a;
                }
            </script>
        <div class="fre">';
        for($i=0;$i<$num;++$i){
            if($i%5==0){
                echo '</ul><ul>';
            }
            $name = substr($prin[$i],9);
            if(strpos($name,'.png')!== false || strpos($name,'.jpg')!== false){
                echo  '<li><img src=" '.$prin[$i].' "></li>';
            }
            else{
                echo  '<li><a href="'.$prin[$i].'">'.$name.'</a></li>';
            }
            
        }
 
        echo '</div>
    </div>
</body>
</html>
';
    // include 'form_judge.php';
    if($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST["file"]) !== false){
        //$allowedExts = array("gif", "jpeg", "jpg", "png","zip","rar","tar",'tgz',"txt","xml","html","css","js");
        //$temp = explode(".", $_FILES["file"]["name"]);
        // echo $_FILES["file"]["size"];
        //$extension = end($temp);     // 获取文件后缀名
        if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png")
        || ($_FILES["file"]["type"] == "application/octet-stream")
        || ($_FILES["file"]["type"] == "application/x-tar")
        || ($_FILES["file"]["type"] == "application/x-compressed")
        || ($_FILES["file"]["type"] == "application/x-zip-compressed")
        || ($_FILES["file"]["type"] == "text/plain")
        || ($_FILES["file"]["type"] == "text/xml")
        || ($_FILES["file"]["type"] == "text/html")
        || ($_FILES["file"]["type"] == "text/css")
        || ($_FILES["file"]["type"] == "text/javascript")
        )
        && ($_FILES["file"]["size"] < 20480000)   
        //&& in_array($extension, $allowedExts))
        ){
        	if ($_FILES["file"]["error"] > 0){
        		echo "错误：: " . $_FILES["file"]["error"] . "<br>";
        	}
        	else{
        	    echo '
                <script>
                    const int = document.querySelector(".submit");
                    int.style.backgroundColor="gold";
                    int.style.fontSize = "25px";
                    int.value = "Success"
                    function move(){
                        location = "form.php";
                    }
                    setTimeout(move,2000);
                </script>
            ';
        		move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
        	}
        }
        else{
            echo '
                <script>
                    const int = document.querySelector(".submit");
                    int.style.backgroundColor="red";
                    int.style.fontSize = "25px";
                    int.value = "Failed"
                    function move(){
                        location = "form.php";
                    }
                    setTimeout(move,1000);
                </script>
            ';
        }
    }
 
 
?>