<!DOCTYPE html>
<html lang="en">
    <style>
        #qrcode {
            width:160px;
            height:160px;
            margin-top:15px;
        }
    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<input id="text" type="text" value="https://www.youtube.com" style="width:80%" />
<br />
<div id="qrcode"></div>
<script src="JQuery.js"></script> 
<script src="qrcode.min.js"></script> 
<script>
    var qrcode = new QRCode("qrcode");

    function getBase64Image(img) {
        var canvas = document.createElement("canvas");
        var dataURL = canvas.toDataURL("image/png");
        console.log(dataURL);
        return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");

    }
    
    function tomar_imagen(){
        var img = $("#qrcode img");
        var img_data = getBase64Image(img[0]);
        console.log(img_data);
        //window.location.href = "pruebaimage.php?photo=" + img_data;
        /*$.ajax({
            type:"Post",
            dataType:'json',
            url:'pruebaimage.php',
            data:{photo: img_data},
            success:function(msj){
                alert(msj.status);
            }
		});*/
    }   

    function makeCode () {      
        var elText = document.getElementById("text");
        
        if (!elText.value) {
            alert("Input a text");
            elText.focus();
            return;
        }
        
       qrcode.makeCode(elText.value);
    }

    $("#text").
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

    makeCode();
    
       
</script>   
</body>
</html>