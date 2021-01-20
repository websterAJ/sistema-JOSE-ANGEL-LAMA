<?php 
include 'functions.php';

connect_mysqli();
$periodo =SelectWhere('*','periodo_escolar','statud=1');
if (isset($_GET['mode'])) {
	switch ($_GET['mode']) {
		case 'ci_escolar':
			$data=SelectWhere(
				'count(alumno) as total',
				'incripcion',
				"representante='".$_GET['q']."' AND periodo_escolar='".$periodo['0']['id']."'"
			);
			$array = array();
			$count_Data = 0;
			$count_Data = $data[0]['total'];
			if ($count_Data>0) {
				$count_Data++;
				$array['hermanos']=str_pad($count_Data, 2, '0', STR_PAD_LEFT);
				$array['ci']=$_GET['q'];
			}else{
				$data2 = SelectWhere(
				'count(alumno) as total',
				'pre_incripcion',
				"representante='".$_GET['q']."' AND perido_escolar='".$periodo['0']['id']."'"
				);
				$count_Data = $data2[0]['total'];
				if($count_Data>0){
					$count_Data++;
					$array['hermanos']=str_pad($count_Data, 2, '0', STR_PAD_LEFT);
					$array['ci']=$_GET['q'];
				}else{
					$count_Data++;
					$array['hermanos']=str_pad($count_Data, 2, '0', STR_PAD_LEFT);
					$array['ci']=$_GET['q'];
				}
				
			}
			echo json_encode($array);
			break;
		case 'search_ci':
			$data = SelectWhere('*','familiares',"id='".$_GET['q']."'");
			echo json_encode($data);
			break;
		case 'pdf_incripcion':
			$data = SelectWhere(
				'alumnos.*, familiares.*, aula.aula, grados.grado, secciones.seccion, bienestar_social.*, periodo_escolar.titulo',
				'alumnos, familiares, incripcion, aula, grados, secciones, bienestar_social, periodo_escolar',
				"incripcion.alumno= alumnos.id AND incripcion.representante= familiares.id AND incripcion.aula = aula.id AND aula.grado = grados.id AND aula.seccion = secciones.id AND aula.periodo_escolar=periodo_escolar.id AND bienestar_social.alumno = alumnos.id AND incripcion.alumno = '".$_GET['id']."'");
			ob_start();
		    require_once 'constancia.php';
		    $html=ob_get_clean();
			$html2pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','es','true','UTF-8',array(0,7,10,7));
			$html2pdf->writeHTML($html);
			$html2pdf->output($_GET['id'].'.pdf');
?>

<?php
			break;
		case 'constancia_inscripcion':
			$data = SelectWhere(
				'grados.grado, CONCAT(alumnos.nombres," ",alumnos.apellidos) as alumno, alumnos.id, secciones.seccion, grados.grado',
				'incripcion, aula, alumnos, secciones, grados',
				"representante='".$_GET['id']."' AND incripcion.aula = aula.id AND incripcion.alumno= alumnos.id AND aula.grado=grados.id AND aula.seccion=secciones.id");
?>
				<table class="table table-bordered text-center">
				<thead class="text-center">
					<th style="text-align: center;align-content: center;">Cedula Escolar</th>
					<th style="text-align: center;align-content: center;">Nombre y apellido</th>
					<th style="text-align: center;align-content: center;">Grado en curso</th>
				</thead>
					<tbody>
						<?php foreach ($data as $value): ?>
							<tr>
								<td>
									<button class="btn btn-outline-info" type="button" onclick="Incripcion('<?= $value['id']?>')" id="<?= $value['id']?>">
										<?= $value['id']?>
									</button>
								</td>
								<td><?= $value['alumno']?></td>
								<td><?= $value['grado']?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
<?php
			break;
		case 'inscripcion':
			$data = SelectWhere(
				'grados.grado, CONCAT(alumnos.nombres," ",alumnos.apellidos) as alumno, alumnos.id',
				'pre_incripcion, grados, alumnos',
				"representante='".$_GET['id']."' AND pre_incripcion.grado = grados.id AND pre_incripcion.alumno= alumnos.id");
?>
			<table class="table table-bordered text-center">
				<thead class="text-center">
					<th style="text-align: center;align-content: center;">Cedula Escolar</th>
					<th style="text-align: center;align-content: center;">Nombre y apellido</th>
					<th style="text-align: center;align-content: center;">Grado a optar</th>
				</thead>
				<tbody>
					<?php foreach ($data as $value): ?>
						<tr>
							<td>
								<button class="btn btn-outline-info" type="button" onclick="Incripcion('<?= $value['id']?>')" id="<?= $value['id']?>">
									<?= $value['id']?>
								</button>
							</td>
							<td><?= $value['alumno']?></td>
							<td><?= $value['grado']?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
<?php
			break;
		case 'data_incripcion':
			$data=SelectWhere(
				'aula.id, aula.aula, aula.disponibilidad, grados.grado, secciones.seccion,CONCAT(alumnos.nombres," ",alumnos.apellidos) as alumno, alumnos.id as alumno_ci',
				'pre_incripcion, aula, grados, secciones, alumnos',"alumno='".$_GET['id']."' AND pre_incripcion.grado = grados.id AND aula.grado=grados.id AND aula.seccion=secciones.id AND pre_incripcion.alumno= alumnos.id"
			);
?>
			<div class="row "style="margin-top: 15px;margin-bottom: 15px; padding: 10px;">
				<div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center" style="margin-bottom: 10px">
					<h5>Proceso de incripcion Alumno: <b><?= $data[0]['alumno']?></b></h5>
				</div>
				<div class="col-md-6 col-lg-6 col-sm-12 col-12 text-center">
					<h5>Aulas disponible</h5>
				</div>
				<div class="col-md-6 col-lg-6 col-sm-12 col-12 text-center">
					<input type="number" value="<?= $data[0]['alumno_ci']?>" id="id_alumno" name="id_alumno" hidden>
					<select name="aula" id="aula" class="form-control" onchange="verificar()">
						<option value="null" selected>Seleccione una opcion</option>
						<?php foreach ($data as $key => $value): ?>
							<option value="<?= $value['id']?>"><?= $value['aula']." ". $value['grado']."-".$value['seccion']." Cupos disponible: ".$value['disponibilidad']?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="container-fluid text-center row" style="margin-left: 30px">
				<div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center" style="margin-bottom: 10px">
					<h3>Bienestar social y salud</h3>
				</div>
				<div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center row">
					<div class="col-md-3 col-lg-3 col-sm-12 row">
						<div class="col-md-12 col-lg-12 col-sm-12 col-3 text-center form-group">
							<h5 style="margin-bottom: 17px">Peso</h5>
							<input type="number" id="peso" name="peso" class="form-control form-control-sm">
						</div>
					</div>
					<div class="col-md-3 col-lg-3 col-sm-12 row">
						<div class="col-md-12 col-lg-12 col-sm-12 col-3 text-center form-group">
							<h5 style="margin-bottom: 17px">Estatura</h5>
							<input type="number" id="estatura" name="estatura" class="form-control form-control-sm">
						</div>
					</div>
					<div class="col-md-2 col-lg-2 col-sm-12 col-12 text-center form-group">
						<h5 class="mb">Posee Canaima</h5>
						<label class="radio-inline">
						  <input type="radio" name="canaima" id="canaima" value="si"> Si
						</label>
						<label class="radio-inline">
						  <input type="radio" name="canaima" id="canaima" value="no"> No
						</label>
					</div>
					<div class="col-md-2 col-lg-2 col-sm-12 col-12 text-center form-group">
						<h5 class="mb">Control Pediátrico</h5>
						<label class="radio-inline">
						  <input type="radio" name="Control_Pediátrico" id="Control_Pediátrico" value="si"> Si
						</label>
						<label class="radio-inline">
						  <input type="radio" name="Control_Pediátrico" id="Control_Pediátrico" value="no"> No
						</label>
					</div>
					<div class="col-md-3 col-lg-3 col-sm-12 col-12 text-center form-group">
						<h5 class="mb">Control Nutricional</h5>
						<label class="radio-inline">
						  <input type="radio" name="Control_Nutricional" id="Control_Nutricional" value="si"> Si
						</label>
						<label class="radio-inline">
						  <input type="radio" name="Control_Nutricional" id="Control_Nutricional" value="no"> No
						</label>
					</div>
				</div>
				<div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center row">
					<div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center">
						<h5>Grupo Sanguíneo</h5>
					</div>
					<div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center form-group">
						<div class="form-inline">
							<label class="radio-inline">
						  	<input type="radio" name="GrupoS" id="A" value="A"> A
							</label>
							<label class="radio-inline">
							  <input type="radio" name="GrupoS" id="B" value="B"> B
							</label>
							<label class="radio-inline">
							  <input type="radio" name="GrupoS" id="AB" value="AB"> AB
							</label>
							<label class="radio-inline">
							  <input type="radio" name="GrupoS" id="O" value="O"> O
							</label>
						</div>
						<select name="orm" id="orm" class="form-control mt">
							<option value="NULL">SELECCIONE UNA OPCION</option>
							<option value="+">+</option>
							<option value="-">-</option>
						</select>						
					</div>
				</div>
				<div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center form-group">
					<h5>Posee tarjeta de vacunacion</h5>
					<label class="radio-inline">
					  <input type="radio" name="tarjeta_vacunas" id="tarjeta_vacunas" value="si" onclick="activeVacunas($('#tarjeta_vacunas'),$('#vacunas'))"> Si
					</label>
					<label class="radio-inline">
					  <input type="radio" name="tarjeta_vacunas" id="tarjeta_vacunas" value="no" onclick="disabledVacunas(this,$('#vacunas'))"> No
					</label>
					<div id="vacunas" style="display: none;" class="row mt">
						<div class="form-group col-md-4 col-lg-4 col-sm-4">
							<label class="checkbox-inline">
						 	 <input type="checkbox" name="Antirotavirus" id="Antirotavirus" value="si"> Antirotavirus
							</label>
						</div>
						<div class="form-group col-md-4 col-lg-4 col-sm-4">
							<label class="checkbox-inline">
							  <input type="checkbox" name="Antihepatitis_B" id="Antihepatitis_B" value="si"> Antihepatitis B
							</label>
						</div>
						<div class="form-group col-md-4 col-lg-4 col-sm-4">
							<label class="checkbox-inline">
							  <input type="checkbox" name="Triple_bacteriana" id="Triple_bacteriana" value="si"> Triple bacteriana
							</label>
						</div>
						<div class="form-group col-md-4 col-lg-4 col-sm-4">
							<label class="checkbox-inline">
							  <input type="checkbox" name="Trivalente_viral" id="Trivalente_viral" value="si"> Trivalente viral
							</label>
						</div>
						<div class="form-group col-md-4 col-lg-4 col-sm-4">
							<label class="checkbox-inline">
							  <input type="checkbox" name="Antiamerilica" id="Antiamerilica" value="si"> Antiamerilica
							</label>
						</div>
						<div class="form-group col-md-4 col-lg-4 col-sm-4">
							<label class="checkbox-inline">
							  <input type="checkbox" name="Doble_viral" id="Doble_viral" value="si"> Doble viral
							</label>
						</div>
						<div class="form-group col-md-4 col-lg-4 col-sm-4">
							<label class="checkbox-inline">
							  <input type="checkbox" name="Antihaemophilus_influenzae_tipo_B" id="Antihaemophilus_influenzae_tipo_B" value="si"> Antihaemophilus influenzae tipo B
							</label>
						</div>
						<div class="form-group col-md-4 col-lg-4 col-sm-4">
							<label class="checkbox-inline">
							  <input type="checkbox" name="Antimeningococcica_B-C" id="Antimeningococcica_B-C" value="si"> Antimeningococcica B-C
							</label>
						</div>
						<div class="form-group col-md-4 col-lg-4 col-sm-4">
							<label class="checkbox-inline">
							  <input type="checkbox" name="Toxoide_tetanico" id="Toxoide_tetanico" value="si"> Toxoide tetanico
							</label>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-4 col-sm-12 col-12 text-center form-group">
					<h5>Posee algun impedimento fisico</h5>
					<label class="radio-inline">
					  <input type="radio" name="impedimento_físico" id="impedimento_físico" value="si" onclick="active_camp(this,$('#descripcion_impedimento_físico'))"> Si
					</label>
					<label class="radio-inline">
					  <input type="radio" name="impedimento_físico" id="impedimento_físico" value="no" onclick="disabled_camp(this,$('#descripcion_impedimento_físico'))"> No
					</label>
					<input type="text" id="descripcion_impedimento_físico" name="descripcion_impedimento_físico" class="form-control mt" disabled="true">
				</div>
				<div class="col-md-4 col-lg-4 col-sm-12 col-12 text-center form-group">
					<h5>Padece algun tipo de enfermedad</h5>
					<label class="radio-inline">
					  <input type="radio" name="enfermedad" id="enfermedad" value="si" onclick="active_camp(this,$('#descripcion_enfermedad'))"> Si
					</label>
					<label class="radio-inline">
					  <input type="radio" name="enfermedad" id="enfermedad" value="no" onclick="disabled_camp(this,$('#descripcion_enfermedad'))"> No
					</label>
					<input type="text" id="descripcion_enfermedad" name="descripcion_enfermedad" class="form-control mt" disabled="true">
				</div>
				<div class="col-md-4 col-lg-4 col-sm-12 col-12 text-center form-group">
					<h5>Recibe algun tipo de tratamiento</h5>
					<label class="radio-inline">
					  <input type="radio" name="tratamiento" id="tratamiento" value="si" onclick="active_camp(this,$('#descripcion_tratamiento'))"> Si
					</label>
					<label class="radio-inline">
					  <input type="radio" name="tratamiento" id="tratamiento" value="no" onclick="disabled_camp(this,$('#descripcion_tratamiento'))"> No
					</label>
					<input type="text" id="descripcion_tratamiento" name="descripcion_tratamiento" class="form-control mt" disabled="true">
				</div>	
				<?php $Datatable=DescribeTable('bienestar_social');
					foreach ($Datatable as $key => $value):
						if ($value['Field']<>'id' AND $value['Field']<>'alumno' AND $value['Field']<>'descripcion_impedimento_físico' AND $value['Field']<>'descripcion_enfermedad' AND $value['Field']<>'descripcion_tratamiento' AND $value['Field']<>'descripcion_vacunas' AND $value['Field']<>'peso' AND $value['Field']<>'canaima' AND $value['Field']<>'estatura' AND $value['Field']<>'Grupo Sanguíneo' AND $value['Field']<>'Control_Pediátrico' AND $value['Field']<>'Control_Nutricional' AND $value['Field']<>'tarjeta_vacunas'):
							$type = explode("(",$value['Type']);
				?>
							<?php switch ($type[0]):
									case 'longtext':
							?>
										<?php switch ($value['Field']) {
											case 'enfermedades_virales':
										?>
											<div class="col-md-6 col-lg-6 col-sm-12 col-12 text-center form-group">
												<h5>Enfermedades virales que a padecido</h5>
												<label class="radio-inline">
												  Lechina: <input type="checkbox" name="Lechina" id="Lechina" value="si">
												</label>
												<label class="radio-inline">
													Sarampión: <input type="checkbox" name="Sarampión" id="Sarampión" value="si">
												</label>
												<label class="radio-inline">
													Rubeola: <input type="checkbox" name="Rubeola" id="Rubeola" value="si">
												</label>
												<label class="radio-inline">
													Parotiditis: <input type="checkbox" name="Parotiditis" id="Parotiditis" value="si">
												</label>
											</div>
										<?php
												break;
											case 'enfermedades_cronicas':
										?>
											<div class="col-md-6 col-lg-6 col-sm-12 col-12 text-center form-group">
												<h5>Enfermedades cronicas que padece</h5>
												<label class="radio-inline">
												  Asma: <input type="checkbox" name="Asma" id="Asma" value="si">
												</label>
												<label class="radio-inline">
												  Epilepcia: <input type="checkbox" name="Epilepcia" id="Epilepcia" value="si">
												</label>
												<label class="radio-inline">
												  Alergias: <input type="checkbox" name="Alergias" id="Alergias" value="si">
												</label>
											</div>
										<?php
												break;
										} ?>
							<?php
										break;
									case 'tinyint':
							?>
										<?php if ($value['Field']=="impedimento_físico"):?>
											
										<?php elseif ($value['Field']=="enfermedad"):?>
											
										<?php elseif($value['Field']=="tratamiento"): ?>
														
										<?php endif; ?>
							<?php
										break;
									endswitch; ?>
				<?php 
						endif;
					endforeach; 
				?>
			</div>
<?php
			break;
	}
}else{
	echo "Error";
}

?>