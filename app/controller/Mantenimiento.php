<?php
	class Mantenimiento extends Controller{

		public function __construct(){}

		public function index(){
			$this->vista('pages/inicio');
			}

		public function Nivel($nivel=''){
			//Cargamos todo lo que debe tener

			if(strtolower($nivel)=='enfermeria')
				$this->mantenimientoDepto();
			else
				$this->mantenimientoRecarga($nivel);
			}

		public function IngresoNivel($nivel=''){
			//Ingreso de los datos del nivel
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
				case 'enfermeria':
					$nivel = 'enfermeria';
					break;			
			}
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
			$this->modelo('MantenimientosModel')->insertarLevelThings($nivel,$data[$i],$_POST[$data[$i]],$tiempo);
			}
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}

		public function IngresoProcedimiento($nivel='',$especialidad=''){
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarProcedimiento($_POST[$data[$i]],$data[$i],$tiempo);
			}
			$_SESSION['cambiado']=3;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}

		public function IngresoEspecialidad($nivel='',$especialidad=''){
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarSpecialtyThings($especialidad,$data[$i],$_POST[$data[$i]],$tiempo);
			}
			$_SESSION['cambiado']=2;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}

		public function IngresoMeta($nivel='',$especialidad=''){
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarGoal($especialidad,$data[$i],$_POST[$data[$i]],$tiempo);
			}
			$_SESSION['cambiado']=3;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}

		public function IngresoAusentismo($nivel=''){
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
				case 'enfermeria':
					$nivel = 'enfermeria';
					break;		
			}		
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarAusentismo($nivel, $data[$i], $_POST[$data[$i]], $_POST[$data[++$i]], $tiempo);
			}
			$_SESSION['cambiado']=5;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}

		public function IngresoAdministrativo($nivel=''){
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
				case 'enfermeria':
					$nivel = 'enfermeria';
					break;			
			}			
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarAdministrativo($nivel,$data[$i],$_POST[$data[$i]],$tiempo);
			}
			$_SESSION['cambiado']=7;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}

		public function IngresoAdministracion($nivel=''){
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
				case 'enfermeria':
					$nivel = 'enfermeria';
					break;			
			}
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarAdministrativo2($nivel,$data[$i],$_POST[$data[$i]],$tiempo);
			}
			$_SESSION['cambiado']=12;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			} 

		public function IngresoCharla($nivel=''){
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
				case 'enfermeria':
					$nivel = 'enfermeria';
					break;			
			}
			if(isset($_POST['fname'])&&isset($_POST['tipo']))
				$this->modelo('MantenimientosModel')->insertarCharla($nivel,$_POST['fname'],$_POST['tipo'],$_POST['fechaC']);
			$_SESSION['cambiado']=6;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}

		public function IngresoInvestigacion($nivel=''){
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
				case 'enfermeria':
					$nivel = 'enfermeria';
					break;			
			}
			if(isset($_POST['fname'])&&isset($_POST['description']))
				$this->modelo('MantenimientosModel')->insertarInvestigacion($nivel,$_POST['fname'],$_POST['description'],$_POST['estado'],$_POST['fechaC']);
			$_SESSION['cambiado']=10;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}

		public function IngresoReunion($nivel=''){
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
				case 'enfermeria':
					$nivel = 'enfermeria';
					break;			
			}
			if(isset($_POST['fname'])&&isset($_POST['description']))
				$this->modelo('MantenimientosModel')->insertarReunion($nivel,$_POST['fname'],$_POST['description'],$_POST['estado'],$_POST['fechaC']);
			$_SESSION['cambiado']=11;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}

		public function ActualizarEducacion(){
			if(isset($_POST['id'])){
				$id=$_POST['id'];
				unset($_POST['id']);
			}
			if(isset($_POST['level'])){
				$level=$_POST['level'];
				unset($_POST['level']);
			}
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				if($_POST[$data[$i]]>0)
					$data2[]=$_POST[$data[$i]];
				else
					$data2[]=0;
			}
			if(isset($data2)){
				$this->modelo('MantenimientosModel')->actualizarEducacion($id,$data2);
				$_SESSION['cambiado']=6;
				switch ($level) {
					case 'Cuarto nivel':
						$level=4;
						break;
					case 'Quinto nivel':
						$level=5;
						break;
					case 'Sexto nivel':
						$level=6;
						break;
					case 'Séptimo nivel':
						$level=7;
						break;	
					default:
						$level = 'enfermeria';
						break;
				}
				header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}
			else
				header('Location:'.RUTA_URL.'/Pages/index');
			}

		public function ActualizarCharla(){
			//Esto se divide entre la cantidad de columnas
			$nivel=(isset($_POST['level']))?$_POST['level']:'Cuarto nivel';
			$level = $nivel;
			switch ($level) {
				case 'Cuarto nivel':
					$nivel = 4;
					break;
				case 'Quinto nivel':
					$nivel = 5;
					break;
				case 'Sexto nivel':
					$nivel = 6;
					break;
				case 'Séptimo nivel':
					$nivel = 7;
					break;	
				default:
					$nivel = 'enfermeria';
					break;			
			}
			if(isset($_POST['fname'])&&isset($_POST['tipo'])){
				$this->modelo('MantenimientosModel')->actualizarCharla($_POST);
					$_SESSION['cambiado']=6;
					header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}
			else{
				header('Location:'.RUTA_URL.'/Pages/index/');
			}
			}	

		public function ActualizarInv(){
			//Esto se divide entre la cantidad de columnas
			$nivel=(isset($_POST['level']))?$_POST['level']:'Cuarto nivel';
			$level = $nivel;
			switch ($level) {
				case 'Cuarto nivel':
					$nivel = 4;
					break;
				case 'Quinto nivel':
					$nivel = 5;
					break;
				case 'Sexto nivel':
					$nivel = 6;
					break;
				case 'Séptimo nivel':
					$nivel = 7;
					break;	
				default:
					$nivel = 'enfermeria';
					break;				
			}
			if(isset($_POST['fname'])&&isset($_POST['estado'])){
				$this->modelo('MantenimientosModel')->actualizarInvestigacion($_POST);
					$_SESSION['cambiado']=10;
					header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}
			else{
				header('Location:'.RUTA_URL.'/Pages/index/');
			}
			}	

		public function ActualizarReu(){
			//Esto se divide entre la cantidad de columnas
			$nivel=(isset($_POST['level']))?$_POST['level']:'Cuarto nivel';
			$level = $nivel;
			switch ($level) {
				case 'Cuarto nivel':
					$nivel = 4;
					break;
				case 'Quinto nivel':
					$nivel = 5;
					break;
				case 'Sexto nivel':
					$nivel = 6;
					break;
				case 'Séptimo nivel':
					$nivel = 7;
					break;	
				default:
					$nivel = 'enfermeria';
					break;				
			}
			if(isset($_POST['fname'])&&isset($_POST['estado'])){
				$this->modelo('MantenimientosModel')->actualizarReunion($_POST);
					$_SESSION['cambiado']=11;
					header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}
			else{
				header('Location:'.RUTA_URL.'/Pages/index/');
			}
			}	

		public function ConfigurarAusentismo($nivel=''){
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
				default:
					$nivel = 'enfermeria';
					break;				
			}
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				if($_POST[$data[$i]]>0)
					$data2[]=$_POST[$data[$i]];
				else
					$data2[]=0;
			}
			if(isset($data2)){
				$this->modelo('MantenimientosModel')->configurarAusentismo($nivel,$data2,$fecha);
				$_SESSION['cambiado']=5;
				}
				header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}

		public function IngresoReferencia($nivel=''){
			//Esto se divide entre la cantidad de columnas
			if(isset($_POST['fnumber']))
				$this->modelo('MantenimientosModel')->insertarReferencia($_POST['fnumber'],$_POST['especialidad'],$_POST['lugar'],$_POST['fecha']);
			$_SESSION['cambiado']=13;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}

		public function IngresoLugar($nivel=''){
			//Esto se divide entre la cantidad de columnas
			if(isset($_POST['fname']))
				$this->modelo('MantenimientosModel')->insertarLugar($_POST['fname']);
			$_SESSION['cambiado']=13;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}

		public function IngresoEpidemiologia(){
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarEpidemiologico($data[$i],$_POST[$data[$i]],$tiempo);
			}
			header('Location:'.RUTA_URL.'/Nivel/Niveles/Epidemiologia');
			} 

		/////////////////////////////////////////////////

		public function RecargarEducacion($nivel=''){
			$_SESSION['cambiado']=6;
			if(isset($_POST['fecha1'])&&isset($_POST['fecha2'])){
				$fecha['fecha1']=$_POST['fecha1'];
				$fecha['fecha2']=$_POST['fecha2'];
				$fecha['tipo']=$_POST['cbOrdenar'];
				$_SESSION['fecha']=$fecha;
			}
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
		}

		public function RecargarInvestigacion($nivel=''){
			$_SESSION['cambiado']=10;
			if(isset($_POST['fecha1'])&&isset($_POST['fecha2'])){
				$fecha['fecha1']=$_POST['fecha1'];
				$fecha['fecha2']=$_POST['fecha2'];
				$fecha['tipo']=$_POST['cbOrdenar'];
				$_SESSION['fecha2']=$fecha;
			}
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
		}

		public function RecargarReuniones($nivel=''){
			$_SESSION['cambiado']=11;
			if(isset($_POST['fecha1'])&&isset($_POST['fecha2'])){
				$fecha['fecha1']=$_POST['fecha1'];
				$fecha['fecha2']=$_POST['fecha2'];
				$fecha['tipo']=$_POST['cbOrdenar'];
				$_SESSION['fecha3']=$fecha;
			}
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
		}

		public function ActualizarDatos(){
			if(isset($_POST['extra'])){
				$model = $this->modelo('MantenimientosModel');
				$charla = $model->education($_POST['extra']);
				$listener = $model->listeners();
				$health = $model->health_education($charla->nivel);
				$datos=[
					'Charla'=> $charla,
					'Listeners'=>$listener,
					'health'=>$health,
				];
				$this->vista('mantenimientos/charlas',$datos);
			}
			else
				header('Location:'.RUTA_URL.'/Pages/index/');
		}

		public function ActualizarInvestigacion(){
			if(isset($_POST['extra'])){
				$_SESSION['cambiado']=10;
				$datos['investigations']= $this->modelo('MantenimientosModel')->investigations($_POST['extra']);
				$this->vista('mantenimientos/investigaciones',$datos);
			}
			else
				header('Location:'.RUTA_URL.'/Pages/index/');
		}

		public function ActualizarReunion(){
			if(isset($_POST['extra'])){
				$_SESSION['cambiado']=11;
				$datos['meetings']= $this->modelo('MantenimientosModel')->meetings($_POST['extra']);
				$this->vista('mantenimientos/reuniones',$datos);
			}
			else
				header('Location:'.RUTA_URL.'/Pages/index/');
		}
		/////////////////////////////////////////////////

		private function mantenimientoRecarga($nivel=''){
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

			if(isset($_SESSION['acceso'])&&
					($_SESSION['acceso']==1||$_SESSION['acceso']==2||$_SESSION['acceso']==3))
			{
				$model = $this->modelo('MantenimientosModel');
				$levelThings = $model->levelThings();
				$preparacion = $model->levelThings('10',1);
				$especialidades = $model->specialities($nivel);
				$place = $model->places();
				$specialty = $model->specialtyThings();
				$procedures = $model->procedures($nivel,$especialidades);
				$absences=$model->absences();
				$absencesConfig=$model->absences_config();
				$health=$model->health_Education($nivel);
				$healthEducation=$model->health_Education_data($nivel);
				$investigations=$model->investigations_data($nivel);
				$meetings=$model->meetings_data($nivel);
				$admin=$model->administrative_management();
				$admin2=$model->management();
				$datos=[
					'levelThings' => $levelThings,
					'pacientes' => $preparacion,
					'especialidades' => $especialidades,
					'specialty' => $specialty,
					'lugar' => $place,
					'procedures' => $procedures,
					'absences' => $absences,
					'health' => $health,
					'education' => $healthEducation,
					'admin' => $admin,
					'admin2' => $admin2,
					'absences_config' => $absencesConfig,
					'investigacion' => $investigations,
					'reunion' => $meetings,
				];

				if(isset($_SESSION['cambiado']))
				{
					$datos['cargado']=$_SESSION['cambiado'];
					unset($_SESSION['cambiado']);
				}
				$this->vista('mantenimientos/nivel'.$level,$datos);
			}
			else
				$this->vista('mantenimientos/nivel/'.$level);
			}

		private function mantenimientoDepto(){
			$nivel = 'Enfermeria';
			if(isset($_SESSION['acceso'])&&
					($_SESSION['acceso']==1||$_SESSION['acceso']==2||$_SESSION['acceso']==3))
			{
				$model = $this->modelo('MantenimientosModel');
				$levelThings = $model->levelThings();
				$absences=$model->absences();
				$absencesConfig=$model->absences_config();
				$health=$model->health_Education($nivel);
				$healthEducation=$model->health_Education_data($nivel);
				$investigations=$model->investigations_data($nivel);
				$meetings=$model->meetings_data($nivel);
				$admin=$model->administrative_management();
				$datos=[
					'levelThings' => $levelThings,
					'absences' => $absences,
					'health' => $health,
					'education' => $healthEducation,
					'admin' => $admin,
					'absences_config' => $absencesConfig,
					'investigacion' => $investigations,
					'reunion' => $meetings,
				];

				if(isset($_SESSION['cambiado']))
				{
					$datos['cargado']=$_SESSION['cambiado'];
					unset($_SESSION['cambiado']);
				}
				$this->vista('mantenimientos/enfermeria',$datos);
			}
			else
				$this->vista('mantenimientos/enfermeria/');
			}
	}

?>
