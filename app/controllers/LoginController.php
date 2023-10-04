<?php
require_once '../app/models/User.php';
class LoginController {
    public function login() {
        // Gọi view để hiển thị trang chu
        // $_SESSION;
        // echo"<pre> SS=";
        // print_r($_SESSION);
        // echo"<pre>";
        if($_SESSION['userinfo'] ?? ''){
            $smg = "Bạn dã đăng nhập thành công!";
        }
        if($_POST['username']??''){
                $user = $_POST['username'];
                $pass = $_POST['password'];
                $ret =  User::auth($user, $pass);
                     echo"<pre>RET=";
                     print_r($ret);
                     echo"<pre>";
              if($ret){
                  $_SESSION['userinfo'] = $ret;
                  $smg = "đăng nhập thành công";
              }
              else{
                  $error = "sai tên đăng nhập or mật khẩu ";
              }
    }
        require '../app/views/auth/login.php';
    
    }
   
    public function logout(){
        session_destroy();
        header("Location:/login");
    }
}