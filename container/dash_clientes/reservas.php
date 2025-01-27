<?php
include("../../config/config.php");
include("../../mod/head.php");
if (!isset($_SESSION['priv'])){
   header('Location: /');
 } 
include("../../mod/nav.php");?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Reservas</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Clientes</a></li>
      <li class="breadcrumb-item active">Reservas</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
  
<div class="row">
  
<div class="col-md-6 mb-2">
    <a href="canchas" class="btn btn-primary w-100"><i class="bi bi-alarm me-2"></i>Nueva Reserva</a>
  </div>

  <div class="col-md-6 mb-2">
    <a id="aplicar_filtro" class="btn btn-primary w-100"><i class=" bi bi-filter-square-fill me-2"></i>Aplicar Filtro</a>
  </div>

    <div class="col-md mb-2">
    <select id="cancha" name="cancha" class="border-primary form-control custom-input " onchange="sede()"  >
    <option value="">Canchas</option>
    <?php  $consult = "SELECT * FROM canchas";
            $consult=mysqli_query($conex,$consult);
            while($tablag=mysqli_fetch_array($consult)){ ?>
            <option value="<?php echo $tablag['nombre']; ?>" ><?php echo $tablag['nombre']; ?></option>
            <?php
            }
            ?>
    </select>
  </div>

  <div class="col-md mb-2">
    <input  Placeholder="Referencia" type="text" id="referencia" class="border-primary form-control custom-input ">
  </div>  

  <div class="col-md mb-2">
    <input readonly Placeholder="Fecha Inicio" type="text" id="fecha_inicio" class="border-primary form-control custom-input ">
  </div>

  <div class="col-md mb-2">
    <input readonly Placeholder="Fecha Final" type="text" id="fecha_final" class="border-primary form-control custom-input ">
  </div>


  <div class="col-md mb-2">
    <input Placeholder="Nombres" type="text" id="nombres" class="border-primary form-control custom-input ">
  </div>   
  
  <div class="col-md mb-2">
    <input Placeholder="Apellidos" type="text" id="apellidos" class="border-primary form-control custom-input ">
  </div> 
  
  <div class="col-md mb-2">
    <select id="estado" name="estado" class="border-primary form-control custom-input " onchange="sede()"  >
    <option value="">Estado</option>
    <option value="1">Reservado</option>
    <option value="2">Ocupado</option>
    <option value="3">Completado</option>
    <option value="4">Cancelado</option>
    </select>
  </div>


  <div class="col-md-12 mt-2">
        <div class="hscroll">
            <table class="table table-striped " id="tabla_datos">
                <thead>
                    <tr>
                        <th clasas=""></th>
                        <th clasas="">Referencia</th>
                        <th clasas="">Cancha</th>
                        <th clasas="">Cliente</th>
                        <th clasas="">Fecha de reserva</th>
                        <th clasas="">Hora inicio</th>
                        <th clasas="">Hora final</th>
                        <th clasas="">Valor horas</th>
                        <th clasas="">Cantidad Horas</th>
                        <th clasas="">Total</th>
                        <th clasas="">Estado</th>
                    </tr>
                </thead>
                <tbody id="resultadoBusqueda">

                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal fade" id="reserva" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  p-3">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4 dt " id="de_data_modal_reserva_title"><i class="bx bxs-customize me-2"></i></h1>
      </div>
      <div class="modal-body" id="container_data">
            

      
      <table class="table table-bordered">
  <tr>
    <th class="text-start">Referencia</th>
    <td id="de_referencia"></td>
  </tr>
  <tr>
    <th class="text-start">Cancha</th>
    <td id="de_r_cancha"></td>
  </tr>
  <tr>
    <th class="text-start">Fecha</th>
    <td id="de_fecha"></td>
  </tr>
  <tr>
    <th class="text-start">Hora de inicio</th>
    <td id="de_hora_inicio"></td>
  </tr>
  <tr>
    <th class="text-start">Hora final</th>
    <td id="de_hora_final"></td>
  </tr>
  <tr>
    <th class="text-start">Cliente</th>
    <td id="de_cliente"></td>
  </tr>
  <tr>
    <th class="text-start">Cantidad horas</th>
    <td id="de_cantidad_horas"></td>
  </tr>
  <tr>
    <th class="text-start">Total</th>
    <td id="de_total"></td>
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



</section>
</main>
<script src="/js/reservas.js"></script>
<?php 
include('../../mod/footer.php');
include('../../mod/footer_js.php');
?>
 