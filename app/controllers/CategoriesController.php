<?php
require_once '../app/models/Categories.php';
class CategoriesController
{

    public function list()
    {        
        try{
            //sort_by=username&sort_type=asc
            $sort_by = $_GET['sort_by'] ?? 0;
            $sort_type = $_GET['sort_type'] ?? 0;

            $search_name = $_GET['search_name'] ?? '';
            

            //Limit/Offset 
            $page = $_GET['page'] ?? 1;
            $limit = 5;
            $param = ['page'=>$page, 
            'limit' => $limit,
            'sort_by' => $sort_by,
            'sort_type' => $sort_type,
            'search_name'=> $search_name,
            ];

            $data = Categories::list($param);


            $total = Categories::count();
            $nPage = ceil($total / $limit);
            
            
        } catch (PDOException $e) {
            $error =  "Có lỗi: " . $e->getMessage();
            // return null;
        }

        require_once "../app/views/categorieslist.php>";
    }

    public function add()
    {

        if($_POST['name'] ?? ''){
            try{
                $ret = Categories::add($_POST);
                if($ret){
                    Header("Location: /products/categories");
                }
            } catch (PDOException $e) {
                $error =  "Có lỗi: " . $e->getMessage();
                return null;
            }
        }

        require_once "../app/views/categoriesAdd.php";
    }

    public function edit()
    {

        $ret  = null;
        if($id = ($_GET['id'] ?? '')){
            try{
                $ret = Categories::get($id);
                if($_POST['name'] ?? ''){
                    Categories::save($id, $_POST);
                    $ret = Categories::get($id);
                    $msg = "Update thành công!";
                }
                //  if($ret){
                //      Header("Location: /admin/users");
                // }
            } catch (PDOException $e) {
                $error =  "Có lỗi: " . $e->getMessage();
                return null;
            }
        }

        require_once "../app/views/categoriesEdit.php";
    }

    public function delete()
    {
        if($id = ($_GET['id'] ?? '')){
            try{
                $ret = Categories::delete($id);
                if($ret){
                    Header("Location: /products/categories");
                }
            } catch (PDOException $e) {
                echo "<br>Có lỗi: " . $e->getMessage();
                return null;
            }
        }
    }
}































        