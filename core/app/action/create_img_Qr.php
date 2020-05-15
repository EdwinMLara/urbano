<?php  
    if(isset($_POST["photo"])){

        $data_post = $_POST["photo"];

        $name_img = "/urbano1.4/plugins/imagenes/Qr.png";    
        $datapieces = explode(';base64,',$data_post);
        $dataEnconding = $datapieces[1];
        $dataDecoding = base64_decode($dataEnconding);

        if($dataDecoding!==false){
            file_put_contents($name_img, $dataDecoding);
        }        
    }else{
        echo "error al crear el QR";
    }
?>