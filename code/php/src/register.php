<?php 
    $host = 'db';

    // Database use name
    $user = 'MYSQL_USER';

    //database user password
    $pass = 'MYSQL_PASSWORD';

    //  $conn=mysqli_connect("localhost","root","kali","blog");
    $conn=mysqli_connect($host,$user,$pass,"blog");

    $username=$_REQUEST["username"]; 

    $password=$_REQUEST["password"]; 
    
    $hashed_password= hash("sha256", $password);


    include "connect.php";
    $sql= "select * from users where user='$username'";
    $result=mysqli_query($conn,$sql) or die( mysqli_error($conn));

    $result=mysqli_fetch_array($result) ;

    $user=$result[1];

    if(!is_null($user)){ 
   
  ?> 

  <script type="text/javascript"> 

    alert("用户已存在"); 

    window.location.href="signup.html"; 

  </script>  

  <?php 

    } 

    $name=$_REQUEST['name'];

    $email=$_REQUEST['email'];
    
    $sql="INSERT INTO users(user,pwd,name,email) VALUES('$username','$hashed_password','$name','$email')";

    $conn->query($sql);  

  ?> 

  <script type="text/javascript"> 

    alert("注册成功!马上登录!"); 
     window.location.href="index.html"; 
  </script> 

    

