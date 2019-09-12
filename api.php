<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'product.php';
include 'parametersCheck.php';

$param = new parameter();

//an array to display response
$response = array();
//if it is an api call 
//that means a get parameter named api call is set in the URL 
//and with this parameter we are concluding that it is an api call
if(isset($_GET['apicall']))
{
    
    switch($_GET['apicall'])
    {
        case 'getProduct':
            $db = new product();
            $result = $db->getProduct();
            if($result)
            {
                // set response code - 200 OK
                http_response_code(200);
                $response['message'] = 'Request successfully completed';
                $response['products'] = $db->getProduct();
            }else{
                // set response code - 404 Not found
                http_response_code(404);
                $response['message'] = 'Request Error!';
            }
        break;
        
        case 'createProduct':
            //check the parameters required for this request
            $param->parametersCheck(array('name', 'price', 'description'));
            $db = new product();
            $result = $db->createProduct(
                $_POST['name'], 
                $_POST['price'],
                $_POST['description']);
            if($result)
            {
                // set response code - 201 created
                http_response_code(201);
                $response['message'] = 'Product successfully created';
            }else{
                // set response code - 503 service unavailable
                http_response_code(503);
                $response['message'] = 'Error!';
            }
        break;

        case 'updateProduct':
        //check the parameters required for this request
        $param->parametersCheck(array('id', 'name', 'price', 'description'));
        $db = new product();
        $result = $db->updateProduct(
            $_POST['id'],
            $_POST['name'], 
            $_POST['price'],
            $_POST['description']);
        if($result)
        {
            // set response code - 200 ok
            http_response_code(200);
            $response['message'] = 'Product successfully updated';
        }else{
            // set response code - 503 service unavailable
            http_response_code(503);
            $response['message'] = 'Error!';
        }
        break;
    
        case 'deleteProduct':
        //check the parameters required for this request
        $param->parametersCheck('id');
        $db = new product();
        $result = $db->deleteProduct($_POST['id']);
        if($result)
        {
            // set response code - 200 OK
            http_response_code(200);
            $response['message'] = 'Product successfully deleted';
        }else{
            // set response code - 503 service unavailable
            http_response_code(503);
            $response['message'] = 'Error!';
        }
        break;

    }
}else
{
    $response['message'] = 'Invalid API';
}
 
    //display response in json structure 
    echo json_encode($response);
?>
