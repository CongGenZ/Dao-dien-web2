<?php
require_once "../templates/products/header.php"
?>

Add danh  mục sản phẩm  ...

<?php 
if(isset($msg))
    echo "<p> $msg </p> ";
if(isset($error))
    echo "<p> $error </p> ";

?>

<form action="" method="post">

    Name: <input type="text" name='name' >
    <p></p>
    Description: <input type="text" name='description' >
    <p></p>
    parent_id: <input type="test" name='parent_id' >
    <p></p>
    <input type="submit">

</form>


<?php 



?>

<?php
require_once "../templates/products/footer.php"
?>
