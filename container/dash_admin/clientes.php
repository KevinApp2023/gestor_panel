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
  

</section>
</main>

<?php 
include('../../mod/footer.php');
include('../../mod/footer_js.php');
?>
 