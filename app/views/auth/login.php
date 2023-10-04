<?php 
require_once "../templates/home/header.php"
?>

LOGIN
<?php 

if(isset($smg)){
    echo "<p> $smg</p> ";
}
if(isset($error)){
    echo "<p> $error </p> ";
}

    if($_SESSION['userinfo'] ??''){
       echo ("\n<a href ='/logout'> Đăng suất </a>");
    }
    else{

?>
<p></p>
<form action="" method="post">
    Tài Khoản :<input type="text" name="username" placeholder="nhập email,tên tài khoản ...">
    <p></p>
    Mật Khẩu :<input type="password" name="password" id="" placeholder="nhập mật khẩu...">
    <p></p>
    <input type="submit" value="Đăng Nhập">
</form>
    
<?php 
}

require_once "../templates/home/footer.php"
?>