<?php
	class Nivel extends Controller{
		/*
			*****************
				Públicas
			*****************
								*/
		public function __construct(){
			}
		// Función por defecto
		public function index(){
			$this->vista('pages/inicio');
			}
		// Para cargar la vista de los niveles
		public function niveles($num_registro){
			//$datos = $this->cargarTabla($num_registro);			
			$this->vista('levels/nivel'.$num_registro/*,$datos*/);
			}
		//Para cargar las especialidades
		public function especialidad($num_registro,$especialidad){
			//Buscar un modo de conseguir la especialidad
			$datos = $this->cargarTabla($especialidad);			
			
			$this->vista('especialidades/nivel'.$num_registro.'/'.$especialidad,$datos);
			}
		/*
			*****************
				Privadas
			*****************
								*/
		//Carga los gráficos
		private function cargarGráfico($nombre){
			$param = $this->modelo('ProceduresDataModel')->procedimientos($nombre);
			$datos=[ 
				'values' => $param
			];
			return $datos;
			}
		//Carga la tabla
		private function cargarTabla($nombre){
			$param = $this->modelo('ProceduresDataModel')->tablaProcedimientos($nombre);
			$param2 = $this->modelo('ProceduresDataModel')->procedimientos($nombre);
			$param3 = $this->modelo('ProceduresDataModel')->procedimientos('Urologia');

			$param4=[
				'tabla' => $param3,
				'titulo' => ['Actividad','Meta','Realizado','Porcentaje de realización'],
			];
			$datos=[
				'values' => $param2,
				'tabla' => $param,
				'titulo' => ['Actividad','Meta','Realizado','% Realización']
				'datos 1' => $param4
			];
			return $datos;
			}
		
	}
?>