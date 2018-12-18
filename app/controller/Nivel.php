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

			if(isset($_POST['cbOrdenar'])){
				$fecha1 = (isset($_POST['fecha1']))?$_POST['fecha1']:date("Y/m/d");
				$fecha2 = (isset($_POST['fecha2']))?$_POST['fecha2']:date("Y/m/d");
				$tiempo = [
					'tipo'=>$_POST['cbOrdenar'],
					'fecha1'=>$fecha1,
					'fecha2'=>$fecha2,
				];
				unset($_SESSION['tiempo']);
	      		$_SESSION['tiempo'] = $tiempo;
				header('Location:'.RUTA_URL."/Nivel/Especialidades/$num_registro/$especialidad/1");
			}
			else
			{
				$datos = [
					'datos1'=>$this->cargarProcedimientos($especialidad),
					'datos2'=>$this->cargarDatosEspecialidades($especialidad),
					'fechaT'=>'Mes Actual',
				];			
				$this->vista('especialidades/nivel'.$num_registro.'/'.$especialidad,$datos);
			}
			}
		public function especialidades($num_registro,$especialidad,$tiempo){
			//Buscar un modo de conseguir la especialidad
			$tiempo = $_SESSION['tiempo'];
			$fechaT="Mes Actual";
			if($tiempo['tipo']=="Year"){
				$fechaT="Año Actual";
			}
			else if($tiempo['tipo']=="Per"){
				$fechaT="Desde <em>".$tiempo['fecha1']."</em> hasta <em>".$tiempo['fecha2']."</em>";
			}
			$datos = [
				'datos1'=>$this->cargarProcedimientos($especialidad,$tiempo),
				'datos2'=>$this->cargarDatosEspecialidades($especialidad,$tiempo),
				'fechaT'=>$fechaT,
				'tiempo'=>$tiempo,
			];			
			$this->vista('especialidades/nivel'.$num_registro.'/'.$especialidad,$datos);
			}
		/*
			*****************
				Privadas
			*****************
								*/
		//Carga la tabla y gráfico
		private function cargarProcedimientos($nombre,$tiempo=0){
			$param = $this->modelo('ProceduresDataModel')->procedimientos($nombre,$tiempo);
			$datos=[
				'values' => $param,
				'titulo' => ['Actividad','Meta','Realizado','% Realización'],
			];
			return $datos;
			}
			private function cargarDatosEspecialidades($nombre,$tiempo=0){
				//Modificar los títulos
			$param = $this->modelo('ProceduresDataModel')->datosEspecialidades($nombre,$tiempo);
			$datos=[
				'values' => $param,
				'titulo' => ['Actividad','Cantidad'],
			];
			return $datos;
			}
		
	}
?>