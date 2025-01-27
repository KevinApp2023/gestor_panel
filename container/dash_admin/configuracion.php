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
                    <div class="col-lg-3 col-md-4 label ">NIT</div>
                    <div class="col-lg-9 col-md-8"><?=  $NIT ?></div>
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


                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">

                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Logo principal</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="<?= $icon ?>" class="w-100 p-3" alt="Profile">
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Titulo</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" value="<?= $title ?>" class="form-control" id="fullName" value="Kevin Anderson">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">NIT</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" value="<?= $NIT ?>" class="form-control" id="fullName" value="Kevin Anderson">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">Descripcion</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"><?= $description ?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">keywords</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"><?= $keywords ?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Direccion</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company" value="<?= $direccion ?>" class="form-control" id="company" value="Lueilwitz, Wisoky and Leuschke">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Telefono</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" value="<?= $telefono ?>" class="form-control" id="Job" value="Web Designer">
                      </div>
                    </div>
                    

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>

                </div>


                <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Servidor SMTP</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="" value="<?= $mail_Host ?>" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">SMTP Usuario</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="" value="<?= $mail_Username ?>"   class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">SMTP Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" value="<?= $mail_Password ?>" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">SMTP Puerto</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="" value="<?= $mail_Port ?>" class="form-control" id="renewPassword">
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Conjunto SMTP desde</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="" value="<?= $mail_setFrom ?>" class="form-control" id="renewPassword">
                      </div>
                    </div>


                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Guardar SMTP</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>

</section>

</main>






<?php 
include('../../mod/footer.php');
include('../../mod/footer_js.php');
?>
 