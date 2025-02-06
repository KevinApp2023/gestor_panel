<?php
include("../../config/config.php");
include("../../mod/head.php");

  if (!isset($_SESSION['priv'])){
   header('Location: /');
 } 
 include("../../mod/nav.php");?>

 <main id="main" class="main">

<div class="pagetitle">
  <h1>Configuracion</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Admin</a></li>
      <li class="breadcrumb-item active">Configuracion</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
  
<div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                <li class="nav-item" role="presentation">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" aria-selected="true" role="tab">Descripcion general</button>
                </li>

                <li class="nav-item" role="presentation">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="false" role="tab" tabindex="-1">Editar</button>
                </li>


                <li class="nav-item" role="presentation">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" aria-selected="false" role="tab" tabindex="-1">SMTP</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade profile-overview active show" id="profile-overview" role="tabpanel">
                  <h5 class="card-title"><?= $title ?></h5>
                  <p class="small fst-italic"><?= $description ?></p>

                  <h5 class="card-title">Detalles del perfil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">RIF</div>
                    <div class="col-lg-9 col-md-8"><?=  $RIF ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Direccion</div>
                    <div class="col-lg-9 col-md-8"><?= $direccion ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Telefono</div>
                    <div class="col-lg-9 col-md-8"><?= $telefono  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Correo electronico</div>
                    <div class="col-lg-9 col-md-8"><?= $mail_Username ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Proximo consecutivo</div>
                    <div class="col-lg-9 col-md-8"><?= $l_consecutivo . $n_consecutivo ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">

                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Logo principal</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="<?= $icon ?>" class="w-100 p-3" alt="Profile" id="icon">
                        <div class="pt-2">
                          <a id="abrir_input_file_icon" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload me-2"></i> Seleccionar Icono</a>
                          <input id="input_file_icon" accept=".jpg, .jpeg, .png" type="file" class="d-none rounded border border-secondary form-control bg-white p-2" id="icon">
                        
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Titulo</label>
                      <div class="col-md-8 col-lg-9">
                        <input value="<?= $title ?>" class="form-control" id="title">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">RIF</label>
                      <div class="col-md-8 col-lg-9">
                        <input value="<?= $RIF ?>" class="form-control" id="RIF" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">Descripcion</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea class="form-control" id="description" style="height: 100px"><?= $description ?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">keywords</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea class="form-control" id="keywords" style="height: 100px"><?= $keywords ?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Direccion</label>
                      <div class="col-md-8 col-lg-9">
                        <input  value="<?= $direccion ?>" class="form-control" id="direccion">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Telefono</label>
                      <div class="col-md-8 col-lg-9">
                        <input value="<?= $telefono ?>" class="form-control" id="telefono">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Consecutivo Factura y Ticket Recargos</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="row">
                          <div class="col-6"><input value="<?= $l_consecutivo ?>" class="form-control" id="l_consecutivo"></div>
                          <div class="col-6"><input value="<?= $n_consecutivo ?>" class="form-control" id="n_consecutivo"></div>
                        </div>
                        
                        
                      </div>
                    </div>
                    

                    <div class="text-center">
                      <a id="guardar_cambios_general" class="btn btn-primary">Guardar cambios</a>
                    </div>

                </div>


                <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Servidor SMTP</label>
                      <div class="col-md-8 col-lg-9">
                        <input value="<?= $mail_Host ?>" class="form-control" id="mail_Host">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">SMTP Usuario</label>
                      <div class="col-md-8 col-lg-9">
                        <input value="<?= $mail_Username ?>"   class="form-control" id="mail_Username">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">SMTP Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="password" value="<?= $mail_Password ?>" class="form-control" id="mail_Password">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">SMTP Puerto</label>
                      <div class="col-md-8 col-lg-9">
                        <input value="<?= $mail_Port ?>" class="form-control" id="mail_Port">
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Conjunto SMTP desde</label>
                      <div class="col-md-8 col-lg-9">
                        <input value="<?= $mail_setFrom ?>" class="form-control" id="mail_setFrom">
                      </div>
                    </div>


                    <div class="text-center">
                      <a id="guardar_cambios_smtp" class="btn btn-primary">Guardar SMTP</a>
                    </div>
                  </form>

                </div>

              </div>

            </div>
          </div>

        </div>

</section>

</main>




<script src="/js/config.js"></script>

<?php 
include('../../mod/footer.php');
include('../../mod/footer_js.php');
?>
 