<?php
include("../../config/config.php");
include("../../mod/head.php");
if (!isset($_SESSION['priv'])){
   header('Location: /');
 } 
include("../../mod/nav.php");?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Clientes</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Admin</a></li>
      <li class="breadcrumb-item active">Clientes</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
  
<div class="row">

  <div class="col-md-6 mb-2">
    <a id="n_nuevo_cliente" data-bs-toggle="modal" data-bs-target="#nuevo_cliente" class="btn btn-primary w-100"><i class=" bi bi-person-plus-fill me-2"></i>Nuevo Cliente</a>
  </div>
  
  <div class="col-md-6 mb-2">
    <a id="aplicar_filtro" class="btn btn-primary w-100"><i class=" bi bi-filter-square-fill me-2"></i>Aplicar Filtro</a>
  </div>

  
  <div class="col-md mb-2">
    <input Placeholder="Identificacion" type="text" id="identificacion" class="border-primary form-control custom-input ">
  </div>
  
  <div class="col-md mb-2">
    <input Placeholder="Nombres" type="text" id="nombres" class="border-primary form-control custom-input ">
  </div>   
  
  <div class="col-md mb-2">
    <input Placeholder="Apellidos" type="text" id="apellidos" class="border-primary form-control custom-input ">
  </div> 
  
  <div class="col-md mb-2">
    <input Placeholder="Correo electronico" type="text" id="correo_electronico" class="border-primary form-control custom-input ">
  </div>

  <div class="col-md mb-2">
    <input Placeholder="Telefono" type="text" id="telefono" class="border-primary form-control custom-input ">
  </div>  

  <div class="col-md mb-2">
    <select id="estado" name="estado" class="border-primary form-control custom-input " onchange="sede()"  >
    <option value="">Estado</option>
    <option value="1">Activo</option>
    <option value="2">Suspendido</option>
    </select>
  </div>

  <div class="col-md-12 mt-2">
        <div class="hscroll">
            <table class="table table-striped " id="tabla_datos">
                <thead>
                    <tr>
                        <th clasas=""></th>
                        <th clasas="">Identificacion</th>
                        <th clasas="">Nombres</th>
                        <th clasas="">Apellidos</th>
                        <th clasas="">Correo electronico</th>
                        <th clasas="">Telefono</th>
                        <th clasas="">saldo</th>
                        <th clasas="">Estado</th>
                    </tr>
                </thead>
                <tbody id="resultadoBusqueda">

                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal fade" id="editar_cliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen p-3">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4" id="exampleModalFullscreenLabel"></h1>
      </div>
      <div class="modal-body">

      <div class="row">
                
                <div class="col-sm-12 col-md-4">

                    <div class="p-3">
                        <label >Identificacion</label>
                        <input  type="text" id="b_identificacion"  class="border-primary form-control custom-input" Placeholder="Identificacion">
                    </div>
                    <div class="p-3">
                        <label >Nombres</label>
                        <input  type="text" id="b_nombres" class="border-primary form-control custom-input" Placeholder="Nombres">
                    </div>
                    <div class="p-3">
                        <label >Apellidos</label>
                        <input  type="text" id="b_apellidos" class="border-primary form-control custom-input" Placeholder="Apellidos">
                    </div>
                  
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="p-3">
                        <label >Direccion</label>
                        <input  type="text" id="b_direccion" class="border-primary form-control custom-input" Placeholder="Direccion">
                    </div>
                    <div class="p-3">
                        <label >Fecha de registro</label>
                        <input  type="text" id="b_fecha_registro" class="border-primary form-control custom-input" Placeholder="Fecha de registro">
                    </div>
                    <div class="p-3">
                        <label >Saldo</label>
                        <input  type="text" id="b_saldo" class="border-primary form-control custom-input" Placeholder="Saldo">
                    </div>
                   
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="p-3">
                        <label >Correo</label>
                        <input  type="mail" id="b_correo_electronico" class="border-primary form-control custom-input" Placeholder="Correo">
                    </div>
                    <div class="p-3">
                        <label >Telefono</label>
                        <input  type="text" id="b_telefono" class="border-primary form-control custom-input" Placeholder="Telefono">
                    </div>

                    <div class="p-3">
                        <label >Estado</label>
                        <div id="b_estado"></div>
                    </div>

                </div>

            </div>
      </div>
      <div class="modal-footer">
        <a type="button" id="cancelar" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Cancelar</a>
        <a type="button" id="eliminar" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-trash3 me-2"></i>Eliminar</a>
        <a type="button" id="guardar" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-floppy me-2"></i>Guardar</a>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="nuevo_cliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen p-3">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4" id="exampleModalFullscreenLabel"></h1>
      </div>
      <div class="modal-body">

      <div class="row">
                
                <div class="col-sm-12 col-md-4">

                    <div class="p-3">
                        <label >Identificacion</label>
                        <input  type="text" id="n_identificacion"  class="border-primary form-control custom-input" Placeholder="Identificacion">
                    </div>
                    <div class="p-3">
                        <label >Nombres</label>
                        <input  type="text" id="n_nombres" class="border-primary form-control custom-input" Placeholder="Nombres">
                    </div>
                    <div class="p-3">
                        <label >Apellidos</label>
                        <input  type="text" id="n_apellidos" class="border-primary form-control custom-input" Placeholder="Apellidos">
                    </div>
                  
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="p-3">
                        <label >Direccion</label>
                        <input  type="text" id="n_direccion" class="border-primary form-control custom-input" Placeholder="Direccion">
                    </div>
                    <div class="p-3">
                        <label >Fecha de registro</label>
                        <input  type="date" id="n_fecha_registro" class="border-primary form-control custom-input" Placeholder="Fecha de registro">
                    </div>
                    <div class="p-3">
                        <label >Saldo</label>
                        <input  type="text" id="n_saldo" class="border-primary form-control custom-input" Placeholder="Saldo">
                    </div>
                   
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="p-3">
                        <label >Correo</label>
                        <input  type="mail" id="n_correo_electronico" class="border-primary form-control custom-input" Placeholder="Correo">
                    </div>
                    <div class="p-3">
                        <label >Telefono</label>
                        <input  type="text" id="n_telefono" class="border-primary form-control custom-input" Placeholder="Telefono">
                    </div>

                    <div class="p-3">
                        <label >Estado</label>
                        <div id="n_estado">
                        <a id="n_estado_data" value="1" class="btn btn-success w-100" ><i class="bi bi-check-circle me-2"></i>Activo</a>
                        </div>
                    </div>

                </div>

            </div>
      </div>
      <div class="modal-footer">
        <a type="button" id="cancelar" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Cancelar</a>
        <a type="button" id="n_guardar" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-floppy me-2"></i>Guardar nuevo cliente</a>
      </div>
    </div>
  </div>
</div>


</section>
</main>
<script src="/js/clientes.js"></script>
<?php 
include('../../mod/footer.php');
include('../../mod/footer_js.php');
?>
 