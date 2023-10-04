<?php
require_once "../templates/products/header.php";


// echo "<pre>";
// print_r( $ret);
// echo "</pre>";
?>

Edit danh mục sản phẩm  ...

<?php 

if(isset($msg))
    echo "<p> $msg </p> ";

if(isset($error))
    echo "<p> $error </p> ";

?>

<form action="" method="post">

    Name: <input type="text" name='name' value='<?php echo $ret['name'] ?>'>
    <p></p>
    description: <input type="text" name='description' value='<?php echo $ret['description'] ?>'>
    <p></p>
    parent_id: <input type="text" name='parent_id' value=''>
    <p></p>
    <input type="submit">

</form>


<?php 



?>

<?php
require_once "../templates/products/footer.php"
?>