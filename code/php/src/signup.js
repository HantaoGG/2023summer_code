window.onload = function(){

  var oInput = document.getElementById('pwd');
  oInput.value = '';
  var spans = document.getElementsByTagName('span');

  oInput.onkeyup = function(){
    //强度状态设为默认
    spans[0].className = spans[1].className = spans[2].className = "default";

    var pwd = this.value;
    var result = 0;
    for(var i = 0, len = pwd.length; i < len; ++i){
      result |= charType(pwd.charCodeAt(i));
    }

    var level = 0;
    //对result进行四次循环，计算其level
    for(var i = 0; i <= 4; i++){
      if(result & 1){
        level ++;
      }
      //右移一位
      result = result >>> 1;
    }

    if(pwd.length >= 6){
      switch (level) {
        case 1:
          spans[0].className = "weak";
          break;
        case 2:
          spans[0].className = "medium";
          spans[1].className = "medium";
          break;
        case 3:
        case 4:
          spans[0].className = "strong";
          spans[1].className = "strong";
          spans[2].className = "strong";
          break;
      }
    }
  }
}

/*
定义一个函数，对给定的数分为四类(判断密码类型)，返回十进制1，2，4，8
数字 0001 -->1  48~57
小写字母 0010 -->2  97~122
大写字母 0100 -->4  65~90
特殊 1000 --> 8 其它
*/
function charType(num){
  if(num >= 48 && num <= 57){
    return 1;
  }
  if (num >= 97 && num <= 122) {
    return 2;
  }
  if (num >= 65 && num <= 90) {
    return 4;
  }
  return 8;
}

function checkPassword() {
    var pwd = document.getElementById("pwd").value; // 获取密码输入框的值
    var repwd = document.getElementById("repassword").value; // 获取确认密码输入框的值
    if (pwd === repwd) { // 如果两个值相同
      document.getElementById("repassword").setCustomValidity(""); // 设置确认密码输入框的验证状态为通过
    } else { // 如果两个值不同
      document.getElementById("repassword").setCustomValidity("两次输入的密码不相同"); // 设置确认密码输入框的验证状态为不通过，并设置自定义错误消息
    }
  }
