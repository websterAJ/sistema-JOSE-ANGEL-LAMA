<?php
include 'functions.php';

connect_mysqli();
$array_data= array();
$array_dataTable2= array();
$array_dataTable3= array();
$return= array();
$act_return=0;
$act_error = "";


if (isset($_POST['database'])) {
	$op= $_POST['database'];
	switch ($op) {
		case 'usuario':
			$tablePersona = DescribeTable('persona');
				foreach ($tablePersona as $key => $value) {
					if ($value['Field']=='id') {
						$array_data[$value['Field']]=$_POST['id_familiar'];
					}elseif (isset($_POST[$value['Field']]) && $value['Field']==$_POST[$value['Field']]) {
						$array_data[$value['Field']]=$_POST[$value['Field']];
					}else{
						$array_data[$value['Field']]=$_POST[$value['Field']];
					}
				}
			$tableUsuario = DescribeTable('usuario');
				foreach ($tableUsuario as $key => $value) {
					if ($value['Field']=='id') {
						$array_dataTable2[$value['Field']]=$_POST['id_familiar'];
					}elseif (isset($_POST[$value['Field']]) && $value['Field']==$_POST[$value['Field']]) {
						$array_dataTable2[$value['Field']]=$_POST[$value['Field']];
					}else{
						$array_dataTable2[$value['Field']]=$_POST[$value['Field']];
					}
				}
			break;
		case 'profesor':
			break;
		case 'incripcion':
			$json = array();
			$jsonE = array();
			$jsonEc = array();
			if (isset($_POST['GrupoS']) && isset($_POST['orm'])) {
				$arraydata['Grupo_Sanguíneo']=$_POST['GrupoS']."".$_POST['orm'];
			}
			if (isset($_POST['ci'])) {
				$arrayIncripcion['representante']=$_POST['ci'];
			}
			if (isset($_POST['id_alumno'])) {
				$arrayIncripcion['alumno']=$_POST['id_alumno'];
			}
			if (isset($_POST['aula'])) {
				$arrayIncripcion['aula']=$_POST['aula'];
			}
			$periodo = SelectWhere('id','periodo_escolar',"statud=1");
			$arrayIncripcion['periodo_escolar' ]= $periodo[0]['id'] ;
			foreach ($_POST as $key => $value) {
				if (($key == "tarjeta_vacunas" AND $value == "si") || ($key == "Antirotavirus" || $key == "Antihepatitis_B" || $key == "Triple_bacteriana" || $key == "Trivalente_viral" || $key == "Antiamerilica" || $key == "Doble_viral" || $key == "Antihaemophilus_influenzae_tipo_B" || $key == "Antimeningococcica_B-C" || $key == "Toxoide_tetanico") ) {
					if ($key <> "tarjeta_vacunas") {
						$json[$key] = $value;
					}else{
						$arraydata[$key]=$value;
					}
				}elseif($key == "Asma"  || $key == "Epilepcia"  || $key == "Alergias" || $key == "Parotiditis"){
					$jsonEc[$key] = $value;
				}elseif(($key == "enfermedad" AND $value == "si") || ($key == "Lechina"  || $key == "Sarampión"  || $key == "Rubeola")){
					$jsonE[$key] = $value;
				}elseif ($key <> 'id_alumno' AND $key <> 'aula' AND $key <> 'database' AND $key <> 'GrupoS' AND $key <> 'orm' AND $key <> 'ci') {
					$arraydata[$key]=$value;
				}
			}
			$arraydata['enfermedades_virales'] = serialize($jsonE);
			$arraydata['enfermedades_cronicas'] = serialize($jsonEc);
			$arraydata['descripcion_vacunas']= serialize($json);
			$arraydata['alumno']=$_POST['id_alumno'];
			$table = DescribeTable('bienestar_social');
			foreach ($table as $key => $value) {
				if ($value['Field']<> 'id') {
					$array_data[$value['Field']]=$arraydata[$value['Field']];
				}
			}
			$table = DescribeTable('incripcion');
			foreach ($table as $key => $value) {
				if ($value['Field']<> 'id') {
					$array_data2[$value['Field']]=$arrayIncripcion[$value['Field']];
				}
			}
			$insertIncripcion=Insert('incripcion',$array_data2);
			if ($insertIncripcion) {
				$insertBienestar=Insert('bienestar_social',$array_data);
				if ($insertBienestar) {
					$update = UpdateAula('aula',"`disponibilidad`=disponibilidad - 1","id='".$arrayIncripcion['aula']."'");
					if ($update) {
						$data['statud']=0;
						$update = Update('pre_incripcion',$data,"alumno='".$arraydata['alumno']."'");
						$act_return = 1;
					}else{
						$act_return = 2;
					}
				}else{
					$act_return = 2;
				}
			}else{
				$act_return = 2;
			}
			break;
		case 'pre_incripcion':
			$table = DescribeTable('familiares');
				foreach ($table as $key => $value) {
					if ($value['Field']=='id') {
						$array_data[$value['Field']]=$_POST['id_familiar'];
					}elseif (isset($_POST[$value['Field']]) && $value['Field']==$_POST[$value['Field']]) {
						$array_data[$value['Field']]=$_POST[$value['Field']];
					}else{
						$array_data[$value['Field']]=$_POST[$value['Field']];
					}
				}
			$tableAlumnos = DescribeTable('alumnos');
			foreach ($tableAlumnos as $key => $value) {
				if ($value['Field']=='id') {
					$array_dataTable2[$value['Field']]=$_POST['id_alumno'];
				}elseif (isset($_POST[$value['Field']]) && $value['Field']==$_POST[$value['Field']]) {
					$array_dataTable2["'".$value['Field']."'"]=$_POST[$value['Field']];
				}else{
					$array_dataTable2[$value['Field']]=$_POST[$value['Field']];
				}
			}
			$insertFamiliar=Insert('familiares',$array_data);
			if ($insertFamiliar) {
				$insertAlumno=Insert('alumnos',$array_dataTable2);
				if ($insertAlumno) {
					$tablePreincripcion = DescribeTable('pre_incripcion');
						$array_dataTable3['fecha']= date('Y-m-d');
						$array_dataTable3['alumno']= $_POST['id_alumno'];
						$array_dataTable3['grado']= $_POST['statud'];
						$array_dataTable3['representante']= $_POST['id_familiar'];
						$array_dataTable3['statud']= 1;
						$periodo = SelectWhere('id','periodo_escolar',"statud=1");
						$array_dataTable3['perido_escolar' ]= $periodo[0]['id'] ;
					$insertPreincripcion=Insert('pre_incripcion',$array_dataTable3);
					if ($insertPreincripcion) {
						$act_return = 1;
					}else{
						$act_error = $insertPreincripcion;
					}
				}else{
					$act_error = $insertAlumno;
				}
			}else{
				$act_error = $insertFamiliar;
			}
			break;
		
		default:
			foreach ($_POST as $key => $value) {
				if (!empty($value) && $key <> 'database') {
					
					if ($key == 'fecha_inicial'||$key == 'fecha_final'||$key == 'fecha') {
						$value = str_replace("-",'/',$value);
						$array_data[$key]=date("Y-m-d", strtotime($value) );
					}else{
						$array_data[$key]=$value;
					}
				}
			}
			if (count($array_data) > 0 && array_key_exists('database', $_POST) && isset($array_data)) {
				if(Insert($_POST['database'],$array_data)){
					$act_return = 1;
				}else{
					$act_return = 2;
				}
			}else{
				$act_return = 2;
			}
			break;
	}
}else{
	$act_return = 2;
}
switch ($act_return) {
	case '1':
		$return['titulo']= 'Formulario enviado con exito';
		$return['error']= false;
		$return['descripcion']= 'los datos ingresados fueron guardados con exito';
		break;
	case '2':
		$return['titulo']= 'Error al procesar los datos';
		$return['error']= $act_error;
		$return['descripcion']= 'Campos vacios o incorrectos';
		break;
}
echo json_encode($return);
?>