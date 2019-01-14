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

		public function Administracion(){		


			if(isset($_SESSION['acceso'])&&
					($_SESSION['acceso']==1||$_SESSION['acceso']==2||$_SESSION['acceso']==3))
			{
				$model = $this->modelo('MantenimientosModel');
				$admin=$model->management();
				$datos=[
					'admin' => $admin,
				];
				$this->vista('Pages/Administracion',$datos);
			}
			else
				$this->vista('Pages/Administracion');

			//$datos = (isset($_POST['cbInforme']))?$this->cargarNiveles($_POST):['Sin Datos'];	
			//$this->vista('Pages/Niveles',$datos);
		}
		public function Graficas(){
			$datos = (isset($_POST['cbInforme']))?$this->cargarNiveles($_POST):['Sin Datos'];	
			$this->vista('Pages/Niveles',$datos);
		}
		public function IngresoAdministrativo(){
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarAdministrativo2($data[$i],$_POST[$data[$i]],$tiempo);
			}
			header('Location:'.RUTA_URL.'/Nivel/Administracion/');
		} 
		// Para cargar la vista de los niveles
		public function level ($num_registro=''){
			$fecha1 = (isset($_POST['fecha1']))?$_POST['fecha1']:date("Y/m/d");
			$fecha2 = (isset($_POST['fecha2']))?$_POST['fecha2']:date("Y/m/d");
			$tipo = (isset($_POST['cbOrdenar'])?$_POST['cbOrdenar']:'Month');
			$separador = (isset($_POST['cbSeparador'])?$_POST['cbSeparador']:'1');
			$tiempo = [
				'tipo'=>$tipo,
				'fecha1'=>$fecha1,
				'fecha2'=>$fecha2,
				'separador'=>$separador,
			];
			unset($_SESSION['temp']);
      		$_SESSION['temp'] = $tiempo;
			header('Location:'.RUTA_URL."/Nivel/Niveles/$num_registro");
		}
		public function niveles($num_registro=''){

			if(isset($_SESSION['temp'])){
				$tiempo = $_SESSION['temp'];
				$fechaT="Mes Actual";
				if($tiempo['tipo']=="Year"){
					$fechaT="Año Actual";
				}
				else if($tiempo['tipo']=="Per"){
					$tiempo['fecha1']=date("Y-m-01",strtotime($tiempo['fecha1']));
					if($tiempo['separador']!=1){
						$aux = new DateTime(date("Y-m-1",strtotime($tiempo['fecha1'])));
						$diferencia = $aux->diff(new DateTime(date("Y-m-01",strtotime($tiempo['fecha2']))));
						$meses = ( $diferencia->y * 12 ) + $diferencia->m;
						if($meses>=12){
							$aux->add(new DateInterval('P11M'));
							$tiempo['fecha2']=$aux->format('Y-m-01');
						}
						$tiempo['fecha2']=date("Y-m-t",strtotime($tiempo['fecha2']));
					}
					$fechaT="Desde <em>".$tiempo['fecha1']."</em> hasta <em>".$tiempo['fecha2']."</em>";
				}
				setlocale(LC_ALL, "es_ES");
				$datos = $this->cargarDatosNivel($num_registro,$tiempo);
				$datos['fechaT'] =$fechaT;
				$datos['tiempo']=$tiempo;
			}
			else{
				$datos = $this->cargarDatosNivel($num_registro);
				$datos['fechaT'] ='Mes Actual';
			}
			unset($_SESSION['temp']);
			if($num_registro=='DeptoEnfermeria'){
				$this->vista('levels/deptoEnfermeria',$datos);
			}
			else
				$this->vista('levels/nivel'.$num_registro,$datos);
			}
		//Para cargar las especialidades
		public function especialidad($num_registro='',$especialidad=''){

			$fecha1 = (isset($_POST['fecha1']))?$_POST['fecha1']:date("Y/m/d");
			$fecha2 = (isset($_POST['fecha2']))?$_POST['fecha2']:date("Y/m/d");
			$tipo = (isset($_POST['cbOrdenar'])?$_POST['cbOrdenar']:'Month');
			$separador = (isset($_POST['cbSeparador'])?$_POST['cbSeparador']:'1');
			$tiempo = [
				'tipo'=>$tipo,
				'fecha1'=>$fecha1,
				'fecha2'=>$fecha2,
				'separador'=>$separador
			];
			unset($_SESSION['tiempo']);
      		$_SESSION['tiempo'] = $tiempo;
			header('Location:'.RUTA_URL."/Nivel/Especialidades/$num_registro/$especialidad");
			}
		public function especialidades($num_registro='',$especialidad=''){
			//Buscar un modo de conseguir la especialidad
			$datos=null;
			if($especialidad!='')
			{
				if(isset($_SESSION['tiempo'])){
					$tiempo = $_SESSION['tiempo'];
					if($tiempo['tipo']=="Year"){
						$fechaT="Año Actual";
					}
					else if($tiempo['tipo']=="Per"){
						$tiempo['fecha1']=date("Y-m-01",strtotime($tiempo['fecha1']));
						if($tiempo['separador']!=1){
							$aux = new DateTime(date("Y-m-1",strtotime($tiempo['fecha1'])));
							$diferencia = $aux->diff(new DateTime(date("Y-m-01",strtotime($tiempo['fecha2']))));
							$meses = ( $diferencia->y * 12 ) + $diferencia->m;
							if($meses>=12){
								$aux->add(new DateInterval('P11M'));
								$tiempo['fecha2']=$aux->format('Y-m-01');
							}
							$tiempo['fecha2']=date("Y-m-t",strtotime($tiempo['fecha2']));
						}
						$fechaT="Desde <em>".$tiempo['fecha1']."</em> hasta <em>".$tiempo['fecha2']."</em>";
					}
					else{
						$fechaT="Mes Actual";
						$tiempo['separador']='1';
					}
					setlocale(LC_ALL, "es_ES");
					$datos = [
						'datos1'=>$this->cargarProcedimientos($especialidad,$tiempo),
						'datos2'=>$this->cargarDatosEspecialidades($especialidad,$tiempo),
						'fechaT'=>$fechaT,
						'tiempo'=>$tiempo,
					];			
				}
				else{
					unset($_SESSION['tiempo']);
					$datos = [
						'datos1'=>$this->cargarProcedimientos($especialidad),
						'datos2'=>$this->cargarDatosEspecialidades($especialidad),
						'fechaT'=>'Mes Actual',
					];			
				}
			}
			$this->vista('especialidades/nivel'.$num_registro.'/'.$especialidad,$datos);
		}
			
		/*
			*****************
				Privadas
			*****************
								*/
		//Carga la tabla y gráfico
		private function cargarProcedimientos($nombre,$tiempo=0){
			return $this->modelo('ProceduresDataModel')->procedimientos($nombre,$tiempo);
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

		private function cargarNiveles($params){
			setlocale(LC_ALL, "es_ES");
			$fecha1=date('Y-m-1');
			$fecha2=date('Y-m-t');
			if(isset($params['cbFecha'])){
				if($params['cbFecha']=='Per'){
					$fecha1=date("Y-m-d",strtotime($params['fecha1']));

					if(isset($params['cbSeparador'])&&$params['cbSeparador']!=1){
						$fecha1=date("Y-m-01",strtotime($params['fecha1']));
						$params['fecha2']=date("Y-m-t",strtotime($params['fecha2']));
						$aux = new DateTime(date("Y-m-1",strtotime($params['fecha1'])));
						$diferencia = $aux->diff(new DateTime(date("Y-m-01",strtotime($params['fecha2']))));
						$meses = ( $diferencia->y * 12 ) + $diferencia->m;
						if($meses>=12){
							$aux->add(new DateInterval('P11M'));
							$params['fecha2']=$aux->format('Y-m-t');
						}
					}
					$fecha2=date("Y-m-d",strtotime($params['fecha2']));
				}
				else if ($params['cbFecha']=='Year'){
					$fecha1=date("Y-01-01");
					$fecha2=date("Y-12-31");
					$datos['fecha']='Año Actual';
				}
			}
			if(isset($params['cbSeparador'])){
				$nuevo['separador']=$params['cbSeparador'];
				$datos['fecha']="Desde <em>".$fecha1."</em> hasta <em>".$fecha2."</em>";
			}
			else
				$nuevo['separador']=1;
			$nuevo['tipo']=$params['cbFecha'];
			$nuevo['fecha1']=$fecha1;
			$nuevo['fecha2']=$fecha2;
			switch ($params['cbInforme']) {
				case 'indicadores':
					$datos['indicadores']=$this->modelo('ProceduresDataModel')->indicadores($nuevo);
					$datos['cargado']=1;
					break;
				case 'pPacientes':
					$datos['pPacientes']=$this->modelo('ProceduresDataModel')->pPacientes($nuevo);
					$datos['cargado']=2;
					break;
				case 'ausentismo':
					$datos['ausentismo'] = $this->modelo('ProceduresDataModel')->ausentismo($nuevo);
					$datos['cargado']=3;
					break;
				case 'eduSalud':
					$datos['eduSalud']=$this->modelo('ProceduresDataModel')->salud($nuevo);
					$datos['cargado']=4;
					break;
				case 'eduCharlas':
					$datos['eduCharlas']=$this->modelo('ProceduresDataModel')->charlas($nuevo);
					$datos['cargado']=5;
					break;
				case 'eduContinua':
					$datos['eduContinua']=$this->modelo('ProceduresDataModel')->continua($nuevo);
					$datos['cargado']=6;
					break;
				case 'eduEpidemiologia':
					$datos['eduEpidemiologia']=$this->modelo('ProceduresDataModel')->continuaEpidemiologia($nuevo);
					$datos['cargado']=7;
					break;
				case 'eduOftalmologia':
					$datos['eduOftalmologia']=$this->modelo('ProceduresDataModel')->continuaOftalmologia($nuevo);
					$datos['cargado']=8;
					break;
				case 'administracion':
					$datos['administracion'] = $this->modelo('ProceduresDataModel')->administracion($nuevo);
					$datos['cargado']=9;
					break;
				case 'reuniones':
					$datos['reuniones'] = $this->modelo('ProceduresDataModel')->reuniones($nuevo);
					$datos['cargado']=10;
					break;
				default:
					$datos[]='';
					break;
			}
			return $datos;
		}
		private function cargarDatosNivel($nivel,$tiempo=0){
			if(($nivel>=4&&$nivel<=7)||$nivel='DeptoEnfermeria'){
				$level=($nivel==4)?'1':(($nivel==5)?'2':(($nivel==6)?'3':(($nivel==7)?'4':'5')));

				return $this->modelo('ProceduresDataModel')->cargarDatosNivel($level,$tiempo);
			}
			return null;
		}

	}
?>