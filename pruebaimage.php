<?php
    $msj = new stdClass();    
    if(isset($_POST["photo"])){

        $data_post = $_POST["photo"];
        echo strlen($data_post);
        echo $data_post."<br>";

        $name_img = "nueva_co4.png";    
        $datapieces = explode(';base64,',$data_post);
        $dataEnconding = $datapieces[1];
        $dataDecoding = base64_decode($dataEnconding);

        if($dataDecoding!==false){
            if(file_put_contents($name_img, $dataDecoding)!==false){
                ob_start();
                    require("PDF_Flowingblock.php");
                    $pdf = new FPDF();
                    $pdf->AddPage();
                    $pdf->Image('descarga.png',10,6,20);
                    $pdf->Output();
                ob_end_flush();
                //  Delete image from server
                //unlink($name_img);
            }
        }        
        $msj->status = "Actualizado";
    }else{
        $msj->status = "Error";
    }

        echo json_encode($msj);
?>