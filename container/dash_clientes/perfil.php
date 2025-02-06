<?php
include("../../config/config.php");
include("../../mod/head.php");

  if (!isset($_SESSION['priv'])){
   header('Location: /');
 } 
 include("../../mod/nav.php");?>

 <main id="main" class="main">

<div class="pagetitle">
  <h1>Mi Perfil</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Clientes</a></li>
      <li class="breadcrumb-item active">Perfil</li>
    </ol>
  </nav>
</div>

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          <img id="perfil" src="" alt="Profile" class="rounded-circle">
          <h2 id="perfil_nombres_datta"></h2>
          <h3>Cliente</h3>
          <div class="social-links mt-2">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-8">
      <div class="card">
        <div class="card-body pt-3">
          <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" aria-selected="true" role="tab">Descripción general</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="false" tabindex="-1" role="tab">Editar perfil</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" aria-selected="false" tabindex="-1" role="tab">Cambiar contraseña</button>
            </li>
          </ul>

          <div class="tab-content pt-2">
            <div class="tab-pane fade show active profile-overview" id="profile-overview" role="tabpanel">
              <h5 class="card-title">Detalles del perfil</h5>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Identificación</div>
                <div class="col-lg-9 col-md-8" id="perfil_identificacion"></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Nombre completo</div>
                <div class="col-lg-9 col-md-8" id="perfil_nombre_completo"></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Correo Electrónico</div>
                <div class="col-lg-9 col-md-8" id="perfil_correo_electronico"></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Teléfono</div>
                <div class="col-lg-9 col-md-8" id="perfil_telefono"></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Dirección</div>
                <div class="col-lg-9 col-md-8" id="perfil_direccion"></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Fecha de Registro</div>
                <div class="col-lg-9 col-md-8" id="perfil_fecha_registro"></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Saldo</div>
                <div class="col-lg-9 col-md-8" id="perfil_saldo"></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Estado</div>
                <div class="col-lg-9 col-md-8" id="perfil_estado"></div>
              </div>
            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">
                <div class="row mb-3">
                  <label for="editar_identificacion" class="col-md-4 col-lg-3 col-form-label">Identificación</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="editar_identificacion" type="text" class="form-control" id="editar_identificacion">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="editar_nombres" class="col-md-4 col-lg-3 col-form-label">Nombres</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="editar_nombres" type="text" class="form-control" id="editar_nombres">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="editar_apellidos" class="col-md-4 col-lg-3 col-form-label">Apellidos</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="editar_apellidos" type="text" class="form-control" id="editar_apellidos">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="editar_correo_electronico" class="col-md-4 col-lg-3 col-form-label">Correo Electrónico</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="editar_correo_electronico" type="email" class="form-control" id="editar_correo_electronico">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="editar_telefono" class="col-md-4 col-lg-3 col-form-label">Teléfono</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="editar_telefono" type="text" class="form-control" id="editar_telefono">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="editar_direccion" class="col-md-4 col-lg-3 col-form-label">Dirección</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="editar_direccion" type="text" class="form-control" id="editar_direccion">
                  </div>
                </div>
                <div class="text-center">
                  <a id="editar_perfil" class="btn btn-primary"><i class="bi bi-floppy me-2"></i>Guardar cambios</a>
                </div>
            </div>

           
            <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
              <div id="alert_r_pass"></div>
                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Contraseña Actual</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="password" class="form-control" id="pass_actual">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nueva Contraseña</label>
                  <div class="col-md-8 col-lg-9">
                    <input  type="password" class="form-control" id="n_pass">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Repetir Nueva Contraseña</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="password" class="form-control" id="r_n_pass">
                  </div>
                </div>
                <div class="text-center">
                  <button id="cambiar_pass" class="btn btn-primary"><i class="bi bi-floppy me-2"></i>Cambiar contraseña</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</main>





<script src="/js/perfil.js"></script>
<?php 
include('../../mod/footer.php');
include('../../mod/footer_js.php');
?>
 