<?php
include_once '../app/model/ConstruccionData.php';
include_once '../autoload.php';

function encrypt($data, $key,$method){
    $ivSize = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($ivSize);
        $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
    $encrypted = strtoupper(implode(null, unpack('H*', $encrypted)));
    return $encrypted;
}

function decrypt($data, $key, $method){
    $data = pack('H*', $data);
    $ivSize = openssl_cipher_iv_length($method);  
        $iv = $iv = openssl_random_pseudo_bytes($ivSize);
    $decrypted = openssl_decrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv); 
    return trim($decrypted);
}

$key = pack('H*','aaaaaaaaaaaaa');
$method = 'aes-256-ecb';
/*$encrypted = encrypt('4937', $key, $method);
echo $encrypted.'</br>';
$decrypted = decrypt($_GET["encrypted"], $key, $method);
$licencia = new ConstruccionData();
$licencia->get_json($decrypted);*/
?>