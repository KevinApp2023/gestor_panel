<?php
include("../../config/config.php");
include("../../mod/head.php");
if (!isset($_SESSION['priv'])){
   header('Location: /');
 } 
include("../../mod/nav.php");?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Bonos</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Admin</a></li>
      <li class="breadcrumb-item active">Bonos</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
  
<div class="row">

  <div class="col-md-6 mb-2">
    <a id="n_nuevo_bono" data-bs-toggle="modal" data-bs-target="#nuevo_bono" class="btn btn-primary w-100"><i class=" bi bi-gift me-2"></i>Nuevo Bono</a>
  </div>
  
  <div class="col-md-6 mb-2">
    <a id="aplicar_filtro" class="btn btn-primary w-100"><i class=" bi bi-filter-square-fill me-2"></i>Aplicar Filtro</a>
  </div>

  <div class="col-md mb-2">
    <input readonly Placeholder="Fecha Inicio" type="text" id="fecha_inicio" class="border-primary form-control custom-input ">
  </div>

  <div class="col-md mb-2">
    <input readonly Placeholder="Fecha Final" type="text" id="fecha_final" class="border-primary form-control custom-input ">
  </div>

  <div class="col-md mb-2">
    <input Placeholder="Desde" type="number" id="desde" class="border-primary form-control custom-input ">
  </div>  

  <div class="col-md mb-2">
    <select id="tipo" name="tipo" class="border-primary form-control custom-input ">
    <option value="">Tipo</option>
    <option value="1">Sumatoria</option>
    <option value="2">Porcentaje</option>
    </select>
  </div>

  <div class="col-md-12 mt-2">
        <div class="hscroll">
            <table class="table table-striped " id="tabla_datos">
                <thead>
                    <tr>
                        <th clasas=""></th>
                        <th clasas="">Fecha</th>
                        <th clasas="">Hora</th>
                        <th clasas="">Desde</th>
                        <th clasas="">Tipo</th>
                        <th clasas="">Cantidad</th>
                    </tr>
                </thead>
                <tbody id="resultadoBusqueda">

                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal fade" id="nuevo_bono" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  p-3">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4" id="exampleModalFullscreenLabel">Registrar nuevo bono</h1>
      </div>
      <div class="modal-body">


  <div class="mb-3">
                    <label class="fw-bold">Desde</label>
                
                    <div class="input-group">
                      <span class="border-primary input-group-text">$</span>
                      <input type="number" id="n_desde" class=" border-end-0 border-start-0 border-primary form-control" aria-label="Amount (to the nearest dollar)">
                      <span class="border-primary  input-group-text">.00</span>
                    </div>
                </div>


  <div class=" mb-3">
    <select id="n_tipo" name="n_tipo" class="border-primary form-control custom-input ">
    <option value="">Tipo</option>
    <option value="1">Sumatoria</option>
    <option value="2">Porcentaje</option>
    </select>
  </div>

  <div class=" mb-3">
    <input Placeholder="Cantidad" type="number" id="n_cantidad" class="border-primary form-control custom-input ">
  </div>  
      
      </div>
      <div class="modal-footer">
        <a type="button" id="cancelar" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Cancelar</a>
        <a type="button" id="guardar" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-floppy me-2"></i>Guardar</a>
      </div>
    </div>
  </div>
</div>



</section>
</main>
<script src="/js/bonos.js"></script>
<?php 
include('../../mod/footer.php');
include('../../mod/footer_js.php');
?>
 