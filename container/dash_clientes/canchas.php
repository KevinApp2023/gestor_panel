<?php
include("../../config/config.php");
include("../../mod/head.php");

  if (!isset($_SESSION['priv'])){
   header('Location: /');
 } 
 include("../../mod/nav.php");
 
 if (isset($_GET['id']) && !empty($_GET['id'])){

include("../../config/openssl_decrypt_pass_cs.php");
function desencriptar_datos($datos, $clave_secreta) {
  list($encrypted_data, $iv) = explode('::', base64_decode($datos), 2);
  return openssl_decrypt($encrypted_data, 'aes-256-cbc', $clave_secreta, 0, hex2bin($iv));
}

$id_e = $_GET['id'];
$id = desencriptar_datos($id_e, $clave_secreta);

  $consult = "SELECT * FROM canchas WHERE id = '$id' ";
  $consult=mysqli_query($conex,$consult);
  while($tablag=mysqli_fetch_array($consult)){ 
$valor_hora = $tablag['valor_hora'];
  } 
  ?>
<main id="main" class="main">
<div class="pagetitle">
  <h1>Canchas</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Admin</a></li>
      <li class="breadcrumb-item active">Canchas</li>
    </ol>
  </nav>
</div>
<section class="section dashboard">

<div class="col-md-12 mb-2">
    <a id="data_cancha_get" class="btn btn-primary w-100" value="<?= $_GET['id'] ?>" data-bs-toggle="modal" data-bs-target="#nueva_reserva"><i class="bi bi-alarm me-2"></i>Crear Nueva Reserva</a>
  </div>


<input id="cancha" value="<?= $_GET['id'] ?>" class="d-none">
<div id="calendar" style="max-width: 100%; margin: 0 auto;"></div>






<div class="modal fade" id="nueva_reserva" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  p-3">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4 dt " id=""><i class="bx bxs-customize me-2"></i>CREAR NUEVA RESERVA</h1>
      </div>
      <div class="modal-body" id="container_data">
            
      <div class="mb-2">
           <label class="fw-bold text-secondary">Fecha de reserva</label>
           <input  type="date"  id="r_fecha" class="form-control">
       </div>

       <div class="mb-2">
    <label class="fw-bold text-secondary">Hora de inicio</label>
    <input type="time" id="r_hora_inicio" class="form-control" step="1">
</div>

<div class="mb-2">
    <label class="fw-bold text-secondary">Hora de final</label>
    <input type="time" id="r_hora_final" class="form-control" step="1">
</div>

<div class="mb-2">
    <label class="fw-bold text-secondary">Valor de hora</label>
    <div class="input-group">
        <span class="input-group-text">$</span>
        <input readonly type="number" id="r_valor_hora" value="<?= $valor_hora ?>" class="form-control" aria-label="Amount (to the nearest dollar)">
        <span class="input-group-text">.00</span>
    </div>
</div>

<div class="mb-2">
    <label class="fw-bold text-secondary">Cantidad de horas</label>
    <input readonly type="text" id="r_cantidad_horas" class="form-control" readonly>
</div>

<div class="mb-2">
    <label class="fw-bold text-secondary">Total</label>
    <div class="input-group">
        <span class="input-group-text">$</span>
        <input readonly type="text" id="r_total" class="form-control" readonly>
        <span class="input-group-text">.00</span>
    </div>
</div>


<div class="mb-2">
<a id="calcular" class="btn btn-primary w-100"><i class="bi bi-calculator me-2"></i>Calcular</a>   
</div>






      </div>
      <div class="modal-footer">
        <a type="button" id="reserva_cancelar" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Cerrar</a>
       
       <div id="btn_data_reservar">
       </div>

      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="reserva" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  p-3">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4 dt " id="data_modal_reserva_title"><i class="bx bxs-customize me-2"></i></h1>
      </div>
      <div class="modal-body" id="container_data">
            

      
      <table class="table table-bordered">
  <tr>
    <th class="text-start">Referencia</th>
    <td id="referencia"></td>
  </tr>
  <tr>
    <th class="text-start">Cancha</th>
    <td id="r_cancha"></td>
  </tr>
  <tr>
    <th class="text-start">Fecha</th>
    <td id="fecha"></td>
  </tr>
  <tr>
    <th class="text-start">Hora de inicio</th>
    <td id="hora_inicio"></td>
  </tr>
  <tr>
    <th class="text-start">Hora final</th>
    <td id="hora_final"></td>
  </tr>
  <tr>
    <th class="text-start">Cliente</th>
    <td id="cliente"></td>
  </tr>
  <tr>
    <th class="text-start">Cantidad horas</th>
    <td id="cantidad_horas"></td>
  </tr>
  <tr>
    <th class="text-start">Total</th>
    <td id="total"></td>
  </tr>
</table>

      </div>
      <div class="modal-footer">
        <a type="button" id="cancha_cancelar" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Cerrar</a>
        <a type="button" id="cancha_eliminar" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-trash3 me-2"></i>Cancelar</a>
        </div>
    </div>
  </div>
</div>







<script src='/js/index.global.js'></script>

</section>
</main>






 <?php
 }else{
 ?>

<main id="main" class="main">
<div class="pagetitle">
  <h1>Canchas</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Admin</a></li>
      <li class="breadcrumb-item active">Canchas</li>
    </ol>
  </nav>
</div>
<section class="section dashboard">
  <div class="row" id="data_canchas">
  </div>
</section>
</main>





<?php  } ?>




<script src="/js/cancha.js"></script>
<?php 
include('../../mod/footer.php');
include('../../mod/footer_js.php');
?>
 