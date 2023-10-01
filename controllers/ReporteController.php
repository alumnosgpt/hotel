<?php

namespace Controllers;

use Mpdf\Mpdf;
use MVC\Router;

class ReporteController {
    public static function pdf (Router $router){
        $saludo = $_GET['variable'];

        //consulta a la BD 


        $data = [1,3,4,3,9];
        $userData = "DANIEL FUENTES";
        $grado = "Alférez";
        $mpdf = new Mpdf([
            "orientation" => "P",
            "default_font_size" => 12,
            "default_font" => "arial",
            "format" => "Letter",
            "mode" => 'utf-8'
        ]);
        $mpdf->SetMargins(30,35,25);

        $html = $router->load('reporte/pdf',[
            'userData' => $userData,
            'grado' => $grado,
            "data" => $data
        ]);
        $htmlHeader = $router->load('reporte/header', [
            'hotel portal del lago' => $saludo
        ]);
        $htmlFooter = $router->load('reporte/footer');
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->SetHTMLFooter($htmlFooter);
        // echo $html;
        // exit;
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        

    }
}