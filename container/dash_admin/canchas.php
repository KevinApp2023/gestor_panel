<?php
include("../../config/config.php");
include("../../mod/head.php");

  if (!isset($_SESSION['priv'])){
   header('Location: /');
 } 
 include("../../mod/nav.php");
 
 if (isset($_GET['id']) && !empty($_GET['id'])){ ?>
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
<input id="cancha" value="<?= $_GET['id'] ?>" class="d-none">
<div id="calendar" style="max-width: 100%; margin: 0 auto;"></div>

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
<a class="w-100 btn btn-success mb-3"  id="d_nueva_chancha" data-bs-toggle="modal" data-bs-target="#crear_nueva_chancha"><i class="bx bxs-customize me-2"></i>CREAR CHANCHA</a>
  <div class="row" id="data_canchas">
  </div>
</section>
</main>





<?php  } ?>






<div class="modal fade" id="crear_nueva_chancha" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  p-3">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4" id="perfil_exampleModalFullscreenLabel"><i class="bx bxs-customize me-2"></i>CREAR NUEVA CANCHA</h1>
      </div>
      <div class="modal-body" id="container_data">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-3 mb-2">
                        <label >Nombre de la cancha</label>
                        <input  type="text" id="nombre"  class="border-primary form-control custom-input" Placeholder="Cancha #01">
                    </div>
                    <div class="p-3 mb-2">
                    <label class="fw-bold">SubTotal</label>
                
                    <div class="input-group">
                      <span class="input-group-text">$</span>
                      <input type="number" id="valor_hora" class="form-control" aria-label="Amount (to the nearest dollar)">
                      <span class="input-group-text">.00</span>
                    </div>
                </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <a type="button" id="cancha_cancelar" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Cancelar</a>
        <a type="button" id="cancha_guardar" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-floppy me-2"></i>Guardar</a>
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


<script src="/js/cancha.js"></script>
<?php 
include('../../mod/footer.php');
include('../../mod/footer_js.php');
?>
 