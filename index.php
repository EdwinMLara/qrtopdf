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

    function enviar_post(location,img_data){
        var form = document.createElement('form');
        form.setAttribute('method','post');
        form.setAttribute('action',location);

        var text_area = document.createElement('input');
        text_area.setAttribute('type','hidden');
        text_area.setAttribute('name','photo');
        text_area.setAttribute('value',img_data);

        form.appendChild(text_area);
        document.getElementsByTagName('body')[0].appendChild(form);
        form.submit();
    }
  
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
        var redir = 'pruebaimage.php';
        enviar_post(redir,img_data);
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