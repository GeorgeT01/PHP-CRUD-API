<?php
class parameter{

    //function validate the paramters
    function parametersCheck($params)
    {
        //assuming parameters are available 
        $available = true; 
        $missingparams = ""; 
        
        foreach($params as $param)
        {
            if(!isset($_POST[$param]) || strlen($_POST[$param])<=0)
            {
                $available = false; 
                $missingparams = $missingparams . ", " . $param; 
            }
        }
        
        //if parameters are missing 
        if(!$available)
        {
            $response = array(); 
            $response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
            //$response['message'] = 'Parameters missing';
            echo json_encode($response);
            die(); //stopping further execution
        }
    }

}
?>