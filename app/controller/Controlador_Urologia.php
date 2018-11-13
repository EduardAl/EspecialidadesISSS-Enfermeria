<?php
class Controlador_Urologia extends Controller
{
    public function __construct()
    {
        $this->modeloUrologia = $this->modelo("Report_Urologia");
    }

    public function index(){
        $informacionModelo = $this->modeloUrologia->reporte_diario();

        $data = [
            "info" => $informacionModelo
        ];
        $this->vista("reportes/urologia",$data);
    }
} 
?> 