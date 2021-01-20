<?php include 'layouts/header.php'; ?>
<div id="login-page" style="height: 620px;">
    <div class="container">
      <form class="form-login" action="#" id="formlogin" method="POST">
        <h2 class="form-login-heading">Inicio de sección</h2>
        <div class="login-wrap">
          <div class="form-group">
            <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" autofocus>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
          </div>
          <button class="btn btn-theme btn-block" id="btnLogin" type="button">
            <i class="fa fa-lock"></i> 
            Iniciar
          </button>

          <hr>

          <div class="registration">
            <span class="pull-center">
            <a data-toggle="modal" href="login.html#myModal"> Perdio su contraseña?</a>
            </span>
          </div>
        </div>
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forgot Password ?</h4>
              </div>
              <div class="modal-body">
                <p>Enter your e-mail address below to reset your password.</p>
                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
              </div>
              <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                <button class="btn btn-theme" type="button">Submit</button>
              </div>
            </div>
          </div>
        </div>
        <!-- modal -->
      </form>
    </div>
</div>
<script>
  $("#btnLogin").click(function(){
            let user = $('#user').val();
            let pass = $('#pass').val();
            if(user == "" || pass == ""){
              swal('Advertencia!', 'Nigunos de los campos puede estar vacios');
            }else{
              $.ajax({
                    type: "POST",
                    url: "scripts/login.php",
                    data:{user: user,pass: pass},
                    beforeSend: function(objeto){
                      swal('Iniciando', 'Cargando......');
                    },
                    success: function(response){
                      if (response == 1) {
                        document.location = "index.php?page=dashboard";
                      }else{
                        swal('Advertencia!', response);
                      }
                    }
                });
            }
        });
</script>
<?php include 'layouts/footer.php'; ?>