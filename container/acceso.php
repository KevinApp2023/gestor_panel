<?php 
require('../config/config.php');
require('../mod/head.php');

if (isset($_SESSION['priv'])){

  if ($_SESSION['priv'] == 1) {
     header('Location: admin/panel');
  }
  
  if ($_SESSION['priv'] == 2) {
   header('Location: panel/panel');
  }

  if ($_SESSION['priv'] == 3) {
      header('Location: clientes/panel');
  }

  }

?>


<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="/" class="logo d-flex align-items-center w-auto">
                  <img src="/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Gestor Padel</span>
                </a>
              </div>
              <div class="card mb-3 pt-4">

                <div class="card-body" id="container_acceso">

                <div id="liveAlertPlaceholder"></div>
                  <div class=" pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Inicie sesión</h5>
                    <p class="text-center small">Introduzca su correo y contraseña para iniciar sesión</p>
                  </div>

                  <div class="row g-3 needs-validation">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Correo Electronico</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="mail" class="form-control" id="correo" required>
                        <div class="invalid-feedback">Por favor, introduzca su correo electronico!.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Contraseña</label>
                      <input type="password" class="form-control" id="pass" required>
                      <div class="invalid-feedback">Por favor, introduzca su contraseña!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="ver_pass">
                        <label class="form-check-label" for="rememberMe">Echar un vistazo</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <a class="btn btn-primary w-100" id="acceso">Acceso</a>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">¿No tienes una cuenta? <a href="/registrar">Crea una cuenta</a></p>
                    </div>
                  </div>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>
  <script src="/js/acceso.js"></script>
  <?php 
require('../../mod/footer_js.php');
?>
