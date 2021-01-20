<?php 
	$Datatable=DescribeTable($table);
?>
	<h3><i class="fa fa-angle-right"></i> <?= $title?></h3>
	<div class="form-panel row">
		<form id="data_form" action="#" class="form-horizontal style-form">
			<input type="text" hidden id="database" name="database" value="<?= $table?>">
			<?php 
			switch ($_GET['page']) :
				case 'constancia_estudio':
			?>
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
					<iframe id="Resultado_busqueda2" src="" frameborder="0" width="100%" height="500px" style="display: none;"></iframe>
			<?php		
					break;
			?>
			<?php	
				default:
			?>
					<?php foreach ($Datatable as $key => $value):?>
						<?php if ($value['Field'] <> "id" && $value['Field'] <> "permiso"):?>
							<div class="form-group row text-center">
								<label class="control-label col-md-2 align-middle">
									<b>
										<?php if($value['Field'] == "statud"){
											echo "Estado";
										}else{
											echo ucfirst(str_replace("_"," ",$value['Field']));	
										}
										?>
									</b>
								</label>
								<?php
									$type = explode("(",$value['Type']);
									switch ($type[0]):
										case 'date':
											$element ='<div class="col-sm-10 col-md-10 col-xs-11">';
							                    $element .='<input class="form-control form-control-inline input-medium default-date-picker" size="16" type="text" id="'.$value['Field'].'" name="'.$value['Field'].'">';
							                    $element .='<span class="help-block">Seleccione una fecha</span>';
				                  			$element .='</div>';
											echo $element;
											break;
										case 'varchar':
											$element ='<div class="col-sm-10 col-md-10 col-xs-11">';
											$element .= '<input type="text" id="'.$value['Field'].'" name="'.$value['Field'].'" class="form-control">';
											$element .='</div>';
											echo $element;
											break;
										case 'bigint':
											$element ='<div class="col-sm-10 col-md-10 col-xs-11">';
											$element .= '<input type="number" id="'.$value['Field'].'" name="'.$value['Field'].'" class="form-control">';
											$element .='</div>';
											echo $element;
											break;
										case 'int':
											$element ='<div class="col-sm-10 col-md-10 col-xs-11">';
											$element .= '<select class="custom-select form-control" id="'.$value['Field'].'"  name="'.$value['Field'].'" aria-required="true" aria-invalid="true">';
											$element .='<option value="null">Seleccione una opcion</option>';
											if ($value['Field'] == 'aula') {
												if ($_GET['q']<>'incripcion') {
													$dataOption=SelectWhere('grados.grado, secciones.seccion,aula.aula,aula.id','aula,grados,secciones',"aula.grado=grados.id AND aula.seccion=secciones.id");
													foreach ($dataOption as $key => $aula) {
														$element .='<option value="'.$aula['id'].'">'.$aula['aula']." ".$aula['grado'].' - '.$aula['seccion'].'</option>';
													}
												}
												$element .='</select>';
											}elseif($value['Field'] == 'usuario') {
												$dataOption=SelectWhere('persona, nick, condicion','usuario',"rol<>1");
												foreach ($dataOption as $key => $periodo) {
													if ($periodo['condicion'] == 1) {
														$element .='<option value="'.$periodo['persona'].'">'.$periodo['nick'].'</option>';
													}
												}
												$element .='</select>';
											}elseif($value['Field'] == 'ruta') {
												$dataOption=SelectWhere('ruta, modulo','ruta',"Padre=0");
												foreach ($dataOption as $key => $periodo) {
													$element .='<option value="'.$periodo['ruta'].'">'.$periodo['modulo'].'</option>';
												}
												$element .='</select>';
											}elseif($value['Field'] == 'seccion') {
												$dataOption=SelectAll('*','secciones');
												foreach ($dataOption as $key => $periodo) {
													if ($periodo['statud'] == 1) {
														$element .='<option value="'.$periodo['id'].'">'.$periodo['seccion'].'</option>';
													}
												}
												$element .='</select>';
											}elseif($value['Field'] == 'grado') {
												$dataOption=SelectAll('*','grados');
												foreach ($dataOption as $key => $periodo) {
													if ($periodo['statud'] == 1) {
														$element .='<option value="'.$periodo['id'].'">'.$periodo['grado'].'</option>';
													}
												}
												$element .='</select>';
											}elseif($value['Field'] == 'año_escolar') {
												$dataOption=SelectWhere('*','periodo_escolar',"statud=1");
												foreach ($dataOption as $key => $periodo) {
													if ($periodo['statud'] == 1) {
														$element .='<option value="'.$periodo['id'].'" selected>'.$periodo['titulo'].'</option>';
													}
												}
												$element .='</select>';
											}elseif($value['Field'] == 'representante'){
												$element .='<input type="number" id="'.$value['Field'].'" name="'.$value['Field'].'" class="form-control" style="pointer-events: none;">';
											}else {
												$element .='<input type="number" id="'.$value['Field'].'" name="'.$value['Field'].'" class="form-control">';
											}
											$element .='</div>';
											echo $element;
											break;
										case 'tinyint':
											$element ='<div class="col-sm-10 col-md-10 col-xs-11">';
											$element .= '<select class="form-control" id="'.$value['Field'].'"  name="'.$value['Field'].'" aria-required="true" aria-invalid="true">';
											$element .='<option value="null">Seleccione una opcion</option>';
											if ($value['Field'] == 'sexo') {
												$element .='<option value="1">M</option>';
												$element .='<option value="0">F</option>';
											}elseif ($value['Field'] == 'statud') {
												$element .='<option value="1">Activo</option>';
												$element .='<option value="0">Inactivo</option>';
											}else{
												$element .='<option value="1">Si</option>';
												$element .='<option value="0">No</option>';
											}
											$element .='</select>';
											$element .='</div>';
											echo $element;
											break;
										case 'text':
											$element .='<input type="'.$value['Type'].'" id="'.$value['Field'].'" name="'.$value['Field'].'" class="form-control">';
											echo $element;
											break;
									endswitch;
								?>
								<hr>
					    	</div>
					    <?php endif; ?>
					<?php endforeach; ?>
					<div class="text-center">
						<button type="submit" class="btn btn-primary">Agregar</button>
					</div>
			<?php 
					break;
			?>
			<?php
			endswitch;
			?>
		</form>
	</div>
	<script>
	function Incripcion(escolar) {
		document.getElementById("Resultado_busqueda2").removeAttribute('style');
		$("#Resultado_busqueda2")[0].src = "<?php echo $_ENV['_BASE_URL_'];?>scripts/search_data.php?mode=pdf_incripcion&id="+escolar;
		}
	function Busqueda(ci) {
		$.ajax({
            type: "GET",
            url: "<?php echo $_ENV['_BASE_URL_'];?>scripts/search_data.php",
            data: {
            	id: ci,
            	mode: 'constancia_inscripcion'
            },
            success: function(response){
            	$("#Resultado_busqueda2").html('');
            	$("#Resultado_busqueda").html(response);
            }
		});
	}
	$('#data_form').submit(function(event) {
		event.preventDefault();
		var formData = new FormData(this);
		$.ajax({
            type: "POST",
            url: "<?= $_ENV['_BASE_URL_'];?>scripts/insert_data_form.php",
            data: formData,
            cache:false,
		    contentType: false,
		    processData: false,
            beforeSend: function(objeto){
            	swal("Cargando!");
            },
            success: function(response){
            	var response = $.parseJSON(response);
            	swal(response.titulo, response.descripcion);
            }
        });	
	});
</script>