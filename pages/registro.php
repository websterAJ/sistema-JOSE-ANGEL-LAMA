	<h3><i class="fa fa-angle-right"></i> <?= $title?></h3>
	<form id="data_form" action="#" class="form-horizontal style-form">
	<?php if ($_GET['page'] == 'pre-inscripcion'):?>
		<div class="form-panel row">
			<input type="text" hidden id="database" name="database" value="<?= $table?>">
			<h3 class="text-center">Datos del Representante</h3>
			<div class="form-group row text-center">
				<div class="row">
					<?php $alumno=DescribeTable('familiares');
					foreach ($alumno as $key => $value):?>
						<div class="col-sm-3 col-md-3 col-xs-3">
							<label class="control-label align-middle">
								<?php if($value['Field'] == 'DHogar'): ?>
									Dirección del hogar
								<?php elseif ($value['Field'] == 'TlfHogar'):?>
									Teléfono del hogar
								<?php elseif ($value['Field'] == 'Tlftrabajo'):?>
									Teléfono del trabajo
								<?php elseif ($value['Field'] == 'Dtrabajo'):?>
									Dirección del trabajo
								<?php elseif ($value['Field'] == 'id'): $value['Field']='id_familiar';?>
									Cédula de Identidad
								<?php else: ?>
									<?= ucfirst(str_replace("_"," ",$value['Field']))?>
								<?php endif;?>
							</label>
						</div>
						<?php if ($value['Field'] == 'TlfHogar' || $value['Field'] == 'Tlftrabajo'):?>
							<div class="col-sm-3 col-md-3 col-xs-3 form-group">
								<input class="form-control form-control-inline input-medium" required type="tel" id="<?= $value['Field']?>" name="<?= $value['Field']?>">
							</div>
						<?php elseif($value['Field'] == 'nacionalidad'): ?>
							<div class="col-sm-3 col-md-3 col-xs-3 form-group">
								<select id="<?= $value['Field']?>" name="<?= $value['Field']?>" required class="form-control">
									<option value="null">Seleccione una opción</option>
									<option value="1">Venezolano</option>
									<option value="0">Extranjero</option>
								</select>
							</div>
						<?php elseif ($value['Field'] == 'id_familiar'):?>
							<div class="col-sm-3 col-md-3 col-xs-3 form-group">
								<input class="form-control form-control-inline input-medium" type="text" required id="<?= $value['Field']?>" name="<?= $value['Field']?>" onkeypress='return validaNumericos(event)'>
							</div>
							
						<?php elseif($value['Field'] == 'Parestesco'): ?>
							<div class="col-sm-3 col-md-3 col-xs-3 form-group">
								<select id="<?= $value['Field']?>" name="<?= $value['Field']?>" class="form-control" required>
									<option value="null">Seleccione una opción</option>
									<option value="1">Madre</option>
									<option value="2">Padre</option>
									<option value="3">Familiar a cargo</option>
								</select>
							</div>
						<?php else: ?>
							<div class="col-sm-3 col-md-3 col-xs-3 form-group">
								<input class="form-control form-control-inline input-medium" type="text" required id="<?= $value['Field']?>" name="<?= $value['Field']?>">
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
			<h3 class="text-center" style="margin-bottom: 30px">Datos del Alumnos</h3>
			<div class="form-group row text-center">
				<div class="row">
					<div class="col-sm-3 col-md-3 col-xs-3">
						<label class="control-label align-middle">Fecha de nacimiento</label>
					</div>
					<div class="col-sm-3 col-md-3 col-xs-3 input-group mb-3">
					  <input class="form-control" required oncuechange="" max="<?= date("Y-m-d")?>" size="16" type="date" id="fecha" name="fecha"  max="<?= date("Y-m-d")?>">
					  <div class="input-group-append">
					    <button class="btn btn-info m-4" type="button" onclick="calcularEdad($('#fecha'))"><i class="fa fa-calculator"></i></button>
					  </div>
					</div>
					<div class="col-sm-3 col-md-3 col-xs-3">
						<label class="control-label align-middle">Cédula de Identidad o <br> Cédula Escolar</label>
					</div>
					<div class="col-sm-3 col-md-3 col-xs-3 form-group">
						<h5>Posee Cédula de Identidad</h5>
						<label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1"> Si</label>
						<label><input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" onclick="ci_escolar()"> No</label>
		                <input class="form-control form-control-inline input-medium" type="number" required id="id_alumno" name="id_alumno" onkeypress='return validaNumericos(event)'>
					</div>
					<?php $alumno=DescribeTable('alumnos');?>
					<?php foreach ($alumno as $key => $value):?>
						<?php if($value['Field']<>'statud' AND $value['Field']<>'fecha' AND $value['Field']<>'id'): ?>
								<div class="col-sm-3 col-md-3 col-xs-3">
									<label class="control-label align-middle">
										<?php if($value['Field'] == 'Lnaciomiento'): ?>
											Lugar de Nacimiento
										<?php elseif($value['Field'] == 'id'): $value['Field']='id_alumno';?>
											Cédula de Identidad o <br> Cédula Escolar
										<?php elseif($value['Field'] == 'plantelAnterior'): ?>
											Plantel anterior
										<?php else: ?>
											<?= ucfirst(str_replace("_"," ",$value['Field'])) ?>
										<?php endif; ?>
									</label>
								</div>
								<div class="col-sm-3 col-md-3 col-xs-3 form-group">
									<?php if($value['Field'] == 'nacionalidad'): ?>
										<select id="<?= $value['Field']?>" name="<?= $value['Field']?>" required class="form-control">
											<option value="null">Seleccione una opción</option>
											<option value="1">Venezolano</option>
											<option value="0">Extranjero</option>
										</select>
									<?php elseif($value['Field'] == 'sexo'): ?>
										<select id="<?= $value['Field']?>" name="<?= $value['Field']?>" required class="form-control">
											<option value="null">Seleccione una opción</option>
											<option value="1">Masculino</option>
											<option value="0">Femenino</option>
										</select>		
									<?php elseif($value['Field'] == 'edad'): ?>
										<input class="form-control form-control-inline input-medium" type="number" style="pointer-events: none;" required id="<?= $value['Field']?>" name="<?= $value['Field']?>">
									<?php else: ?>
										<input class="form-control form-control-inline input-medium" type="text" required id="<?= $value['Field']?>" name="<?= $value['Field']?>">
									<?php endif; ?>
									
								</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
			<h3 class="text-center">Grado a optar</h3>
			<div class="form-group row text-center">
				<div class="col-sm-3 col-md-3 col-xs-3">
					<label class="control-label align-middle">Grado</label>
				</div>
				<div class="col-sm-9 col-md-9 col-xs-9 form-group">
					<?php $grado= SelectAll("*",'grados');?>
					<select class="form-control" required name="<?= $value['Field']?>" id="<?= $value['Field']?>">
						<?php foreach ($grado as $key => $value):?>
							<option value="<?= $value['id']?>">
								<?= $grado[$key]['grado']?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
	    	</div>
	    	<div class="form-group row text-center">
	    		<div class="col-sm-3 col-md-3 col-xs-3">
					<label class="control-label align-middle">Periodo Escolar</label>
				</div>
				<div class="col-sm-9 col-md-9 col-xs-9 form-group">
					<?php $periodo= SelectWhere("id,titulo",'periodo_escolar','statud=1');?>
					<input class="form-control form-control-inline input-medium default-date-picker" required size="16" type="text" id="periodo_escolar" name="periodo_escolar" value="<?= $periodo[0]['titulo']?>" disabled>
				</div>
	    	</div>
		</div>
	<?php elseif ($_GET['page'] == 'inscripcion'):?>
		<div class="form-panel row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-12 form-group row">
				<div class="col-sm-4 col-md-4 col-lg-4 col-md-offset-4" >
					<div class="input-group">
				         <input type="text" id="ci" name="ci" placeholder="Ingrese la cedula del representante" class="form-control" maxlength="8">
				         <input type="text" id="database" name="database" value="incripcion" class="form-control hidden">
				         <span class="input-group-btn">
				             <button class="btn btn-primary" id="btnBusqueda" type="button" onclick="Busqueda($('#ci').val())"><i class="fa fa-search"></i></button>
				         </span>
				    </div>
				</div>
			</div>
			<div id="Resultado_busqueda"></div>
			<div id="Resultado_busqueda2"></div>
		</div>
		<script>
			function active_camp(radio,input){
			    var radio = radio;
			    var input = input[0];
			    if (radio.value == 'si') {
			        input.disabled= false;
			    }
			}
			function disabled_camp(radio,input){
			    var radio = radio;
			    var input = input[0];
			    if (radio.value == 'no') {
			    	input.disabled= true;
			    }
			}

			function activeVacunas(radio,container){
			    var radio = radio[0];
			    var container = container[0];
			    if (radio.value == 'si') {
			    	document.getElementById(container.id).removeAttribute('style');
			    }

			}
			function disabledVacunas(radio,container){
			    var radio = radio;
			    var container = container[0];
			    if (radio.value == 'no') {
			        document.getElementById(container.id).setAttribute("style", "display: none;"); 
			    }

			}
			function Busqueda(ci) {
				$.ajax({
		            type: "GET",
		            url: "<?php echo $_ENV['_BASE_URL_'];?>scripts/search_data.php",
		            data: {
		            	id: ci,
		            	mode: 'inscripcion'
		            },
		            success: function(response){
		            	$("#Resultado_busqueda2").html('');
		            	$("#Resultado_busqueda").html(response);
		            }
	    		});
			}
			function Incripcion(escolar) {
				$.ajax({
		            type: "GET",
		            url: "<?php echo $_ENV['_BASE_URL_'];?>scripts/search_data.php",
		            data: {
		            	id: escolar,
		            	mode: 'data_incripcion'
		            },
		            success: function(response){
		            	$("#"+escolar).addClass('disabled');
		            	$("#Resultado_busqueda2").html(response);
		            }
	    		});
			}
			function verificar() {
				var select = $('select[id^="aula_"]');
				var cont = 0;
				if (select.length>0) {
					for (var i = select.length - 1; i >= 0; i--) {
						if (select[i].value != 'null') {
							cont++;
						}
						
					}
					if (select.length == cont) {
						$("#btnSubmit").removeAttr('disabled');
					}
				}
				
			}
		</script>
	<?php elseif ($_GET['page'] == 'registro-usuario'):?>
		<div class="form-panel row">
			<input type="text" hidden id="database" name="database" value="<?= $table?>">
			<h3 class="text-center">Datos personales</h3>
			<div class="form-group row text-center">
				<?php $persona=DescribeTable('persona');
				foreach ($persona as $key => $value):?>
					<?php if ($key <> 'id'):?>
						<div class="row">
							<div class="col-sm-3 col-md-3 col-xs-3">
								<span>
									<?= ucfirst(str_replace("_"," ",$value['Field']))?>
								</span>
							</div>
							<div class="col-sm-9 col-md-9 col-xs-9 form-group">
								<input type="text"class="form-control form-inline" id="<?= $value['Field']?>" required name="<?= $value['Field']?>">
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<h3 class="text-center">Datos Usuario</h3>
			<div class="form-group row text-center">
				<?php $tableUsuario=DescribeTable('usuario'); ?>
				<?php foreach($tableUsuario as $key => $value): ?>
					<?php if ($key <> 'id' && $value['Field'] != 'forgot-pass'):?>
						<div class="row">
							<div class="col-sm-3 col-md-3 col-xs-3">
								<span>
									<?php if ($value['Field'] == 'rol'):?>
										Tipo de usuario
									<?php else: ?>
										<?= ucfirst(str_replace("_"," ",$value['Field']))?>
									<?php endif; ?>
									
								</span>
							</div>
							<div class="col-sm-9 col-md-9 col-xs-9 form-group">
								<?php if($value['Field'] == "rol"):?>
									<select id="<?= $value['Field']?>" name="<?= $value['Field']?>" required class="form-control">
										<?php $option=SelectAll("*",'rol'); ?>
											<option value="NULL" selected>
												Seleccione una opción
											</option>
										<?php foreach ($option as $key => $value): ?>
											<option value="<?= $value['id']?>">
												<?= $value['nombre']?>	
											</option>
										<?php endforeach ?>
									</select>
								<?php else:?>
									<input type="text" required class="form-control form-inline" id="<?= $value['Field']?>" name="<?= $value['Field']?>">
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
				
			</div>
		</div>
	<?php elseif ($_GET['page'] == 'registro-profesor'):?>
		<div class="form-panel row">
			<input type="text" hidden id="database" name="database" value="<?= $table?>">
			<h3 class="text-center">Datos personales</h3>
			<div class="form-group row text-center">
				<?php $persona=DescribeTable('persona');
				foreach ($persona as $key => $value):?>
					<?php if ($key <> 'id'):?>
						<div class="row">
							<div class="col-sm-3 col-md-3 col-xs-3">
								<span>
									<?= ucfirst(str_replace("_"," ",$value['Field']))?>
								</span>
							</div>
							<div class="col-sm-9 col-md-9 col-xs-9 form-group">
								<input type="text" class="form-control form-inline" id="<?= $value['Field']?>" required name="<?= $value['Field']?>">
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<h3 class="text-center">Datos Laborales</h3>
			<div class="form-group row text-center">
				<?php $table=DescribeTable('profesor'); ?>
				<?php foreach($table as $key => $value): ?>
					<?php if ($key <> 'id'):?>
						<div class="row">
							<div class="col-sm-3 col-md-3 col-xs-3">
								<span>
									<?= ucfirst(str_replace("_"," ",$value['Field']))?>
								</span>
							</div>
							<div class="col-sm-9 col-md-9 col-xs-9 form-group">
								<?php if ($value['Field'] == 'aula'): ?>
									<?php 
									$aula=SelectWhere(
										'aula.id, aula.aula, grados.grado,
										secciones.seccion',
									'aula,grados,secciones',
									'aula.grado=grados.id AND aula.seccion=secciones.id AND aula.periodo_escolar="'.$periodo[0]['id'].'"'); ?>
									<select name="<?= $value['Field']?>" id="<?= $value['Field']?>" required class="form-control">
											<option value="NULL" selected>
												Seleccione una opción
											</option>
										<?php foreach ($variable as $key => $value): ?>
											<option value="<?= $value['id']?>">
												<?= $value['aula']?> - <?= $value['grado']?> <?= $value['seccion']?>
											</option>
										<?php endforeach ?>
									</select>
								<?php elseif ($value['Field'] == 'condicion'):?>
									<select name="<?= $value['Field']?>" id="<?= $value['Field']?>" required class="form-control">
										<option value="NULL" selected>
											Seleccione una opción
										</option>
										<option value="1">
											Activo
										</option>
										<option value="0">
											Inactivo
										</option>
									</select>
								<?php else: ?>
									<input type="text" class="form-control form-inline" id="<?= $value['Field']?>" required name="<?= $value['Field']?>">
								<?php endif ?>
								
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
		<div class="text-center">
			<button type="submit" class="btn btn-primary">Registrar</button>
		</div>
	</form>
	<script>
		function validaNumericos(event) {
		    if(event.charCode >= 48 && event.charCode <= 57){
		      return true;
		     }
		     return false;        
		}
		function ci_escolar(){
		    var ci = document.getElementById("id_familiar").value;
		    var fecha = document.getElementById("fecha").value;
		    var array_fecha = fecha.split('-');
		    var fecha_final = array_fecha['0'].substr(-2,2);
		    $.ajax({
		        type: "GET",
		        url: "<?php echo $_ENV['_BASE_URL_'];?>scripts/search_data.php",
		        data: {
		            q: ci,
		            mode: "ci_escolar"
		        },
		        success:(response)=>{
		            var response = $.parseJSON(response);
		            document.getElementById("id_alumno").value = parseInt(response.hermanos+response.ci+fecha_final)
		        }
		    });
		}
		function search_ci(ci) {
		   $.ajax({
		        type: "GET",
		        url: "<?php echo $_ENV['_BASE_URL_'];?>scripts/search_data.php",
		        data: {
		            q: ci,
		            mode: "search_ci"
		        },
		        success: function(response){
		        	var response = $.parseJSON(response);
		        	for (var i = 0; i < response.length; i++) {
		        		console.log(response[i]);
		        	}
		        }
		    });
		}
		function calcularEdad(fecha) {
		    input = fecha[0].value;
		    var hoy = new Date();
		    var cumpleanos = new Date(input);
		    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
		    var m = hoy.getMonth() - cumpleanos.getMonth();
		    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
		        edad--;
		    }
		    $("#edad")[0].value = edad;
		}
		$("#data_form").submit(function(event) {
			event.preventDefault();
			var formData = new FormData(this);
			$.ajax({
	            type: "POST",
	            url: "<?php echo $_ENV['_BASE_URL_'];?>scripts/insert_data_form.php",
	            data: formData,
	            cache:false,
			    contentType: false,
			    processData: false,
	            beforeSend: function(objeto){
	            	swal("Cargando!");
	            },
	            success: function(response){
	            	var page = "<?= $_GET['page'] ?>";
	            	if(page == 'inscripcion'){
	            		$("#Resultado_busqueda2").html('');
	            	}
	            	var response = $.parseJSON(response);
	            	swal(response.titulo, response.descripcion);
	            }
	        });
		});
	</script>