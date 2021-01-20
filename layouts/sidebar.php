<!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <li class="mt">
            <a class="active" href="index.php?page=dashboard">
              <i class="fa fa-dashboard"></i>
              <span>Inicio</span>
              </a>
          </li>

          <?php
            connect_mysqli();
            if ($_SESSION['type'] == 1):
              $sidebar = SelectWhere(
                        "icon, modulo, Padre, url, ruta",
                        "`ruta`",
                        "Padre='0'"
                    );
            else:
              $sidebar = SelectWhere(
                        "icon, modulo, Padre, url, ruta",
                        "`ruta`,`permisos`",
                        "permisos.persona = '".$_SESSION['id']."' AND permisos.ruta=ruta.ruta"
                    );
            endif;
            $Padre = null;
          ?>
          <?php 
            for ($i=0; $i < count($sidebar); $i++) : ?>
                <li class="sub-menu">
                <?php if($sidebar[$i]['Padre'] == 0):?>
                    <a href="javascript:;">
                      <i class="<?php echo $sidebar[$i]['icon']?>"></i>
                      <span><?php echo $sidebar[$i]['modulo']?></span>
                    </a>
                    <?php  
                        $Padre = $sidebar[$i]['ruta']; 
                        $sub = SelectWhere("icon, modulo, Padre, url","`ruta`","Padre='".$Padre."'");
                    ?>
                    <ul class="sub">
                      <?php for ($j=0; $j < count($sub); $j++):?>
                        <li>
                          <a href="index.php?page=<?php  echo $sub[$j]['url']; ?>">
                            <i class="<?php echo $sub[$j]['icon']?>" style="margin-left: -10px;"></i>
                            <span style="margin-left: -3px;"><?php  echo $sub[$j]['modulo']; ?></span>
                          </a>
                        </li>
                      <?php endfor; ?>
                    </ul>
                </li>
                <?php endif;?>
            <?php endfor;?>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->