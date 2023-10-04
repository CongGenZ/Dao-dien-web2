<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<b style="color: red">ADMIN</b>
<span style="float: right;">

 <?php
 if($_SESSION['userinfo'] ?? ''){
    echo $_SESSION ['userinfo']['username'];
    echo" | <a href='/login'>Logout</a>";
 }
 else{
    echo"<a href='/login'>Login</a>";
 }
  
?> 
</span>
<hr>
<a href="/">Trang Chủ</a> |
<a href="/admin/news">Tin tức</a> |
<a href="/products">Sản phẩm</a> |
<a href="/admin/orders">Đơn hàng</a> |
<a href="/admin/users">Người dùng</a>
<hr>

