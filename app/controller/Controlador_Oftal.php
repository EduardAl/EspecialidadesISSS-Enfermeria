<?php
class Controlador_Oftal extends Controller
{
    public function __construct()
    {
        $this->modelo = $this->modelo("Model_Oftal");
    }

    public function index(){
        $this->vista("reportes/Oftal/index");
    }
    
    public function reporte_diario(){
        if($_SERVER['REQUEST_METHOD']== 'POST')
        {
            $fecha = $_POST['fecha'];
            $informacionModelo = $this->modelo->reporte_diario($fecha);
            $data = [
                "info" => $informacionModelo
            ];
            $this->vista("reportes/Oftal/oftal",$data);
        }
        else{
            $this->vista("reportes/oftal/oftal_diario");
        }
    }

    public function reporte_rango(){
        if($_SERVER['REQUEST_METHOD']== 'POST')
        {
            $fecha1 = $_POST['fecha_1'];
            $fecha2 = $_POST['fecha_2'];
            $informacionModelo = $this->modelo->reporte_rango($fecha1,$fecha2);
            $data = [
                "info" => $informacionModelo
            ];
            $this->vista("reportes/oftal/oftal",$data);
        }
        else{
            $this->vista("reportes/oftal/oftal_rango");
        }
    }

    public function reporte_mensual(){
        if($_SERVER['REQUEST_METHOD']== 'POST')
        {
            $mes = $_POST['mes'];
            $informacionModelo = $this->modelo->reporte_mensual($mes);
            $data = [
                "info" => $informacionModelo
            ];
            $this->vista("reportes/oftal/oftal",$data);
        }
        else{
            $this->vista("reportes/oftal/oftal_mes");
        }
    }
} 
?> 