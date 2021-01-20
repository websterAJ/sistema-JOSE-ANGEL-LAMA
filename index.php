<?php include 'layouts/header.php'; ?>
<?php 
	clearstatcache();
	if(!Islogin()):
		header("Location:login.php");
	else:
		$Uri = array();
		$Area = '';
		$pages = ( isset($_GET['page'])) ? $_GET['page'] : 'dashboard';
		$table='';
		$title='';
		$Action = ( isset($_GET['action'])) ? $_GET['action'] : '';
		$reload=false;
		$Uri = $_GET;
		connect_mysqli();
		$periodo = SelectWhere('*','periodo_escolar',"statud=1");
		if (count($periodo)>0) {
		    $fechaFinal=$periodo[0]["fecha_final"];
		    $fechaActual=date('Y-m-d');
		   	if ($fechaActual >= $fechaFinal) {
		        Update('periodo_escolar',array('statud'=>'0'),'id=\''.$periodo[0]['id'].'\'');
		        header("Location:index.php?page=new-escolar");
   			}
		}elseif(count($periodo)<=0) {
	        if ($pages<>'new-escolar') {
?>
	            <script type="text/javascript">
	                swal('Advertencia!', 'No hay año escolar aperturado por favor verificar');
	                location.href="<?= $_ENV['_BASE_URL_']?>index.php?page=new-escolar";
	            </script>
<?php 		}
    	}

		if (count($Uri) > 0) {
			if(isset($_GET['page']) && empty($Uri['page'])){
				$pages = 'dashboard';
			}else{
				switch ($Uri['page']) {
					case 'new-escolar':
						$pages='formulario';
						$table='periodo_escolar';
						$title='Nuevo Año escolar';
						break;
					case 'constancia_estudio':
						$pages='formulario';
						$table='incripcion';
						$title='Constancia de estudio';
						break;
					case 'dashboard':
						$pages='dashboard';
						$title='Pagina principal';
						break;
					case 'pre-inscripcion':
						$pages="registro";
						$title="Formulario de Pre-inscripcion";
						$table="pre_incripcion";
						break;
					case 'inscripcion':
						$pages="registro";
						$title="Formulario de Inscripcion";
						$table="incripcion";
						break;
					case 'registro-usuario':
						$pages="registro";
						$title="Registro usuario";
						$table="usuario";
						break;
					case 'registro-profesor':
						$pages="registro";
						$title="Registro profesor";
						$table="profesor";
						break;
					case 'lista-profesor':
						$pages="listado";
						$title="Listado de profesores";
						$table="profesor";
						break;
					case 'lista-usuario':
						$pages="listado";
						$title="Lista usuarios";
						$table="usuario";
						break;
					case 'grados':
						$pages="listado";
						$title="Grados";
						$table="grados";
						break;
					case 'secciones':
						$pages="listado";
						$title="Secciones";
						$table="secciones";
						break;
					case 'aulas':
						$pages="listado";
						$title="Aulas";
						$table="aula";
						break;
					case 'lista-pre-inscripcion':
						$pages="listado";
						$title="Listado de Pre-inscrito";
						$table="pre_incripcion";
						break;
					case 'nuevo-periodo_escolar':
						$pages='formulario';
						$title="Registro de Año escolar";
						$table="periodo_escolar";
						break;
					case 'cierre-periodo_escolar':
						$pages='listado';
						$title="Cierre de año escolar";
						$table="periodo_escolar";
						break;
					case 'lista-periodo_escolar':
						$pages='listado';
						$title="Lista de Año escolar";
						$table="periodo_escolar";
						break;
					case 'logout':
						close_mysqli();
						session_destroy();
?>
						<script type="text/javascript">
			                swal('Hasta luego!', 'Gracias por usar nuestro sistema');
			                location.href="<?= $_ENV['_BASE_URL_']?>login.php";
	            		</script>
<?php
						break;
				}
			}

			// Si se ha especificado la acción
			if(isset($_GET['action'])){
				if($Uri[$i] != '' && $Uri[$i] != '/'){
					$Action = str_replace('/', '', $Uri[$i]);
				}
			}
		}else{
			$pages = 'dashboard';
		}
		if(!$reload):
			// Guardamos la ruta del controlador
			$_pages = 'pages/' . $pages . '.php';
			// Verificamos que la vista exista
			if (!file_exists($_pages)){
				$http = '404';
				include 'pages/404.php';
			}else{
				$http = '200';
				$ControladorActual = $pages;
				$AccionActual      = $Action;
			
?>
				<?php include $_pages;?>
<?php 	
			}
		endif;
	endif;
?>
<?php include 'layouts/footer.php'; ?>