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
			$this->vista('levels/nivel'.$num_registro);
			}

		public function Nivel(){
			//$datos = $this->cargarTabla($num_registro);			
			$this->vista('Pages/Niveles'/*,$datos*/);
			}

		//Para cargar las especialidades
		public function especialidad($num_registro,$especialidad){
			//Buscar un modo de conseguir la especialidad
			$datos = [
				'datos1'=>$this->cargarProcedimientos($especialidad),
				'datos2'=>$this->cargarDatosEspecialidades($especialidad),
			];			
			
			$this->vista('especialidades/nivel'.$num_registro.'/'.$especialidad,$datos);
			}
		/*
			*****************
				Privadas
			*****************
								*/
		//Carga la tabla y gráfico
		private function cargarProcedimientos($nombre){
			$param = $this->modelo('ProceduresDataModel')->procedimientos($nombre);
			$datos=[
				'values' => $param,
				'titulo' => ['Actividad','Meta','Realizado','% Realización'],
			];
			return $datos;
			}
			private function cargarDatosEspecialidades($nombre){
				//Modificar los títulos
			$param = $this->modelo('ProceduresDataModel')->datosEspecialidades($nombre);
			$datos=[
				'values' => $param,
				'titulo' => ['Actividad','Cantidad'],
			];
			return $datos;
			}
		
	}
?>