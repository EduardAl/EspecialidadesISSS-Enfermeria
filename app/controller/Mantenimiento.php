<?php
	class Mantenimiento extends Controller{
		public function __construct(){
		}
		public function index(){
			$this->vista('pages/inicio');
		}
		public function Procedimiento($nombre){
			$this->vista('pages/configuracion');
		}
		public function Nivel($nivel){
			//Cargamos todo lo que debe tener
			$this->mantenimientoRecarga($nivel);
		}
		public function IngresoNivel($nivel){
			//Esto se divide entre la cantidad de columnas
			$level = $nivel;
			switch ($level) {
				case 4:
					$nivel = 'cuarto';
					break;
				case 5:
					$nivel = 'quinto';
					break;
				case 6:
					$nivel = 'sexto';
					break;
				case 7:
					$nivel = 'septimo';
					break;				
			}
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarLevelThings($nivel,$data[$i],$_POST[$data[$i]]);
			}
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}
		public function IngresoProcedimiento($nivel,$especialidad){
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarProcedimiento($_POST[$data[$i]],$data[$i]);
			}
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}

		public function IngresoEspecialidad($nivel,$especialidad){
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarSpecialtyThings($especialidad,$data[$i],$_POST[$data[$i]]);
			}
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}

		private function mantenimientoRecarga($nivel){
			$level = $nivel;
			switch ($level) {
				case 4:
					$nivel = 'cuarto';
					break;
				case 5:
					$nivel = 'quinto';
					break;
				case 6:
					$nivel = 'sexto';
					break;
				case 7:
					$nivel = 'septimo';
					break;				
			}

			$model = $this->modelo('MantenimientosModel');
			$levelThings = $model->levelThings();
			$especialidades = $model->specialities($nivel);
			$specialty = $model->specialtyThings();
			$procedures = $model->procedures($nivel,$especialidades);
			$datos=[
				'levelThings' => $levelThings,
				'especialidades' => $especialidades,
				'specialty' => $specialty,
				'procedures' => $procedures
			];
			$this->vista('mantenimientos/nivel'.$level,$datos);
		}
	}

?>
