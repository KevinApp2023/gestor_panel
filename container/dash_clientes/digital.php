<?php
include("../../config/config.php");
include("../../mod/head.php");

  if (!isset($_SESSION['priv'])){
   header('Location: /');
 } 
 include("../../mod/nav.php");?>

 <main id="main" class="main">

<div class="pagetitle">
  <h1>Digital</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Clientes</a></li>
      <li class="breadcrumb-item active">Digital</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
    

<div class="card_digital_flip-container" onclick="this.classList.toggle('card_digital_flipped')">
        <div class="card_digital_flipper">
            <div class="card_digital_front text-white d-flex">



            <div class="row w-100  d-flex justify-content-center p-0 m-0">
                <div class=" col-md-4 col-12 d-flex align-items-center ">
                    <div class="p-4">
                        <img src="<?= $icon ?>" class="w-100">
                    </div>
                </div>
                <div class="col-12 d-flex align-items-end ">
                <p class="w-100 text-center mt-auto"><?= $fecha . " " . $hora ?></p>
                </div>
            </div>


</div>


            <div class="card_digital_back d-flex">

            <div class="row w-100  d-flex justify-content-center p-0 m-0">
                <div class=" col-md-6 col-12 d-flex align-items-center ">
                    <div class="w-50 mx-auto bg-white p-2">
                        <img src="/qr_cliente/<?= $_SESSION['propietario'] ?>.png" class="w-100">
                    </div>
                </div>
                <div class="col-md-6 col-12 d-flex align-items-end ">
                <p class="w-100 text-center mt-auto"><?= $fecha . " " . $hora ?></p>
                </div>
            </div>

            </div>



        </div>
    </div>









</section>

</main>




<script src="/js/digital.js"></script>

<?php 
include('../../mod/footer.php');
include('../../mod/footer_js.php');
?>
 