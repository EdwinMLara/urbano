var qrcode = new QRCode("qrcode");

function getBase64Image(img) {
    var canvas = img;
    var dataURL = canvas.toDataURL("image/png");
    return dataURL;
}

function tomar_imagen(){
    var div_aux = document.getElementById("qrcode");
    var nodes_div = div_aux.childNodes;
    console.log(nodes_div[0]);
    var img_data = getBase64Image(nodes_div[0]);
    var input_data_photo = document.getElementById("photo");
    input_data_photo.value = img_data; 
} 

function hash_datos(text){
    return $.ajax({
        type:'POST',
        url: "http://intranet.uriangato.gob.mx/urbano1.5/core/app/action/hash_data.php",
        dataType: "json",
        data:{data: text},
        async:false,
        success: function (response){
            console.log(response);
            if(response.status.localeCompare("Error") == 0){
                alert("Error");
            }
        }
    });

}   

function makeCode () {      
    var elText = document.getElementById("no_recibo");
    console.log(elText.value);
    if (!elText.value) {
        alert("Input a text");
        elText.focus();
        return;
    }
    var hash = hash_datos(elText.value);
    var datos = hash.responseJSON;
    console.log("Generador: ", elText);
    qrcode.makeCode(datos.hash);
}

$("#no_recibo").
on("blur", function () {
    makeCode();
    tomar_imagen();
}).
on("keydown", function (e) {
    if (e.keyCode == 13) {
        makeCode();
        tomar_imagen(); 
}
});

$(document).ready(function() {
    makeCode();
    tomar_imagen(); 
});