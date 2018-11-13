<?php
class Controlador_Reuma extends Controller
{
    public function __construct()
    {
        $this->modelo = $this->modelo("Model_Reuma");
    }

    public function index(){
        $this->vista("reportes/reuma/index");
    }
    
    public function reporte_diario(){
        if($_SERVER['REQUEST_METHOD']== 'POST')
        {
            $fecha = $_POST['fecha'];
            $informacionModelo = $this->modelo->reporte_diario($fecha);
            $data = [
                "info" => $informacionModelo
            ];
            $this->vista("reportes/reuma/reuma",$data);
        }
        else{
            $this->vista("reportes/reuma/reuma_diario");
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
            $this->vista("reportes/reuma/reuma",$data);
        }
        else{
            $this->vista("reportes/reuma/reuma_rango");
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
            $this->vista("reportes/reuma/reuma",$data);
        }
        else{
            $this->vista("reportes/reuma/reuma_mes");
        }
    }
} 
?> 