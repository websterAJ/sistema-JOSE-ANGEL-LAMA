<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Formulario de registro</h4>
      </div>
      <form id="registro">
        <div class="modal-body">
          <input type="text" id="database" name="database" value="<?= $table?>" hidden>
          <?php foreach ($Datatable as $key => $value):?>
            <?php if ($value['Field'] <> 'forgot-pass' && $value['Field']<> 'id'):?>
                <div class="form-group">
                  <label for="">
                    <?php if ($value['Field']=='statud'):?>
                      Estado
                    <?php else: ?>
                      <?= ucfirst(str_replace("_"," ",$value['Field']));?>
                    <?php endif; ?>
                    
                  </label>
                  <?php if ($value['Field'] == 'grado' && $table=='aula'): ?>
                    <select name="<?= $value['Field']?>" id="<?= $value['Field']?>" class="form-control">
                        <option value="null" selected>Seleccione una opcion</option>
                        <?php $grado = SelectAll("*",'grados') ?>
                        <?php foreach ($grado as $key => $value): ?>
                          <option value="<?= $value['id']?>">
                            <?= $value['grado']?>    
                          </option>
                        <?php endforeach ?>
                    </select>
                  <?php elseif ($value['Field'] == 'seccion' && $table=='aula'):?>
                    <select name="<?= $value['Field']?>" id="<?= $value['Field']?>" class="form-control">
                        <option value="null" selected>Seleccione una opcion</option>
                        <?php $secciones = SelectAll("*",'secciones') ?>
                        <?php foreach ($secciones as $key => $value): ?>
                          <option value="<?= $value['id']?>">
                            <?= $value['seccion']?>    
                          </option>
                        <?php endforeach ?>
                    </select>
                  <?php elseif ($value['Field'] == 'periodo_escolar' && $table=='aula'):?>
                    <select name="<?= $value['Field']?>" id="<?= $value['Field']?>" class="form-control">
                        <option value="null" selected>Seleccione una opcion</option>
                        <?php $periodo = SelectWhere("*",'periodo_escolar',"statud=1") ?>
                        <?php foreach ($periodo as $key => $value): ?>
                          <option value="<?= $value['id']?>">
                            <?= $value['titulo']?>    
                          </option>
                        <?php endforeach ?>
                    </select>
                   <?php elseif ($value['Field'] == 'statud'):?>
                    <select name="<?= $value['Field']?>" id="<?= $value['Field']?>" class="form-control">
                        <option value="null" selected>Seleccione una opcion</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                  <?php else: ?>
                    <input type="text" id="<?= $value['Field']?>" name="<?= $value['Field']?>" class="form-control form-inline">
                  <?php endif ?>
                  
                </div>
            <?php endif; ?>  
          <?php endforeach; ?>
        </div>
        <div class="modal-footer text-center">
          <button type="submit" class="btn btn-primary text-center" style="margin: 0 auto;">Agregar</button>
        </div>
      </form>
    </div>
  </div>
  </div>
  <script type="text/javascript">
    $("#registro").submit(function(event) {
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
                console.log(response);
                var response = $.parseJSON(response);
                swal(response.titulo, response.descripcion);
              }
          });
    });
  </script>