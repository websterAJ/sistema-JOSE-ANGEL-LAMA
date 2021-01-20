  <section id="main-content">
    <section class="wrapper">
      <div class="row">
        <div class="col-md-4 col-sm-4 col-lg-4" style="margin-top: 25px; margin-bottom: 20px;">
          <div class="grey-panel">
            <div class="grey-header">
              <h4>Año Escolar</h4>
            </div>
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                <h3 style="margin-bottom: 25px;color: black;"><?= $periodo[0]['titulo']; ?></h3>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-lg-4" style="margin-top: 25px; margin-bottom: 20px;">
          <div class="darkblue-panel">
            <div class="darkblue-header" style="color: white">
              <h4>Pre-inscrito</h4>
            </div>
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                <?php $pre=SelectAll('count(id) as total','pre_incripcion'); ?>
                <h3 style="margin-bottom: 25px;color: white;"><?= $pre[0]['total'] ?></h3>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-lg-4" style="margin-top: 25px; margin-bottom: 20px;">
          <div class="green-panel">
            <div class="green-header" style="color: white">
              <h4>Inscrito</h4>
            </div>
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                <?php $incripcion=SelectAll('count(id) as total','incripcion'); ?>
                <h3 style="margin-bottom: 25px;color: white;"><?= $incripcion[0]['total'] ?></h3>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 main-chart">
          <?php $grafica=SelectWhere('count(incripcion.id) as total, grados.grado','incripcion, grados, aula','incripcion.aula=aula.id AND aula.grado=grados.id'); ?>
          <?php if (count($grafica)>0):?>
            <div class="border-head">
              <h3>Alumnos inscrito por grados</h3>
            </div>
            <div class="custom-bar-chart">
              <ul class="y-axis">
                <li><span>30</span></li>
                <li><span>25</span></li>
                <li><span>20</span></li>
                <li><span>10</span></li>
                <li><span>5</span></li>
                <li><span>0</span></li>
              </ul>
              
              <?php foreach ($grafica as $key => $value): ?>
                <div class="bar">
                  <div class="title"><?= $value['grado']?></div>
                  <div class="value tooltips" data-original-title="<?= $value['total']?>" data-toggle="tooltip" data-placement="top">
                    <?php number_format(30*$value['total']/100 ,0); ?>
                  </div>
                </div>
              <?php endforeach ?>
            </div>
          <?php endif; ?>
          <!--custom chart end-->
          <div class="row mt">
            <!-- SERVER STATUS PANELS -->
            <div class="col-md-3 col-sm-3 mb">
              <div class="grey-panel pn donut-chart">
                <div class="grey-header">
                  <h5>SERVER LOAD</h5>
                </div>
                <canvas id="serverstatus01" height="120" width="120"></canvas>
                <div class="row">
                  <div class="col-sm-6 col-xs-6 goleft">
                    <p>Usage<br/>Increase:</p>
                  </div>
                  <div class="col-sm-6 col-xs-6">
                    <h2>21%</h2>
                  </div>
                </div>
              </div>
              <!-- /grey-panel -->
            </div>
            <!-- /col-md-4-->
            <div class="col-md-3 col-sm-3 mb">
              <div class="darkblue-panel pn">
                <div class="darkblue-header">
                  <h5>Alumnos por sexo</h5>
                </div>
                <canvas id="serverstatus02" height="120" width="120"></canvas>
                <p>April 17, 2014</p>
              </div>
              <!--  /darkblue panel -->
            </div>
            <!-- /col-md-4 -->
            <div class="col-md-3 col-sm-3 mb">
              <!-- REVENUE PANEL -->
              <div class="green-panel pn">
                <div class="green-header">
                  <h5>REVENUE</h5>
                </div>
                <div class="chart mt">
                  <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
                </div>
                <p class="mt"><b>$ 17,980</b><br/>Month Income</p>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 mb">
              <div class="green-panel pn">
                <div class="green-header">
                  <h5>DISK SPACE</h5>
                </div>
                <canvas id="serverstatus03" height="120" width="120"></canvas>
                
                <h3>60% USED</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
<script>
  var doughnutData = [{
      value: 70,
      color: "#FF6B6B"
    },
    {
      value: 30,
      color: "#fdfdfd"
    }
  ];
  var myDoughnut = new Chart($("#serverstatus01")['0'].getContext("2d")).Doughnut(doughnutData);
</script>
<script>
  var doughnutData = [{
      value: 60,
      color: "#1c9ca7"
    },
    {
      value: 40,
      color: "#f68275"
    }
  ];
  var myDoughnut = new Chart($("#serverstatus02")['0'].getContext("2d")).Doughnut(doughnutData);
</script>
<script>
  var doughnutData = [{
      value: 60,
      color: "#2b2b2b"
    },
    {
      value: 40,
      color: "#fffffd"
    }
  ];
  var myDoughnut = new Chart($("#serverstatus03")['0'].getContext("2d")).Doughnut(doughnutData);
</script>