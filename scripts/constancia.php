<page>   
<style type="text/css">
    *{
        margin: 0;
        padding: 0;
    }
    .tabla {
        width: 190mm;
        margin: 5mm 5mm 0mm 5mm;
    }
    #fecha{
        margin: 0 auto;
    }
    #fecha td{
        padding: 10px 25px 10px 25px;
        width: 33.33%;
    }
    .tabla th{
        font-size: 12px;
        padding: 5px;
        text-align: center;
    }
    td {
        border: 1px solid #e2e2e2;
        text-align: center;
    }
    #cabecera{
        text-align: center;
        margin-top: 20px;
        margin-bottom: 10px;
    }
    #cabecera p{
        margin-bottom: 15px; 
    }
    .titulo{
        text-align: center;
    }
</style>
<div id="cabecera">
        <p>
            Republica Bolivariana de Venezuela <br>
            Gobierno del Distrito Capital <br>
            <b>U.E.D “José Ángel Lamas”</b> <br>
            Código del Plantel OD07000105 <br>
        </p>
        <h3>FICHA DE INSCRIPCIÓN</h3>
</div>
        <h4 class="titulo">DATOS DEL(LA)  ESTUDIANTE</h4>
        <table class="tabla">
            <tr style="background-color: grey">
                <th>NACIONALIDAD</th>
                <th>CEDULA</th>
                <th>PRIMER APELLIDO</th>
                <th>SEGUNDO APELLIDO</th>
                <th>PRIMER NOMBRE</th>
                <th>SEGUNDO NOMBRE</th>
            </tr>
            <?php 
            $data = $data[0];
            $nombres = explode(" ",$data['nombres']);
            $apellidos = explode(" ",$data['apellidos']);
            $fecha = explode("-",$data['fecha']);
            ?>
            <tr>
                <td style="padding: 3mm"><?= $data['nacionalidad'] ?></td>
                <td style="padding: 3mm"><?= $data['id']?></td>
                <td style="padding: 3mm"><?= $nombres[0]?></td>
                <td style="padding: 3mm">
                    <?php if (isset($nombres[1])) {
                        echo $nombres[1];
                    } ?>
                </td>
                <td style="padding: 3mm"><?= $apellidos[0]?></td>
                <td style="padding: 3mm">
                    <?php if (isset($apellidos[1])) {
                        echo $apellidos[1];
                    } ?>
                </td>
            </tr>
            <tr style="background-color: grey">
                <th colspan="2">FECHA DE NACIMIENTO</th>
                <th>LUGAR DE NACIMIENTO</th>
                <th>EDAD</th>
                <th>SEXO</th>
                <th>DIR. DE HABITACIÓN</th>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <table id="fecha" width="100%">
                        <tr style="background-color: grey">
                            <th style="padding-top: 5px;padding-bottom: 5px;">DIA</th>
                            <th style="padding-top: 5px;padding-bottom: 5px;">MES</th>
                            <th style="padding-top: 5px;padding-bottom: 5px;">AÑO</th>
                        </tr>
                        <tr>
                            <td><?= $fecha['2']?></td>
                            <td><?= $fecha['1']?></td>
                            <td><?= $fecha['0']?></td>
                        </tr>
                    </table>
                </td>
                <td><?= $data['Lnaciomiento']?></td>
                <td><?= $data['edad']?></td>
                <td>
                    <?php if ($data['sexo']== "1") {
                        echo "Femenino";
                    }else{
                        echo "masculino";
                    } ?>
                </td>
                <td>
                    <?= $data['DHogar']?>
                </td>
            </tr>
            
        </table>
        <table class="tabla">
            <tr style="background-color: grey">
                <th style="width: 15%">PESO ACTUAL</th>
                <th style="width: 15%">ESTATURA</th>
                <th style="width: 20%">TARJETA DE VACUNAS</th>
                <th style="width: 50%">PADECE DE ALGUNA ENFERMEDAD</th>
            </tr>
            <tr>
                <td style="width: 15%"><?= $data['peso']?></td>
                <td style="width: 15%"><?= $data['estatura']?></td>
                <td style="width: 20%">
                    <table style="margin: 0 auto;">
                        <tr style="background-color: grey">
                            <th style="padding-top: 5px;padding-bottom: 5px;width: 50%;">SI</th>
                            <th style="padding-top: 5px;padding-bottom: 5px;width: 50%;">NO</th>
                        </tr>
                        <tr>
                            <?php if ($data['tarjeta_vacunas'] == 'si'):?>
                                <td style="padding: 10px 25px 10px 25px;width: 50%">X</td>
                                <td style="padding: 10px 25px 10px 25px;width: 50%"></td>
                            <?php else: ?>
                                <td style="padding: 10px 25px 10px 25px;width: 50%"></td>
                                <td style="padding: 10px 25px 10px 25px;width: 50%">X</td>
                            <?php endif; ?>
                            
                        </tr>
                    </table>
                </td>
                <td style="width: 50%">
                    <table>
                        <tr style="background-color: grey">
                            <th style="padding-top: 5px;padding-bottom: 5px;width: 33.33%;">SI</th>
                            <th style="padding-top: 5px;padding-bottom: 5px;width: 33.33%;">NO</th>
                            <th style="padding-top: 5px;padding-bottom: 5px;width: 33.33%;">CUAL</th>
                        </tr>
                        <tr>
                            <td style="padding: 10px 25px 10px 25px;width: 33.33%">
                                <?php if($data['enfermedad']=='si'){echo "X";}?>
                            </td>
                            <td style="padding: 10px 25px 10px 25px;width: 33.33%">
                                <?php if($data['enfermedad']=='no'){echo "X";}?>
                            </td>
                            <td style="padding: 10px 25px 10px 25px;width: 33.33%">
                                <?php if($data['enfermedad']=='si'){echo $data['descripcion_enfermedad'];}?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="tabla">
            <tr style="background-color: grey">
                <th style="width: 40%">TIENE ALGÚN IMPEDIMENTO FÍSICO</th>
                <th style="width: 20%">POSEE CANAIMA</th>
                <th style="width: 40%">RECIBE ALGÚN TRATAMIENTO</th>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr style="background-color: grey">
                            <th style="padding-top: 5px;padding-bottom: 5px;width: 33.33%;">SI</th>
                            <th style="padding-top: 5px;padding-bottom: 5px;width: 33.33%;">NO</th>
                            <th style="padding-top: 5px;padding-bottom: 5px;width: 33.33%;">CUAL</th>
                        </tr>
                        <tr>
                            <td style="padding: 10px 25px 10px 25px;width: 33.33%">
                                <?php if($data['impedimento_físico']=='si'){echo "X";}?>
                            </td>
                            <td style="padding: 10px 25px 10px 25px;width: 33.33%">
                                <?php if($data['impedimento_físico']=='no'){echo "X";}?>
                            </td>
                            <td style="padding: 10px 25px 10px 25px;width: 33.33%">
                                <?php if($data['impedimento_físico']=='si'){echo $data['descripcion_impedimento_físico'];}?>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr style="background-color: grey">
                            <th style="padding-top: 5px;padding-bottom: 5px;width: 50%;">SI</th>
                            <th style="padding-top: 5px;padding-bottom: 5px;width: 50%;">NO</th>
                        </tr>
                        <tr>
                            <?php if ($data['canaima'] == 'si'):?>
                                <td style="padding: 10px 25px 10px 25px;width: 50%">X</td>
                                <td style="padding: 10px 25px 10px 25px;width: 50%"></td>
                            <?php else: ?>
                                <td style="padding: 10px 25px 10px 25px;width: 50%"></td>
                                <td style="padding: 10px 25px 10px 25px;width: 50%">X</td>
                            <?php endif; ?>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr style="background-color: grey">
                            <th style="padding-top: 5px;padding-bottom: 5px;width: 33.33%;">SI</th>
                            <th style="padding-top: 5px;padding-bottom: 5px;width: 33.33%;">NO</th>
                            <th style="padding-top: 5px;padding-bottom: 5px;width: 33.33%;">CUAL</th>
                        </tr>
                        <tr>
                            <td style="padding: 10px 25px 10px 25px;width: 33.33%">
                                <?php if($data['tratamiento']=='si'){echo "X";}?>
                            </td>
                            <td style="padding: 10px 25px 10px 25px;width: 33.33%">
                                <?php if($data['tratamiento']=='no'){echo "X";}?>
                            </td>
                            <td style="padding: 10px 25px 10px 25px;width: 33.33%">
                                <?php if($data['tratamiento']=='si'){echo $data['descripcion_tratamiento'];}?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <?php $enfermedades_virales=unserialize($data['enfermedades_virales']); ?>
        <?php $enfermedades_cronicas=unserialize($data['enfermedades_cronicas']); ?>
        <table  class="tabla">
            <tr style="background-color: grey">
                <th colspan="6" style="padding-top: 5px;padding-bottom: 5px;">ENFERMEDADES  QUE A PADECIDO O PADECE</th>
            </tr>
            <tr style="background-color: grey">
                <th style="padding-top: 5px;padding-bottom: 5px;"></th>
                <th style="padding-top: 5px;padding-bottom: 5px;">SI</th>
                <th style="padding-top: 5px;padding-bottom: 5px;">NO</th>
                <th style="padding-top: 5px;padding-bottom: 5px;"></th>
                <th style="padding-top: 5px;padding-bottom: 5px;">SI</th>
                <th style="padding-top: 5px;padding-bottom: 5px;">NO</th>
            </tr>
            <tr>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">LECHINA</td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">
                    <?php if ($enfermedades_virales['Lechina']=="si") {
                        echo "X";
                    }?>
                </td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">
                    <?php if ($enfermedades_virales['Lechina']=="no") {
                        echo "X";
                    }?>
                </td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">ASMA</td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">
                    <?php if ($enfermedades_cronicas['Asma']=="si") {
                        echo "X";
                    }?>
                </td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">
                    <?php if ($enfermedades_cronicas['Asma']=="no") {
                        echo "X";
                    }?>
                </td>
            </tr>
            <tr>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">SARANPION</td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">
                    <?php if ($enfermedades_virales['Sarampión']=="si") {
                        echo "X";
                    }?>
                </td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">
                    <?php if ($enfermedades_virales['Sarampión']=="no") {
                        echo "X";
                    }?>
                </td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">EPILEPCIA</td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">
                    <?php if ($enfermedades_cronicas['Epilepcia']=="si") {
                        echo "X";
                    }?>
                </td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">
                    <?php if ($enfermedades_cronicas['Epilepcia']=="no") {
                        echo "X";
                    }?>
                </td>
            </tr>
            <tr>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">RUBEOLA</td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">
                    <?php if ($enfermedades_virales['Rubeola']=="si") {
                        echo "X";
                    }?>
                </td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">
                    <?php if ($enfermedades_virales['Rubeola']=="no") {
                        echo "X";
                    }?>
                </td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">ALERGIAS</td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">
                    <?php if ($enfermedades_cronicas['Alergias']=="si") {
                        echo "X";
                    }?>
                </td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">
                    <?php if ($enfermedades_cronicas['Alergias']=="no") {
                        echo "X";
                    }?>
                </td>
            </tr>
            <tr>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">PAROTIDITIS</td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">
                    <?php if ($enfermedades_cronicas['Parotiditis']=="si") {
                        echo "X";
                    }?>
                </td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%">
                    <?php if ($enfermedades_cronicas['Parotiditis']=="no") {
                        echo "X";
                    }?>
                </td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%"></td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%"></td>
                <td style="padding: 0px 20px 0px 20px;width: 16.666%"></td>
            </tr>
        </table>
            <?php $vacunas = unserialize($data['descripcion_vacunas']); ?>
        <table class="tabla">
            <tr style="background-color: grey">
                <th>VACUNAS</th>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr style="background-color: grey">
                            <th>VACUNAS</th>
                            <th>SI</th>
                            <th>NO</th>
                            <th>VACUNAS</th>
                            <th>SI</th>
                            <th>NO</th>
                        </tr>
                        <tr>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                ANTIROTAVIRUS
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Antirotavirus']=='si'){echo "X";}?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Antirotavirus']=='no'){echo "X";}?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                DOBLE VIRAL
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Doble_viral']=='si'){echo "X";}?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Doble_viral']=='no'){echo "X";}?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                ANTIHEPATITIS B
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Antihepatitis_B']=='si'){echo "X";}?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Antihepatitis_B']=='no'){echo "X";}?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                ANTIHAEMOPHILUS INFLUENZAE TIPO B
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Antihaemophilus_influenzae_tipo_B']=='si'){echo "X";}?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Antihaemophilus_influenzae_tipo_B']=='no'){echo "X";}?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                TRIPLE BACTERIANA
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Triple_bacteriana']=='si'){echo "X";}?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Triple_bacteriana']=='no'){echo "X";}?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                ANTIMENINGOCOCCICA B-C
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Antimeningococcica_B-C']=='si'){echo "X";}?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Antimeningococcica_B-C']=='no'){echo "X";}?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                TRIVALENTE VIRAL
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Trivalente_viral']=='si'){echo "X";}?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Trivalente_viral']=='no'){echo "X";}?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                TOXOIDE TETANICO
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Toxoide_tetanico']=='si'){echo "X";}?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Toxoide_tetanico']=='no'){echo "X";}?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                ANTIAMARILICA
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Antiamerilica']=='si'){echo "X";}?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php if($vacunas['Antiamerilica']=='no'){echo "X";}?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                TOXOIDE DIFTERICO
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php 
                                if (array_key_exists('Toxoide_difterico',$vacunas)) {
                                    if($vacunas['Toxoide_difterico']=='si'){
                                        echo "X";
                                    }
                                }
                                ?>
                            </td>
                            <td style="padding: 0px 25px 0px 20px;width: 16.666%">
                                <?php 
                                if (array_key_exists('Toxoide_difterico',$vacunas)) {
                                    if($vacunas['Toxoide_difterico']=='no'){
                                        echo "X";
                                    }
                                }
                                ?>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
        <table class="tabla">
            <tr style="background-color: grey">
                <th style="padding-top: 5px;padding-bottom: 5px;background-color: white"></th>
                <th style="padding-top: 5px;padding-bottom: 5px;">SI</th>
                <th style="padding-top: 5px;padding-bottom: 5px;">NO</th>
                <th rowspan="3" style="background-color: white"></th>
                <th>GRUPO SANGUINEO</th>
            </tr>
            <tr>
                <td style="background-color: grey; padding: 0px 25px 0px 20px;">
                    CONTROL PEDIATRICO
                </td>
                <?php if($data['Control_Pediátrico'] == "si"):?>
                    <td>X</td>
                    <td></td>
                <?php else: ?>
                    <td></td>
                    <td>X</td>
                <?php endif; ?>
                
                <td rowspan="2"><?= $data['Grupo_Sanguíneo']?></td>
            </tr>
            <tr>
                <td style="background-color: grey; padding: 0px 25px 0px 20px;">
                    CONTROL NUTRICIONAL
                </td>
                <?php if($data['Control_Nutricional'] == "si"):?>
                    <td>X</td>
                    <td></td>
                <?php else: ?>
                    <td></td>
                    <td>X</td>
                <?php endif; ?>
            </tr>
        </table>
        <table class="tabla">
            <tr style="background-color: grey; padding: 0px 25px 0px 20px;">
                
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
</page>
<page>
    <div id="cabecera">
        <p>
            Republica Bolivariana de Venezuela <br>
            Gobierno del Distrito Capital <br>
            <b>U.E.D “José Ángel Lamas”</b> <br>
            Código del Plantel OD07000105 <br>
        </p>
    </div>
    <h4 class="titulo">DATOS DE INSCRIPCIÓN DEL (LA) ESTUDIANTE</h4>
    <table class="tabla">
        <tr style="background-color: grey">
            <th style="padding-top: 5px;padding-bottom: 5px; width: 20%">AÑO ESCOLAR</th>
            <th style="padding-top: 5px;padding-bottom: 5px; width: 20%">AULA</th>
            <th style="padding-top: 5px;padding-bottom: 5px; width: 20%">GRADO</th>
            <th style="padding-top: 5px;padding-bottom: 5px; width: 20%">SECCIÓN</th>
            <th style="padding-top: 5px;padding-bottom: 5px; width: 20%">PLANTEL DE PROCEDENCIA</th>
        </tr>
        <tr>
            <td style="padding: 5px"><?= $data['titulo']?></td>
            <td style="padding: 5px"><?= $data['aula']?></td>
            <td style="padding: 5px"><?= $data['grado']?></td>
            <td style="padding: 5px"><?= $data['seccion']?></td>
            <td style="padding: 5px"><?= $data['plantelAnterior']?></td>
        </tr>
    </table>
    <h4 class="titulo" style="margin-top: 10px;">DATOS DEL REPRESENTANTE</h4>
    <?php 
    $n_repre = explode(" ",$data['nombre']);
    if (count($n_repre)>2) {
        $p_repre = $n_repre[0];
        $s_repre = $n_repre[1]." ".$n_repre[2];;
    }
    $a_repre = explode(" ",$data['apellido']);
    ?>
    <table class="tabla">
        <tr style="background-color: grey">
            <th style="padding-top: 5px;padding-bottom: 5px;width: 25%">PRIMER APELLIDO</th>
            <th style="padding-top: 5px;padding-bottom: 5px;width: 25%">SEGUNDO  APELLIDO</th>
            <th style="padding-top: 5px;padding-bottom: 5px;width: 25%">PRIMER NOMBRE</th>
            <th style="padding-top: 5px;padding-bottom: 5px;width: 25%">SEGUNDO NOMBRE</th>
        </tr>
        <tr>
            <td><?= $a_repre[0]?></td>
            <td><?= $a_repre[1]?></td>
            <td><?= $p_repre?></td>
            <td><?= $s_repre?></td>
        </tr>
        <tr style="background-color: grey">
            <th>TELÉFONO DE HABITACIÓN</th>
            <th>TELÉFONO DEL TRABAJO</th>
            <th>OCUPACION</th>
            <th>CORREO ELECTRÓNICO</th>
        </tr>
        <tr>
            <td><?= $data['TlfHogar']?></td>
            <td><?= $data['Tlftrabajo']?></td>
            <td><?= $data['ocupacion']?></td>
            <td><?= $data['correo']?></td>
        </tr>
        <tr style="background-color: grey">
            <th>Dir. LABORAR</th>
            <th>NACIONALIDAD</th>
            <th colspan="2">PARENTESCO</th>
        </tr>
        <tr>
            <td><?= $data['Dtrabajo']?></td>
            <td><?= $data['nacionalidad']?></td>
            <td colspan="2"><?php 
                if ($data['Parestesco']=='1') {
                    echo "Madre";
                }elseif($data['Parestesco']=='2'){
                    echo "Padre";
                }elseif($data['Parestesco']=='3'){
                    echo "Familiar a cargo";
                }
            ?></td>
        </tr>
    </table>
</page>
<page>
    <div id="cabecera">
        <p>
            Republica Bolivariana de Venezuela <br>
            Gobierno del Distrito Capital <br>
            <b>U.E.D “José Ángel Lamas”</b> <br>
            Código del Plantel OD07000105 <br>
        </p>
    </div>
    <h4 class="titulo" style="margin: 20px 0px 20px 0px">COMPROMISO DEL REPRESENTANTE LEGAL</h4>
    <div style="width: 190mm;margin: 5mm 5mm 0mm 5mm;">
        <p style="text-align: justify;line-height : 25px;">
            Yo; ________________________________de nacionalidad ________________, mayor de edad, de este domicilio, titular de la Cédula de Identidad  N°  __________________,  me  comprometo  a  hacer  cumplir  por  mi  representado  los  deberes  y  obligaciones  que  imponen  la leyes  y reglamentos vigentes, asi comotambién  a cumplir con el articulo 54 de la ley organica para la protección del niño y del adolescente , y , todas aquellas disposicionesemanadas de las autoridades. Igualmente quedo en cuenta de que en caso de ausencia de esta ciudad, debo dejar otro representante  debidamente  aceptado  por  Ud,  participardel  cambio  de  domicilioo  teléfonoefectuado  en  el  transcurso  de  año.    No se  hace responsable la Dirección de este plantel, en ningún momento, por los perjuicios ocasionados a mi representando por faltade incumplimiento a esta disposición.
        </p>
    </div>
    
    <p style="text-align: center;margin-top: 100px;line-height : 25px;">
        ______________________ <br>
        <b>FIRMA DEL REPRESENTANTELEGAL</b>
        
    </p>
</page>




