      <?php $Datatable=DescribeTable($table); ?>
      <h3><i class="fa fa-angle-right"></i> <?= $title?></h3>
      <div class="row" >
        <div class="col-lg-12 mb">
          <!-- page start-->
          <div class="content-panel" style="padding: 10px">
            <?php if ($_GET['page']== 'grados' || $_GET['page']== 'secciones' ||  $_GET['page']== 'aulas' ):?>
              <button class="btn btn-info" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus-circle"></i>
                Nuevo
              </button>
              <?php include 'modal/registro.php'; ?>
            <?php endif;?>

            <div class="adv-table" style="padding: 10px">
              <table id="example" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <?php foreach ($Datatable as $key => $value):?>
                      <?php if ($value['Field'] <> 'forgot-pass'):?>
                        <?php if ($value['Field']=='id'): ?>
                          <th class="text-center">#</th>
                        <?php elseif($value['Field']=='statud'): ?>
                          <th class="text-center">Estado</th>
                        <?php elseif($value['Field']=='persona'): ?>
                          <th class="text-center">Nombre y Apellido</th>
                        <?php else: ?>
                          <th class="text-center">
                            <?= ucfirst(str_replace("_"," ",$value['Field']));?> 
                          </th>
                        <?php endif ?>
                      <?php endif; ?>  
                    <?php endforeach; ?>
                    <th class="text-center">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php switch ($table):
                        case 'pre_incripcion': 
                          $data = SelectWhere(
                            'CONCAT(alumnos.nombres," ",alumnos.apellidos) as alumno, grados.grado, CONCAT(familiares.nombre," ",familiares.apellido) as representante, periodo_escolar.titulo as perido_escolar, pre_incripcion.statud, pre_incripcion.fecha, pre_incripcion.id',
                            'alumnos, grados, familiares, periodo_escolar, pre_incripcion',
                            'pre_incripcion.alumno=alumnos.id AND pre_incripcion.grado=grados.id AND pre_incripcion.representante=familiares.id AND pre_incripcion.perido_escolar=periodo_escolar.id');

                          foreach ($data as $key => $value):
                    ?>
                          <tr class="text-center">
                                <td><?= $value['id']?></td>
                                <td><?= $value['fecha']?></td>
                                <td><?= $value['alumno']?></td>
                                <td><?= $value['grado']?></td>
                                <td><?= $value['representante']?></td>
                                <td>
                                    <?php if ($value['statud'] == 1): ?>
                                        <span class="badge badge-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Inactivo</span>
                                    <?php endif ?>
                                </td>
                                <td><?= $value['perido_escolar']?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a id="" class="btn btn-primary">
                                          <i class="fa fa-edit"></i>
                                        </a>
                                        <a onclick="" class="btn btn-info">
                                          <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                    <?php
                          endforeach;
                          break;
                        case 'profesor': 
                          $data = SelectWhere(
                            "persona.nombre as nombres, aula.aula as aula",
                            "profesor, persona, aula",
                            "profesor.persona=persona.id AND profesor.aula=aula.id"
                          );
                          foreach ($data as $key => $value):
                    ?>
                          <tr>
                                <td><?= $value['nombres']?></td>
                                <td><?= $value['aula']?></td>
                                <td>
                                    <?php if ($value['condicion'] == 1): ?>
                                        <span class="badge badge-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Inactivo</span>
                                    <?php endif ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a id="" class="btn btn-primary">
                                          <i class="fa fa-edit"></i>
                                        </a>
                                        <a onclick="" class="btn btn-info">
                                          <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                  <?php   endforeach;
                          break;
                        case 'usuario': 
                          $data = SelectWhere(
                            "persona.nombre as nombres, rol.nombre as rol, usuario.nick, usuario.clave, usuario.condicion",
                            "usuario, persona, rol",
                            "usuario.persona=persona.id AND usuario.rol=rol.rol"
                          );
                          foreach ($data as $key => $value):
                  ?>
                            <tr class="text-center">
                                <td><?= $value['nombres']?></td>
                                <td><?= $value['rol']?></td>
                                <td><?= $value['nick']?></td>
                                <td>******</td>
                                <td>
                                    <?php if ($value['condicion'] == 1): ?>
                                        <span class="badge badge-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Inactivo</span>
                                    <?php endif ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a id="" class="btn btn-primary">
                                          <i class="fa fa-edit"></i>
                                        </a>
                                        <a onclick="" class="btn btn-info">
                                          <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                    <?php
                          endforeach;
                            break;
                        case 'aula':
                            $data = SelectWhere(
                              'aula.id, aula.aula, aula.statud, aula.cupos, aula.disponibilidad, grados.grado, secciones.seccion, periodo_escolar.titulo',
                              'aula, grados, secciones, periodo_escolar',
                              "aula.grado=grados.id AND aula.seccion=secciones.id AND aula.periodo_escolar=periodo_escolar.id"
                            );
                            foreach ($data as $key => $value):
                    ?>
                            <tr class="text-center">
                                <td><?= $value['id']?></td>
                                <td><?= $value['aula']?></td>
                                <td><?= $value['grado']?></td>
                                <td><?= $value['seccion']?></td>
                                <td><?= $value['cupos']?></td>
                                <td><?= $value['disponibilidad']?></td>
                                <td>
                                    <?php if ($value['statud'] == 1): ?>
                                        <span class="badge badge-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Inactivo</span>
                                    <?php endif ?>
                                </td>
                                <td><?= $value['titulo']?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a id="" class="btn btn-primary">
                                          <i class="fa fa-edit"></i>
                                        </a>
                                        <a onclick="" class="btn btn-info">
                                          <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                     <?php
                            endforeach;
                          break;
                        default: 
                        $data = SelectAll('*',$table);
                            foreach ($data as $key => $value):
                    ?>
                                <tr class="text-center">
                                    <td><?= $value['id']?></td>
                                    <?php if($table=='grados'): ?>
                                        <td><?= $value['grado']?></td>
                                    <?php elseif($table=='secciones'): ?>
                                        <td><?= $value['seccion']?></td>
                                    <?php elseif ($table=='periodo_escolar'):?>
                                        <td><?= $value['titulo']?></td>
                                        <td><?= $value['fecha_inicial']?></td>
                                        <td><?= $value['fecha_final']?></td>
                                    <?php endif; ?>
                                    <td>
                                        <?php if ($value['statud'] == 1): ?>
                                            <span class="badge badge-success">Activo</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Inactivo</span>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a id="" class="btn btn-primary">
                                              <i class="fa fa-edit"></i>
                                            </a>
                                            <a onclick="" class="btn btn-info">
                                              <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                    <?php
                            endforeach;
                            break;
                      endswitch; 
                    ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- page end-->
        </div>
      </div>
      <script>
        function delete_data(array) {
          $.ajax({
                type: "GET",
                url: "<?= $_ENV['_BASE_URL_'];?>scripts/update_data_form.php",
                data: array,
                beforeSend: function(objeto){
                  swal("Cargando!");
                },
                success: function(response){
                  var response = $.parseJSON(response);
                  swal(response.titulo, response.descripcion);
                }
          }); 
        }
        $(document).ready(function() {
          $('#example').DataTable({
            language: {
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "Ningún dato disponible en esta tabla",
              "sInfo":           "registros del _START_ al _END_",
              "sInfoEmpty":      "registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                  "sFirst":    "Primero",
                  "sLast":     "Último",
                  "sNext":     "Siguiente",
                  "sPrevious": "Anterior"
              },
              "oAria": {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
            }
          });
        });
      </script>