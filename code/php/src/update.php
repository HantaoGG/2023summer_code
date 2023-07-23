<?php

    include "session.php";
    $username = $_SESSION['username'];
    ?>
<link href="update.css" rel="stylesheet" type="text/css"/>

<body>



<div class="update_div">

    <form action="upinsert.php" method="post">
        <h1>更新资料</h1>
        
        <p class="update_btn">用户名无法更改:<br> <?php echo $username; ?></p>
        <form id="myForm" onsubmit="checkForm()">
        <input class="update_text" type="password" name="oldpassword" placeholder="旧密码">
        
         <input id ="pwd"class="update_text" type="password" name="newpassword" placeholder="新密码:长度为6位以上"minlength="6" >
        
        <div class="update_text"><label  for="">密  码  强  度：</label><span>弱</span><span>中</span><span>强</span> </div>     

        <input id ="repassword" class="update_text" type="password" name="repassword" placeholder="确认密码" minlength="6">

        <input class="update_text" type="text" name="name" placeholder="请输入注册时的姓名再次验证身份">

        <input class="update_btn" type="submit" value="确认修改" onclick="checkForm()">

        <a href="personal.php">返回主页</a>
     </form>
    </form>

</div> 

</body>

<style type="text/css">
        .default {background: #eeeeee;}
        .weak {background: #FF0000;}
        .medium {background: #FF9900;}
        .strong {background: #33CC00;}
        input {height: 20px; line-height: 20px;width: 210px;}
        span {display: inline-block;width: 50px;height: 30px;line-height: 30px;background: #ddd;text-align: center;margin: 4px 2px;}
</style>

<script src="signup.js"></script>

