<?php
include("../../config/config.php");
include("../../mod/head.php");

  if (!isset($_SESSION['priv'])){
   header('Location: /');
 } 
 include("../../mod/nav.php");
 
 if (isset($_GET['id']) && !empty($_GET['id'])){ ?>







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
                    <div class="p-3">
                        <label >Nombre de la cancha</label>
                        <input  type="text" id="nombre"  class="border-primary form-control custom-input" Placeholder="Cancha #01">
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


<script src="/js/cancha.js"></script>
<?php 
include('../../mod/footer.php');
include('../../mod/footer_js.php');
?>
 