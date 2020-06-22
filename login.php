<?php

session_start();
if (isset($_SESSION["user"])){
    header("location:index.php");


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesion</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen">

    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js" charset="utf-8"></script>
    <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>


<body>
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><h3>Iniciar sesion</h3></div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="user" id="user" type="text" placeholder="Usuario o email" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="pass" id="pass" type="password" placeholder="Contraseña" required>
                    </div>
                    
                    <div class="form-group">
                    <center><input type="button" name="login" id="login" value="Ingresar" class="btn btn-success">
                    <a class="btn btn-primary" href="registro.php" role="button">Registrarse</a></center>   

                   </div>
                   <span id="result"></span> 
          </form>
            </div>

        </div>
    </div>
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>


<script>

$(document).ready(function() {
  $('#login').click(function(){
      var user = $('#user').val();
      var pass = $('#pass').val();
      if($.trim(user).length > 0 && $.trim(pass).length > 0){
          $.ajax({
              url:"logueame.php",
              method:"POST", 
              data:{user:user, pass:pass}, 
              cache:"false",
              beforeSend:function(){
                $('#login').val("Ingresar");
              },
              success:function(data) {
                $('#login').val("Ingresar");
                  if (data=="1") {
                      $(location).attr('href','index.php');
                  }else{
                      $("#result").html("<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Error!</strong> las credenciales son incorrectas.</div>");
                  }
              }
          });
      }else{
        $("#result").html("<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Error!</strong> hace falta completar campos</div>");

      };
  });
});

</script>

