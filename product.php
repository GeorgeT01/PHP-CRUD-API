<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

require_once 'config/dbConfig.php';

$response = array();

class product extends DbConnect 
{
    private $table = "product";
    
    public function getProduct()
    {
        $query = "SELECT *FROM $this->table ORDER BY id DESC";
        $result = $this->connect()->query($query);
        if($result)
    {
        $products = array();
        while ($row=mysqli_fetch_array($result))
        {
            $product  = array();
            $product['id'] =  $row['id'];
            $product['name'] = $row['name'];
            $product['price'] =  $row['price'];
            $product['description'] = $row['description']; 
    
            array_push($products, $product); 
        }
        return $products; 
    }
    return false;
    }

    public function createProduct($name, $price, $description)
    {
        $_name = $this->connect()->real_escape_string($name);
        $_price = $this->connect()->real_escape_string($price);
        $_description = $this->connect()->real_escape_string($description);

        $query = "INSERT INTO $this->table (name, price, description) VALUES ('$_name', '$_price', '$_description')";
        $result = $this->connect()->query($query);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function updateProduct($id, $name, $price, $description)
    {
        $_name = $this->connect()->real_escape_string($name);
        $_price = $this->connect()->real_escape_string($price);
        $_description = $this->connect()->real_escape_string($description);

        $query = "UPDATE $this->table 
        SET name = '$_name', 
            price = '$_price',
            description = '$_description'
        WHERE id = '$id' ";
        $result = $this->connect()->query($query);

        if($result)
        {
            return true;
        }
        return false;
    }

    public function deleteProduct($id)
    {
        $query = "DELETE FROM $this->table WHERE id = '$id'";
        $result = $this->connect()->query($query);
        if($result)
        {
            return true;
        }
        return false;
    }
}

















?>
