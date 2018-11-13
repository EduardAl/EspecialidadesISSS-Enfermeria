<?php
class Controlador_Urologia extends Controller
{
    public function __construct()
    {
        $this->modeloUrologia = $this->modelo("Model_Urologia");
    }

    public function index(){
        $this->vista("reportes/urologia/index");
    }
    
    public function reporte_diario(){
        if($_SERVER['REQUEST_METHOD']== 'POST')
        {
            $fecha = $_POST['fecha'];
            $informacionModelo = $this->modeloUrologia->reporte_diario($fecha);
            $data = [
                "info" => $informacionModelo
            ];
            $this->vista("reportes/urologia/urologia",$data);
        }
        else{
            $this->vista("reportes/urologia/urologia_diario");
        }
    }

    public function reporte_rango(){
        if($_SERVER['REQUEST_METHOD']== 'POST')
        {
            $fecha1 = $_POST['fecha_1'];
            $fecha2 = $_POST['fecha_2'];
            $informacionModelo = $this->modeloUrologia->reporte_rango($fecha1,$fecha2);
            $data = [
                "info" => $informacionModelo
            ];
            $this->vista("reportes/urologia/urologia",$data);
        }
        else{
            $this->vista("reportes/urologia/urologia_rango");
        }
    }

    public function reporte_mensual(){
        if($_SERVER['REQUEST_METHOD']== 'POST')
        {
            $mes = $_POST['mes'];
            $informacionModelo = $this->modeloUrologia->reporte_mensual($mes);
            $data = [
                "info" => $informacionModelo
            ];
            $this->vista("reportes/urologia/urologia",$data);
        }
        else{
            $this->vista("reportes/urologia/urologia_mes");
        }
    }
} 
?> 