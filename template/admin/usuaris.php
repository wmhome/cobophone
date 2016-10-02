<?php
include("libs/php/funcions.php");
session_start();
ob_start();

if (!$_SESSION['usuarioa'] || $_SESSION['usuarioa']=="Invitado"){
	header("Location:/index.html");
}

$link=conecta();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WhiteMind Library</title>

    <!-- WM CSS Lib -->
    <link href="css/wmhcsslib.css" rel="stylesheet">
    <!-- Slide Menus CSS -->
    <link href="css/components/slidemenu/style.css">
    <!-- DataTables -->
    <link href="css/components/datable/jquery.datatables.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="page-wrap o-wrapper" id="wrapper">
        <header>
            <?php include("layout/header.php");?>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1>Usuarios <small>listado</small><a href="usuaris_new.php" class="btn btn-info pull-right mtm"><span class="fa fa-plus"></span> Añadir usuario</a></h1>
                    </div>
                    <?php
                    $sql0="select * from usuarios order by id_usuario asc";
                    $res0=busqueda($sql0, $link);
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Fecha creación</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                while($row0=recibir_array($res0)){
                                    $estado=$row0['estado'];
                                    $nombre=htmlentities($row0['nombre']);
                                    if($estado==1){
                                        $text_color="text-success";
                                        $action='<a href="#" class="deactivate text-danger" data-toggle="modal" data-target="#deactivate" rel="tooltip" data-original-title="Desactivar" data-user-id="'.$row0['id_user'].'" data-user-name="'.$nombre.'"><i class="ico glyphicon glyphicon-ban-circle"></i></a>';
                                    }
                                    else if($estado==0){
                                    $text_color="text-danger";
                                    $action='<a href="#" class="activate text-success" data-toggle="modal" data-target="#activate" rel="tooltip" data-original-title="Activar"  data-user-id="'.$row0['id_user'].'" data-user-name="'.$nombre.'"><i class="ico glyphicon glyphicon-ok"></i></a>';
                                    }

                                    ?>
                                    <tr>
                                        <td><?php echo $row0['id_usuario'];?></td>
                                        <td><?php echo $nombre;?></td>
                                        <td><?php echo utf8_encode($row0['apellidos']);?></td>
                                        <td><?php echo $row0['fecha_ini'];?></td>
                                        <td><?php echo $row0['tipo'];?></td>
                                        <td class="<?php echo $text_color;?>"><?php echo $row0['estado'];?></td>
                                        <td>
                                            <a href="usuaris_edit.php?id=<?php echo $row0['id_user'];?>" rel="tooltip" data-original-title="Editar" class="mrs"><i class="ico glyphicon glyphicon-edit"></i></a>
                                            <a href="#" class="deleteuser mrs" data-toggle="modal" data-target="#myModal" rel="tooltip" data-original-title="Eliminar" data-user-id="<?php echo $row0['id_user'];?>" data-user-name="<?php echo $nombre;?>"><i class="ico glyphicon glyphicon-trash"></i></a>
                                            <?php echo $action;?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="site-footer">
        <div class="container">
            <p class="text-muted text-center mtl">&copy; WhiteMind - <a href="http://www.whitemind.es" target="_blank">www.whitemind.es</a> - <a href="http://www.wmhome.es" target="_blank">www.wmhome.es</a></p>
        </div>
    </footer>

<!-- Side nav for responsive views -->
<div class="sb-slidebar sb-right sb-style-overlay sb-width-wide plm prm pbm mt52">
    <?php include("layout/side-navs.html");?>
</div>
<!-- Side nav -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="libs/js/bootstrap.min.js"></script>
<script src="libs/js/components/slidemenu/menu.js"></script>
<script src="libs/js/components/slidemenu/side-navs.js"></script>

</body>
</html>