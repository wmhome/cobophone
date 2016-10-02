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
                    <h1>Tarifas <small>listado</small><a href="tarifas_new.php" class="btn btn-info pull-right mtm"><span class="fa fa-plus"></span> Añadir tarifa</a></h1>
                </div>
                <?php
                    $sql0="select * from marcas where estado=1";
                    $res0=busqueda($sql0, $link);
                ?>
                <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label">Escoge una marca</label>
                        <select class="form-control marca">
                            <option value="0" selected>Escoge una opción</option>
                            <?php
                            while($row0=recibir_array($res0)){
                            $id_marca=$row0['id_marca'];
                            $nombre_marca=utf8_encode($row0['nombre']);
                            ?>
                            <option value="<?=$id_marca?>"><?=$nombre_marca?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label">Escoge un modelo</label>
                        <select class="form-control modelo">
                            <option value="0" selected>Escoge una opción</option>
                        </select>
                    </div>
                </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table1">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Fecha creación</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="reparaciones">

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
<script>
    (function($) {
        $(document).ready(function() {

            //Sergi
            $(".marca").change(function(){
                var id=$(this).val();
                var code=$(".marca").val();
                var dataString='id='+id;
                $.ajax({
                    type: "POST",
                    url: "mods-ajax.php",
                    data: dataString,
                    cache: false,
                    success: function(html){
                        $(".modelo").html(html);
                    }
                });
            });
            $(".modelo").change(function(){
                var id_modelo=$(this).val();
                var id_marca=$(".marca").val();
                var dataString='id_modelo='+id_modelo+'&id_marca='+id_marca;
                $.ajax({
                    type: "POST",
                    url: "mods-rep-ajax.php",
                    data: { id_marca: id_marca, id_modelo: id_modelo },

                    success: function(html){
                        $(".reparaciones").html(html);
                    }
                });
            });
            $('.deleteuser').click(function(){
                var username = $(this).attr('data-user-name');
                var userid = $(this).attr('data-user-id');
                $('.username').html(username);
                $('.userid').html(userid);
                $('.delete-user').attr('data-user-id', userid);
            });
            $('.activate, .deactivate').click(function(){
                var username = $(this).attr('data-user-name');
                var userid = $(this).attr('data-user-id');
                $('.username').html(username);
                $('.userid').html(userid);
                $('.activate-user, .deactivate-user').attr('data-user-id', userid);
            });
            $('.activate-user').click(function(){
                var userid = $(this).attr('data-user-id');
                $.ajax({
                    type: "POST",
                    url: "libs/php/activ_deactiv.php",
                    data: { id: userid, tipo: "activado", taula: "users" }
                })
                        .done(function( msg ) {
                            $('#activate').delay(2000).modal('hide');
                            $('#activate').on('hidden.bs.modal', function (e) {
                                location.reload();
                                $('.alert-success').show('slow');
                            });
                        });
            });
            $('.deactivate-user').click(function(){
                var userid = $(this).attr('data-user-id');
                $.ajax({
                    type: "POST",
                    url: "libs/php/activ_deactiv.php",
                    data: { id: userid, tipo: "desactivado", taula: "users" }
                })
                        .done(function( msg ) {
                            $('#deactivate').delay(2000).modal('hide');
                            $('#deactivate').on('hidden.bs.modal', function (e) {
                                location.reload();
                                $('.alert-success').show('slow');
                            });
                        });
            });
            $('.delete-user').click(function(){
                var userid = $(this).attr('data-user-id');
                $.ajax({
                    type: "POST",
                    url: "libs/php/delete.php",
                    data: { id: userid, taula: "users" }
                })
                        .done(function( msg ) {
                            $('#myModal').delay(2000).modal('hide');
                            $('#myModal').on('hidden.bs.modal', function (e) {
                                location.reload();

                            });
                        });
                $('.alert-success').show('slow');
            });
        });
    }) (jQuery);
</script>
</body>
</html>