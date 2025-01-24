<?php include("../config/config.php"); ?>
<?php include("../mod/head.php"); ?>
<?php include("../mod/footer_js.php"); ?>
<?php if($_GET['s'] == "1"){ ?>



    <div class="col-12">
      <label for="yourUsername" class="form-label">Correo Electronico</label>
      <div class="input-group has-validation">
        <span class="input-group-text" id="inputGroupPrepend">@</span>
        <input type="mail" class="form-control" id="correo" required>
        <div class="invalid-feedback">Por favor, introduzca su correo electronico!.</div>
      </div>
    </div>

<p class="text-center mt-2 text-secondary">Ingresa tu correo registrado para recibir el PIN de restablecimiento</p><br>

<a onclick="continuar_pass_pin()" class="btn btn-primary py-3 w-100 mb-4" >Continuar</a>
<p class="text-center mb-0">¿No tienes una cuenta? <a href="/registrar">Inscribirse</a></p><br>



<?php }else if($_GET['s'] == "2"){

$fecha = date('Y-m-d');
$hora = date('H-i-s');
$correo = $_POST['correo'];
$pin = $_POST['pin'];
$val = '1';


$sql = "UPDATE ress_pass SET val = '2' WHERE correo = '$correo'";
    if ($conex->query($sql) === TRUE) {
    }
    
$sql_pin = "INSERT INTO ress_pass (fecha, hora, correo, pin, val) VALUES (?, ?, ?, ?, ?)";
$stmt_pin = $conex->prepare($sql_pin);
$stmt_pin->bind_param("ssssi",  $fecha, $hora, $correo, $pin, $val);

if ($stmt_pin->execute()) { ?>
 
 

<div class="form-floating mb-3">
    <input type="number" class="form-control text-center" id="pin"  placeholder="PIN">
    <label for="floatingInput">PIN</label>

</div>
<p class="text-center mb-0 text-secondary">Ingresa tu correo registrado para recibir el PIN de restablecimiento</p><br>

<a onclick="validar_pin()" class="btn btn-primary py-3 w-100 mb-4" >Continuar</a>
<p class="text-center mb-0">¿No tienes una cuenta? <a href="/registrar">Inscribirse</a></p><br>
<script>
    function validar_pin() {
var form_data = new FormData();
form_data.append('correo', '<?php echo $correo; ?>');
form_data.append('pin', $('#pin').val());

$.ajax({
    type: "POST",
    url: "/mi/res_pass?s=3",
    data: form_data,
    contentType: false,
    processData: false,
    success: function(response) {
      $('#container_acceso').html(response);

    }
});
}
</script>

<?php }


    }else if($_GET['s'] == "3"){

        $correo = $_POST['correo'];
        $pin = $_POST['pin'];
        $consult = "SELECT * FROM (SELECT * FROM ress_pass WHERE correo = '$correo'  AND pin = '$pin' AND val = '1' ORDER BY id DESC LIMIT 1) subquery  ";
$resultado = $conex->query($consult);
if ($resultado->num_rows > 0) {
    while ($data = $resultado->fetch_assoc()) { ?>



         <div class="col-12">
           <label for="yourPassword" class="form-label">Contraseña</label>
           <input type="password" class="form-control" id="pass" required>
           <div class="invalid-feedback">Por favor, introduzca su contraseña!</div>
         </div>
         <p class="text-center mt-2 text-secondary">Ingresa tu nueva contraseña de seguridad</p><br>
         

    <a onclick="res_pass()" id="acceso" class="btn btn-primary py-3 w-100 mb-4" >Cambiar Contraseña</a>

    <script>
        function res_pass() {
var form_data = new FormData();
form_data.append('correo', '<?php echo $correo; ?>');
form_data.append('pass', $('#pass').val());
$.ajax({
    type: "POST",
    url: "/mi/res_pass?s=4",
    data: form_data,
    contentType: false,
    processData: false,
    success: function(response) {
      $('#container_acceso').html(response);
    }
});
}
      </script>


<?php
    }
}else{?>

<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> El PIN ingresado es inválido. Por favor, verifica e inténtalo de nuevo.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      


<div class="form-floating mb-3">
    <input type="number" class="form-control text-center" id="pin"  placeholder="PIN">
    <label for="floatingInput">PIN</label>

</div>
<p class="text-center mb-0 text-secondary">Ingresa tu correo registrado para recibir el PIN de restablecimiento</p><br>

<a onclick="validar_pin()" class="btn btn-primary py-3 w-100 mb-4" >Continuar</a>
<p class="text-center mb-0">¿No tienes una cuenta? <a href="/registrar">Inscribirse</a></p><br>
<script>
    function validar_pin() {
var form_data = new FormData();
form_data.append('correo', '<?php echo $correo; ?>');
form_data.append('pin', $('#pin').val());

$.ajax({
    type: "POST",
    url: "/mi/res_pass?s=3",
    data: form_data,
    contentType: false,
    processData: false,
    success: function(response) {
      $('#container_acceso').html(response);

    }
});
}
</script>




<?php
}
    }else if($_GET['s'] == "4"){





        if(!empty($_POST['pass'])  ){
            $correo = $_POST['correo'];
            $pass = $_POST['pass'];
            
            function encryptPassword($pass) {
                return sha1($pass);
            }
            $password = encryptPassword($_POST['pass'] ?? '');
            
                $sql = "UPDATE usuario SET pass='$password' WHERE correo='$correo'";
            
            if ($conex->query($sql) === TRUE) { 
                
                $sql_val = "UPDATE ress_pass SET val = '2' WHERE correo = '$correo'";
                if ($conex->query($sql_val) === TRUE) {
                }
                
                ?>
                  <script>
                    Swal.fire({
              title: "Completado",
              text: "La contraseña se ha restablecido exitosamente!",
              icon: "success"
            }).then(() => {
              location.reload();
            });
                  </script>
                  <?php
            }
            
            }else{
                ?>
            
      
                    
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>¡Error!</strong> La nueva contraseña que ha ingresado es inválida. Por favor, verifica e inténtalo de nuevo.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            
    


                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Contraseña</label>
                      <input type="password" class="form-control" id="pass" required>
                      <div class="invalid-feedback">Por favor, introduzca su contraseña!</div>
                    </div>
                    <p class="text-center mt-2 text-secondary">Ingresa tu nueva contraseña de seguridad</p><br>

               


    <a onclick="res_pass()" id="acceso" class="btn btn-primary py-3 w-100 mb-4" >Cambiar Contraseña</a>

            
            
                  <script>
        function res_pass() {
var form_data = new FormData();
form_data.append('correo', '<?php echo $correo; ?>');
form_data.append('pass', $('#pass').val());
$.ajax({
    type: "POST",
    url: "/mi/res_pass?s=4",
    data: form_data,
    contentType: false,
    processData: false,
    success: function(response) {
      $('#container_acceso').html(response);
    }
});
}
      </script>
            
            <?php
            }

    }
    ?>

