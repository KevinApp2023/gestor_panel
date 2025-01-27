<?php
include("../../config/config.php");
include("../../mod/head.php");

  if (!isset($_SESSION['priv'])){
   header('Location: /');
 } 
 include("../../mod/nav.php");
 $id_cliente = $_SESSION['propietario'];
 ?>

 <main id="main" class="main">





<div class="pagetitle">
  <h1>Panel</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Clientes</a></li>
      <li class="breadcrumb-item active">Panel</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12">
      <div class="row">

        <div class="col-xxl-4 col-6 d-fled">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Reservas</h5>
              <div class="row align-items-center">
                <div class="col-md-auto col-12  mx-auto mb-md-0 mb-4 card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-alarm fs-1"></i>
                </div>
                <div class="col-md-9 col-12 text-md-start text-center">
                  <h6><?php  
                  $reservas_activas = 0;
                  $consult = "SELECT * FROM reservas WHERE id_cliente = '$id_cliente' AND estado = '1' ";
                  $consult=mysqli_query($conex,$consult);
                  while($tablag=mysqli_fetch_array($consult)){
                  $reservas_activas += 1; 
                  }
                  echo $reservas_activas;
                  ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xxl-4 col-6 d-fled">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Mi Saldo</h5>
              <div class="row d-flex align-items-center">
                <div class="col-md-auto col-12  mx-auto mb-md-0 mb-4  card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="col-md-9 col-12 text-md-start text-center ps-3">
                  <h6>$<?php  
                  $consult_saldo = "SELECT * FROM clientes WHERE id = '$id_cliente'";
                  $consult_saldo=mysqli_query($conex,$consult_saldo);
                  while($data_consult_saldo=mysqli_fetch_array($consult_saldo)){
                    echo  $data_consult_saldo['saldo']; 
                  }
                  ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>





        
    <div class="col-md-12 mt-2">
        <div class="hscroll">
            <table class="table table-striped " id="tabla_datos">
                <thead>
                    <tr>
                        <th clasas=""></th>
                        <th clasas="">Referencia</th>
                        <th clasas="">Fecha</th>
                        <th clasas="">Hora</th>
                        <th clasas="">Identificacion</th>
                        <th clasas="">Nombres</th>
                        <th clasas="">Apellidos</th>
                        <th clasas="">Saldo</th>
                        <th clasas="">Estado</th>
                    </tr>
                </thead>
                <tbody id="resultadoBusqueda">

                </tbody>
            </table>
        </div>
    </div>

      </div>
    </div>
  </div>
</section>

</main>


<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>


<script src="/js/panel.js"></script>
<?php 
include('../../mod/footer.php');
include('../../mod/footer_js.php');
?>
 