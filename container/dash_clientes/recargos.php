<?php
include("../../config/config.php");
include("../../mod/head.php");
if (!isset($_SESSION['priv'])){
   header('Location: /');
 } 
include("../../mod/nav.php");
if (isset($_GET['referencia']) && !empty($_GET['referencia'])){
    $referencia = $_GET['referencia'];
$sql = "SELECT r.*, c.identificacion, c.nombres, c.apellidos FROM recargos r LEFT JOIN clientes c ON r.cliente = c.id WHERE r.referencia = '$referencia'";
$resultado = $conex->query($sql);
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $data_id = $fila['id'];
        $data_referencia = $fila['referencia'];
        $data_fecha = $fila['fecha'];
        $data_hora = $fila['hora'];
        $data_cliente = $fila['cliente'];
        $data_identificacion = $fila['identificacion'];
        $data_nombres = $fila['nombres'];
        $data_apellidos = $fila['apellidos'];
        $data_sub_total = $fila['sub_total'];
        $data_bono =$fila['bono'];
        $data_iva = $fila['iva'];
        $data_total = $fila['total'];
        if($fila['estado'] == '1'){
          $data_estado = '<a class="btn btn-success w-100">Aprobado</a>';
      }else{
          $data_estado = '<a class="btn btn-danger w-100">Anulado</a>';
      }
    }
}

?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Recargos</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Clientes</a></li>
      <li class="breadcrumb-item"><a href="/panel/recargos">Recargos</a></li>
      <li class="breadcrumb-item active"><?= $_GET['referencia'] ?></li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h6 class="fw-bold border-bottom pb-2">Cliente</h6>
                <div class="mb-2">
                    <label class="fw-bold">Identificación:</label>
                    <input readonly type="text" value="<?= $data_identificacion ?>" id="identificacion" class="form-control" placeholder="Identificación">
                </div>
                <div class="mb-2">
                    <label class="fw-bold">Nombres:</label>
                    <input readonly type="text" value="<?= $data_nombres ?>" id="nombres" class="form-control" placeholder="Nombres">
                </div>
                <div class="mb-2">
                    <label class="fw-bold">Apellidos:</label>
                    <input readonly type="text" value="<?= $data_apellidos ?>" id="apellidos" class="form-control" placeholder="Apellidos">
                </div>
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold border-bottom pb-2">Factura de Venta</h6>
                <div class="mb-2">
                    <label class="fw-bold">Referencia:</label>
                    <input readonly type="text" value="<?= $data_referencia ?>" id="referencia" class="form-control" placeholder="Referencia">
                </div>
                <div class="row">
                  <div class="col-6">
                  <div class="mb-2">
                    <label class="fw-bold">Fecha:</label>
                    <input readonly type="text" value="<?= $data_fecha ?>" id="fecha" class="form-control" placeholder="Fecha">
                </div>
                  </div>
                  <div class="col-6">
                    <div class="mb-2">
                    <label class="fw-bold">Hora:</label>
                    <input readonly type="text" value="<?= $data_hora ?>" id="hora" class="form-control" placeholder="Hora">
                </div></div>
                </div>

                <div class="mb-2">
                    <label class="fw-bold">Estado:</label>
                    <?= $data_estado ?>
                </div>
               
                
            </div>
        </div>

        <!-- Tabla de Detalles -->
        <div class="row mt-4">
            <div class="col-12">
            <h6 class="fw-bold border-bottom pb-2">Detalles</h6>
            <div class="hscroll">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Recarga de saldo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
        </div>

        <!-- Totales -->
        <div class="row">
            <div class="col-md-6 order-md-1 order-2">
                <a id="factura" data-ref="<?= $_GET['referencia'] ?>" class="btn btn-primary w-100 mb-2"><i class="bx bxs-file-pdf me-2"></i>Factura</a>
              </div>
            <div class="col-md-6 order-md-2 order-1">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>Total Bruto:</th>
                            <td class="text-end">$<?= $data_sub_total ?></td>
                        </tr>
                        <tr>
                            <th>Bono:</th>
                            <td class="text-end">$<?= $data_bono ?></td>
                        </tr>
                        <tr>
                        <th>IVA (<?= $iva ?>%):</th>
                        <td class="text-end">$<?= $data_iva ?></td>
                        </tr>
                        <tr class="fw-bold">
                            <th>Total a Pagar:</th>
                            <td class="text-end">$<?= $data_total ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
           
        </div>

        <!-- Notas -->
        <div class="row">
            <div class="col-12">
                <p class="border-top pt-3 text-center">
                    <strong>Condiciones de Pago:</strong> Crédito o efectivo según negociado. 
                    <br>
                    Recuerde consultar su cuenta para verificar si el pago fue realizado.
                </p>
            </div>
        </div>
    </div>
</section>

<?php 
}else{
?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Recargos</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Clientes</a></li>
      <li class="breadcrumb-item active">Recargos</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
  
<div class="row">

  
  <div class="col-md-12 mb-2">
    <a id="aplicar_filtro" class="btn btn-primary w-100"><i class=" bi bi-filter-square-fill me-2"></i>Aplicar Filtro</a>
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
    <input Placeholder="Identificacion" type="text" id="identificacion" class="border-primary form-control custom-input ">
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
    <option value="1">Aprobado</option>
    <option value="2">Anulado</option>
    </select>
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




</section>
</main>
<?php 
}
?>
 
<script src="/js/recargos.js"></script>
<?php 
include('../../mod/footer.php');
include('../../mod/footer_js.php');
?>
 