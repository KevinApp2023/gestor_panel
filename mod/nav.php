<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/acceso" class="logo d-flex align-items-center">
        <img src="<?= $icon ?>" alt="">
        <span class="d-none d-lg-block"><?= $title ?></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
 

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['nombres'] ?></span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $_SESSION['nombres'] ?></h6>
              <span><?php if (isset($_SESSION['priv'])){ if ($_SESSION['priv'] == 1) { echo "Administrador"; }else if ($_SESSION['priv'] == 2) { echo "Panel"; }else if ($_SESSION['priv'] == 3) { echo "Clientes"; } } ?></span> 
              </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <?php
  if (isset($_SESSION['priv'])){
      if ($_SESSION['priv'] == 1) { ?>

            <li>
              <a class="dropdown-item d-flex align-items-center" id="data_perfil" data-bs-toggle="modal" data-bs-target="#editar_perfil">
                <i class="bi bi-person"></i>
                <span>Mi Perfil</span>
              </a>
            </li>

            <?php }else if ($_SESSION['priv'] == 3) { ?>
              <li>
              <a class="dropdown-item d-flex align-items-center" href="perfil">
                <i class="bi bi-person"></i>
                <span>Mi Perfil</span>
              </a>
            </li>

            <?php }
            } ?>


            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>¿Necesitas ayuda?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/mi/cerrar_session">
                <i class="bi bi-box-arrow-right"></i>
                <span>Cerrar Sesion</span>
              </a>
            </li>

          </ul>
        </li>

      </ul>
    </nav>

  </header>

  <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

<?php
  if (isset($_SESSION['priv'])){
      if ($_SESSION['priv'] == 1) { ?>

  <li class="nav-item ">
    <a class="nav-link active" href="/admin/panel">
      <i class="bi bi-grid"></i>
      <span>Panel</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link " href="/admin/recargos">
      <i class="bi bi-bank"></i>
      <span>Recargos</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link " href="/admin/bonos">
      <i class="bi bi-gift"></i>
      <span>Bonos</span>
    </a>
  </li>



  <li class="nav-item">
    <a class="nav-link " href="/admin/clientes">
      <i class="bi bi-people"></i>
      <span>Clientes</span>
    </a>
  </li>


  <li class="nav-item">
    <a class="nav-link " href="/admin/canchas">
      <i class="bi bi-diagram-3"></i>
      <span>Canchas</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link " href="/admin/reservas">
      <i class="bi bi-alarm"></i>
      <span>Reservas</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link " href="/admin/usuarios">
      <i class="bi bi-shield-lock"></i>
      <span>Usuarios</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link " href="/admin/configuracion">
      <i class="bi bi-gear"></i>
      <span>Configuracion</span>
    </a>
  </li>

  <?php 

     }else if ($_SESSION['priv'] == 2) { 

     }else if ($_SESSION['priv'] == 3) { ?>

<li class="nav-item ">
    <a class="nav-link active" href="/clientes/panel">
      <i class="bi bi-grid"></i>
      <span>Panel</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link " href="/clientes/recargos">
      <i class="bi bi-bank"></i>
      <span>Recargos</span>
    </a>
  </li>
     
  <li class="nav-item">
    <a class="nav-link " href="/clientes/canchas">
      <i class="bi bi-diagram-3"></i>
      <span>Canchas</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link " href="/clientes/reservas">
      <i class="bi bi-alarm"></i>
      <span>Reservas</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link " href="/clientes/digital">
    <i class="bi bi-postcard"></i>
      <span>Digital</span>
    </a>
  </li>

   <?php }

}

?>

</ul>

</aside>



<div class="modal fade" id="editar_perfil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  p-3">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4" id="perfil_exampleModalFullscreenLabel"></h1>
      </div>
      <div class="modal-body" id="container_data">

      <div class="row">
         
                <div class="col-md-12">
                    <div class="p-3">
                        <label >Correo Electronico</label>
                        <input  type="mail" id="perfil_correo"  class="border-primary form-control custom-input" Placeholder="Correo electronico">
                    </div>

                    <div class="p-3">
                        <label >Nombres</label>
                        <input  type="text" id="perfil_nombres" class="border-primary form-control custom-input" Placeholder="Nombres">
                    </div>

                    

                    <div class="p-3">
                        <label >Privilegios</label>
                        <select class="border-primary form-control custom-input" id="perfil_priv" >
                            <option selected class="text-danger" value="" id="sperfil_priv"></option><hr>
                        </select>
                    </div>



                    <div class="p-3">
                        <label >Nueva contraseña</label>
                        <input  type="password" id="perfil_pass" class="border-primary form-control custom-input" Placeholder="* * *">
                    </div>
                    
                  
                </div>

               

 

            </div>
      </div>
      <div class="modal-footer">
        <a type="button" id="perfil_cancelar" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Cancelar</a>
        <a type="button" id="perfil_guardar" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-floppy me-2"></i>Guardar</a>
      </div>
    </div>
  </div>
</div>
