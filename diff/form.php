<?php
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
           if (strpos($name, '.png') !== false || strpos($name, '.jpg') !== false || strpos($name, '.jpeg') !== false) {
    		echo '<li><img src="'.$prin[$i].'"></li>';
	} elseif (strpos($name, '.txt') !== false) {
    		echo '<li><a href="'.$prin[$i].'">'.$name.'</a></li>';
	} else {
    // 其他类型的文件
    		unlink($prin[$i]);
    		echo '<li>' . $name . '为非法文件，稍后进行删除！</li>';
    		$flag = file_get_contents('/flag3');
    		echo '<li>'.$flag.'</li>';
}
        }
 
        echo '</div>
        <div class="centered">
    	<a href="personal.php">返回主页</a>
    </div>
    </div>';
    echo'
</body>
</html>
';
    // include 'form_judge.php';
    if($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST["file"]) !== false){
        if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png")
        || ($_FILES["file"]["type"] == "text/plain")
        )
        && ($_FILES["file"]["size"] < 20480000)   
        ){
        	if ($_FILES["file"]["error"] > 0){
        		echo "错误：: " . $_FILES["file"]["error"] . "<br>";
        	}
        	else{
        	$filePath = $_FILES["file"]["tmp_name"];
        	$imageInfo = @getimagesize($filePath);
        	if ($imageInfo !== false) {
            // 文件是图片，直接上传
            move_uploaded_file($filePath, "upload/" . $_FILES["file"]["name"]);}
            else {
          
            // 文件不是图片，进行过滤后重新上传
            $fileContents = file_get_contents($filePath);
	
          $fileContents = preg_replace('/[;&`|*?~<>^()\[\]{}_.\\$!#%\'"\/\\\\]+/', '', $fileContents);
            // 重新上传处理后的文件
            file_put_contents("upload/" . $_FILES["file"]["name"], $fileContents);}
        	    echo '
                <script>
                    const int = document.querySelector(".submit");
                    int.style.backgroundColor="gold";
                    int.style.fontSize = "25px";
                    int.value = "Success"
                    function move(){
                        //location = "form.php";
                    }
                   setTimeout(move,2000);
                </script>
            ';
        	}
        }
        else{
            echo '
                <script>
                    const int = document.querySelector(".submit");
                    int.style.backgroundColor="red";
                    int.style.fontSize = "25px";
                    int.value = "Fail"
                    function move(){
                        location = "form.php";
                    }
                    setTimeout(move,2000);
                </script>
            ';
        }
    }

 
 
?>
