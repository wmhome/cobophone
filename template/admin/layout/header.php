<?php
$rol=$_SESSION['tipo'];
?>
<nav class="navbar navbar-default navbar-slide-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle c-button" id="c-button--push-right">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php" style="padding: 5px 15px;"><img src="assets/img/cerbell.png" style="height: 40px; border: 0; outline: none;" class="img-responsive"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a></li>
        <?php
        if($rol=="superuser" || $rol=="administrador"){
        ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Secciones web <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
          	<li><a href="404.html">Portada web (imágenes)</a></li>
            <li><a href="tarifas.php">Tarifas</a></li>
          </ul>
        </li>
        <?php
        }
        if($rol=="superuser"){
        ?>
        <li><a href="usuaris.php">Usuarios</a></li>
        <?php
        }
        if($rol=="superuser" || $rol=="administrador"){
        ?>
        <li><a href="404.html">Clientes</a></li>
        <?php
        }
        if($rol=="superuser" || $rol=="administrador"){
        ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Productos <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="productos.php">Productos</a></li>
          </ul>
        </li>
        <li><a href="404.html">Blog</a></li>
        <?php
        }
        if($rol=="superuser" || $rol=="comercial"){
        ?>
        <li><a href="404.html">Ventas</a></li>
        <?php
        }
        ?>
      </ul>
      <ul class="nav navbar-nav navbar-right hidden-sm">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?=$_SESSION['usuarioa']?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="profile.php?id=<?=$_SESSION['id_usuarioa']?>">Mi cuenta</a></li>
            <li><a href="calendar.php">Calendar</a></li>
            <li><a href="index.html"><i class="fa fa-sign-out"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>