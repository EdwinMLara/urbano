<?php

function encrypt($data,$key,$method){
    $ivSize = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($ivSize);
        $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
    $encrypted = strtoupper(implode(null, unpack('H*', $encrypted)));
    return $encrypted;
}

$response = new stdClass();
if(isset($_POST["data"])){   
    $key = pack('H*','aaaaaaaaaaaaa');
    $method = 'aes-256-ecb';
    $encrypted = encrypt($_POST["data"], $key, $method);
    $response->status = "Sucess";
    $response->hash = $encrypted;
}else{
    $response->status = "Error";
    $response->hash = "";
}

echo json_encode($response);
?>