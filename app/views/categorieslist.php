<?php
require_once "../templates/products/header.php"
?>

Danh mục sản phẩm | <a href="/products/categories/add">Add </a>


<form action="" method="get">
Tìm name: <input type="text" name='search_name' value="<?php echo $_GET['search_name'] ?? '' ?>">
<input type="submit" value="Tìm">
</form>


<?php 
if(isset($msg))
    echo "<p> $msg </p> ";
if(isset($error))
    echo "<p> $error </p> ";

?>
<p></p>
Trang: 
<?php
    if(isset($nPage))
    for($i = 1; $i <= $nPage ; $i++){
        echo("\n <a href='/products/categories?page=$i'> $i </a> | ");
    }
    $sort_type = "asc";
    if($_GET['sort_type'] ?? ''){
        $sort_type = $_GET['sort_type'];
        if($sort_type == 'asc')
            $sort_type = 'desc';
        else
            $sort_type = 'asc';
    }
?>

<table border="1">
    <tr>
<td>Id</td>
<td> <a href="/products/categories?sort_by=name&sort_type=<?php echo $sort_type  ?>"> 
Name </a></td>
<td> <a href="/products/categories?sort_by=description&sort_type=<?php echo $sort_type  ?>"> 
Description </a></td>

<td>Action</td>

    </tr>
<?php 

    if(isset($data))
    foreach($data AS $one){
        $id = $one['id'];
        $name = $one['name'];
        $description = $one['description'];
        // $first_name = $one['first_name'];
        // $last_name = $one['last_name'];

        echo("\n<tr>");

        
        echo("\n<td>  $id </td> <td> $name  </td> <td> $description </td>");
        echo("\n<td> <a href='/products/categories/edit?id=$id'>  Edit </a> | 
        <a href='/products/categories/delete?id=$id'>  Delete </a> </td>");
        echo("\n</tr>");
    }
?>
</table>




<?php
require_once "../templates/products/footer.php"
?>

