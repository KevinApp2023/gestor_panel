<?php
include("../../config/config.php");
include("../../mod/head.php");

  if (!isset($_SESSION['priv'])){
   header('Location: /');
 } 
 include("../../mod/nav.php");?>
<main id="main" class="main">
<div class="pagetitle">
  <h1>Usuario</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Admin</a></li>
      <li class="breadcrumb-item active">Usuario</li>
    </ol>
  </nav>
</div>
<section class="section dashboard">
  


<div class="row">



            
<div class="col-12 p-3">
    <div class="row m-0">
        <div class="col-md-6 col-12 mb-2">
        <a id="nuevo_usuario" data-bs-toggle="modal" data-bs-target="#cargar_nuevos_datos" class="btn btn-primary custom-input w-100 "><i class="bx bxs-user-plus me-2"></i>Nuevo Usuario</a>
        </div>
         <div class="col-md-6 col-12 mb-2">
         <a id="aplicar_filtro" class="btn btn-primary  custom-input w-100 "><i class="bi bi-filter-square-fill me-2"></i>Aplicar Filtro</a>
        </div>
    </div>
</div>





<div class="col-12 p-3 pt-0 container ">
    <div class="row m-0 ">



        <div class="col-md mb-2">
            <select id="priv" class="border-primary form-control custom-input ">
                <option value="">Privilegios</option>
                <option value="1">Administrador</option>
                <option value="2">Cabina</option>
                <option value="3">Cliente</option>
            </select>
        </div>

        

        <div class="col-md mb-2">
            <input Placeholder="Correo electronico" type="mail" id="correo" class="border-primary form-control custom-input ">
        </div>
        
        <div class="col-md mb-2">
            <input Placeholder="Nombres" type="text" id="nombres" class="border-primary form-control custom-input ">
        </div>   
    
        
    </div>
</div>






<div class="col-12 p-2">
    <div class="container">
        <div class="hscroll">
            <table class="table table-striped " id="tabla_datos">
                <thead>
                    <tr>
                        <th clasas=""></th>
                        <th scope="col">Correo</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Privilegios</th>
                    </tr>
                </thead>
                <tbody id="resultadoBusqueda">

                </tbody>
            </table>
        </div>
    </div>
</div>






<div class="modal fade" id="editar_usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  p-3">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4" id="exampleModalFullscreenLabel"></h1>
      </div>
      <div class="modal-body" id="container_data">

      <div class="row">
         
                <div class="col-md-12">
                    <div class="p-3">
                        <label >Correo Electronico</label>
                        <input  type="mail" id="b_correo"  class="border-primary form-control custom-input" Placeholder="Correo electronico">
                    </div>

                    <div class="p-3">
                        <label >Nombres</label>
                        <input  type="text" id="b_nombres" class="border-primary form-control custom-input" Placeholder="Nombres">
                    </div>

                    

                    <div class="p-3">
                        <label >Privilegios</label>
                        <select class="border-primary form-control custom-input" id="b_priv" >
                            <option selected class="text-danger" value="" id="sb_priv"></option><hr>
                            <option value="1">Administrador</option>
                            <option value="2">Cabina</option>
                            <option value="3">Cliente</option>
                        </select>
                    </div>


                    <div class="p-3">
                        <label >Nueva contraseña</label>
                        <input  type="password" id="b_pass" class="border-primary form-control custom-input" Placeholder="* * *">
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




</div>
</section>
</main>



<script src="/js/usuarios.js"></script>
<?php 
include('../../mod/footer.php');
include('../../mod/footer_js.php');
?>
 