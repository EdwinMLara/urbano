<?php
$response = new stdClass();
if(isset($_POST["data"])){   
    $hash_data = hash('ripemd160', $_POST["data"]);
    $response->status = "Sucess";
    $response->hash = $hash_data;
}else{
    $response->status = "Error";
    $response->hash = "";
}

echo json_encode($response);
?>