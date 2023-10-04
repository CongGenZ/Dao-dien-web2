<?php
class Categories
{

    public static function delete($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM products_categories WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function add($params)
    {

        $conn = Database::getConnection();
        $name = $params['name'];
        $description= $params['description'];
        $parent_id = $params['parent_id'];

        /////////////////////////////////////
        //Cách cơ bản này có thể insert được, nhưng dễ bị tấn công SQL Injection:
        $sql = "INSERT INTO products_categories (name, description,parent_id)
        VALUES ('$name','$description','$parent_id')";
        //return $conn->exec($sql);

        // $sql = "INSERT INTO users (username, email, password)
        //  VALUES ('$username', '$email', '$password')";    // use exec() because no results are returned
        //$conn->exec($sql);
        //echo "New record created succesfully";

        //Ta nên dùng cách nâng cao sau để insert, là php_mysql_prepared_statements
        //Tham khảo: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $stmt = $conn->prepare("INSERT INTO products_categories (name, description, parent_id) 
        VALUES (:name, :description, :parent_id)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':parent_id', $parent_id); //Password có thể cần thêm băm để bảo mật
        return $stmt->execute();
    }


    public static function save($id, $params)
    {

        $conn = Database::getConnection();
        $name = $params['name'];
        $description = $params['description'];
        $parent_id = $params['parent_id'];

        // $sql = "INSERT INTO users (username, email, password)
        //  VALUES ('$username', '$email', '$password')";    // use exec() because no results are returned
        //$conn->exec($sql);
        //echo "New record created succesfully";

        //Ta nên dùng cách nâng cao sau để insert, là php_mysql_prepared_statements
        //Tham khảo: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $stmt = $conn->prepare("UPDATE products_categories SET name = :name, description=:description, parent_id=:parent_id WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':parent_id', $parent_id); //Password có thể cần thêm băm để bảo mật
        return $stmt->execute();
    }

    public static function get($id)
    {
        $conn = Database::getConnection();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        $stmt = $conn->prepare("SELECT * FROM products_categories WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ret = $stmt->fetchAll();
        if ($ret)
            return $ret[0];
        return null;
    }

    public static function count($param = null)
    {
        $conn = Database::getConnection();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        $stmt = $conn->prepare("SELECT count(*) AS c FROM products_categories");
        $stmt->execute();
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ret = $stmt->fetchAll();
        return $ret[0]['c'];
    }

    public static function list($param)
    {
        $page = $param['page'];
        //Page = 0 -> offset = 0,
        //Page = 1 -> offset = 5,
        //Page = 2 -> offset = 10,...
        $limit = $param['limit'];
        $offset = ($page - 1) * $limit;

        $sort_by = $param['sort_by'];
        $sort_type = $param['sort_type'];
        $search_name = $param['search_name'];

        $searchString = null;
        if($search_name){
            $searchString = " WHERE name LIKE :search_name ";
        }
        

        $sql = "SELECT * FROM products_categories $searchString LIMIT :limit OFFSET :offset";

        if(in_array($sort_by, ['name', 'description']))
            if(in_array($sort_type, ['asc', 'desc']))
                $sql = "SELECT * FROM $searchString products_categories ORDER BY $sort_by $sort_type LIMIT :limit OFFSET :offset";
        
        // echo "<pre>";
        // print_r($param);
        // echo "</pre>";
        // die($sql);

        $conn = Database::getConnection();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        if($search_name){
            $search_name = "%$search_name%";
            $stmt->bindParam(':search_name', $search_name);
        }

        $stmt->execute();

        //$stmt->debugDumpParams();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ret = $stmt->fetchAll();
        return $ret;
    }
}
