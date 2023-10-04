<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once "../app/Database.php";

$rqUri = $_SERVER['REQUEST_URI'];
//  echo("\n<br/>URI = $rqUri");
if(0) 
if(str_starts_with($rqUri,'/member')||(str_starts_with($rqUri,'/admin'))){
    if($_SESSION['userinfo'] ?? ''){
         if($_SESSION['userinfo'] ?? ''){
           if(str_starts_with($rqUri,'/admin')){
            require_once "../templates/home/header.php";
                 echo "Bạn không có quyền truy cập vùng Admin!";
            require_once "../templates/home/footer.php";
             return;
           }
         }
    }else{
        require_once "../templates/home/header.php";
        echo "Bạn không có quyền truy cập vùng này!";
        require_once "../templates/home/footer.php";
        return;
    }
 }

//Tên route: nếu giống nhau phần đầu, thì các route dài hơn được đặt ở trên để được xử lý đúng
$routes = [
    '/login' => [LoginController::class, 'login'],
    '/logout' => [LoginController::class, 'logout'],
    '/member' => [MemberController::class, 'index'],
    '/products/categories/delete' => [CategoriesController::class, 'delete'],
    '/products/categories/add' => [CategoriesController::class, 'add'],
    '/products/categories/edit' => [CategoriesController::class, 'edit'],
    '/products/categories' => [CategoriesController::class, 'list'],
    
    '/products' => [ProductsController::class, 'index'],
    
    '/admin/users/delete' => [UserController::class, 'delete'],
    '/admin/users/add' => [UserController::class, 'add'],
    '/admin/users/edit' => [UserController::class, 'edit'],
    '/admin/users' => [UserController::class, 'list'],
    '/admin' => [AdminController::class, 'index'],
    '/' => [HomeController::class, 'index'],
    


    // code cho phần sản phẩm 
    

];

foreach($routes AS $uri => $arrayCtrl){

    $class = $arrayCtrl[0];
    $method = $arrayCtrl[1];

    $file = "../app/controllers/$class.php";   

    if(str_starts_with($rqUri, $uri)){
         require_once $file;
         $obj = new $class;
         //$obj= new AdminController()
         $obj->$method();
         // $obj->index;
         
         break;
    }
}


echo("\n<hr/> DEBUG: URI = $rqUri ");
echo("\n<br/> Controller->Action: $class() -> $method() ");
echo "<pre> File includes: ";
print_r(get_included_files());
echo "</pre>";
//

