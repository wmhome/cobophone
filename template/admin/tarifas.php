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
        <?php
  		if($_GET['mod']=='ok' || $_GET['insert']=='ok'){
  		?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="fa fa-check"></span> La consulta se ha realizado con éxito.
        </div>
        <?php
  		}
  		else if($_GET['mod']=='no' || $_GET['insert']=='no'){
  		?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="fa fa-exclamation"></span> Ha ocurrido algún problema, vuela a intentarlo en unos minutos.
        </div>
        <?php
  		}
  		?>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h1>Tarifas <small>listado</small><a href="tarifas_new.php" class="btn btn-info pull-right mtm"><span class="fa fa-plus"></span> Añadir tarifa</a></h1>
                </div>
                <?php
                    $sql0="select * from marcas where estado=1";
                    if($_GET['id_marca']){
                        $id_marca_default=$_GET['id_marca'];
                        $sql00="select nombre from marcas where id_marca='$id_marca_default'";
                        $res00=busqueda($sql00, $link);
                        $row00=recibir_array($res00);
                        $nombre_marca_default=utf8_encode($row00[0]);
                        $sql0="select * from marcas where estado=1 and id_marca!='$id_marca_default'";
                    }
                    else{
                        $nombre_marca_default="Escoge una opción";
                    }
                    $res0=busqueda($sql0, $link);
                ?>
                <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label">Escoge una marca</label>
                        <select class="form-control marca">
                            <option value="<?=$id_marca_default?>" selected><?=$nombre_marca_default?></option>
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
                            <?php
                             if($_GET['id_modelo']!=0){
                                $id_modelo_default=$_GET['id_modelo'];
                                $sql_mod_default="select nombre from modelos where id_modelo='$id_modelo_default'";
                                $res_mod_default=busqueda($sql_mod_default, $link);
                                $row_mod_default=recibir_array($res_mod_default);
                                $nombre_modelo_default=utf8_encode($row_mod_default['nombre']);
                                $sql_mod="select * from modelos where id_modelo!='$id_modelo'";
                                $res_mod=busqueda($sql_mod, $link);
                                $class_mod="clas";
                              }
                              if($_GET['id_modelo']==0){
                                $nombre_modelo_default="Escoge una opción";
                                $sql_mod="select * from modelos where id_marca='$id_marca_default'";
                                echo $sql_mod;
                                $res_mod=busqueda($sql_mod, $link);
                              }
                              if(!$_GET['id_modelo']) $nombre_modelo_default="Escoge una opción";
                              ?>
                            <option value="<?=$id_modelo_default?>" selected><?=$nombre_modelo_default?></option>
                                <?php
                                while($row_mod=recibir_array($res_mod)){
                                ?>
                                <option value="<?=$row_mod['id_modelo']?>"><?=utf8_encode($row_mod['nombre'])?></option>
                                <?php
                            }
                            ?>
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
                            <?php
                            //TODO
                            if($_GET['id_modelo']!=0){
                                $sql="select * from reparacion where id_modelo='$id_modelo_default' or id_marca='$id_marca_default'";
	                            $res=busqueda($sql,$link);
                                while($row=recibir_array($res)){
                                    $id=$row['id_reparacion'];
                                    $data=utf8_encode($row['nombre']);
                                    $precio=$row['precio'];
                                    $idestado=$row['estado'];
                                    if($idestado==1) $estado='Activado';
                                    if($idestado==0) $estado='Desactivado';
                                    echo '<tr><td>'.$id.'</td><td>'.$data.'</td><td>'.$fecha_ini.'</td><td>'.$precio.'</td><td>'.$estado.'</td>';
                                    if($estado=="Activado"){
                                        $text_color="text-success";
                                        $action='<a href="#" class="deactivate text-danger" data-toggle="modal" data-target="#deactivate" rel="tooltip" data-original-title="Desactivar" data-user-id="'.$id.'" data-user-name="'.$data.'"><i class="ico glyphicon glyphicon-ban-circle"></i></a>';
                                    }
                                    else if($estado=="Desactivado"){
                                        $text_color="text-danger";
                                        $action='<a href="#" class="activate text-success" data-toggle="modal" data-target="#activate" rel="tooltip" data-original-title="Activar"  data-user-id="'.$id.'" data-user-name="'.$data.'"><i class="ico glyphicon glyphicon-ok"></i></a>';
                                    }
                                    echo '<td>
                                        <a href="reparacion_edit.php?id='.$id.'" rel="tooltip" data-original-title="Editar" class="mrs"><i class="ico glyphicon glyphicon-edit"></i></a>
                                        <a href="#" class="deleteuser mrs" data-toggle="modal" data-target="#myModal" rel="tooltip" data-original-title="Eliminar" data-user-id="'.$id.'" data-user-name="'.$data.'"><i class="ico glyphicon glyphicon-trash"></i></a>
                                        '.$action.'</td></tr>';
                                }
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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Eliminar producto</h4>
            </div>
            <div class="modal-body">
                ¿Seguro que quieres eliminar el producto: <strong class="username"></strong>, con la id: <strong class="userid"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
                <button type="button" class="btn btn-danger delete-user"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="activate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Activar producto</h4>
            </div>
            <div class="modal-body">
                ¿Deaseas activar el producto: <strong class="username"></strong>, con la id: <strong class="userid"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
                <button type="button" class="btn btn-success activate-user"><i class="glyphicon glyphicon-ok"></i> Activar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deactivate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Desactivar producto</h4>
            </div>
            <div class="modal-body">
                ¿Deaseas desactivar el producto: <strong class="username"></strong>, con la id: <strong class="userid"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
                <button type="button" class="btn btn-danger deactivate-user"><i class="glyphicon glyphicon-ban-circle"></i> Desactivar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="destacar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="destacarLabel">Destacar producto</h4>
            </div>
            <div class="modal-body">
                ¿Deaseas destacar el producto: <strong class="username"></strong>, con la id: <strong class="userid"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
                <button type="button" class="btn btn-success des-prod"><i class="glyphicon glyphicon-ok"></i> Activar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="nodestacar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="nodestacarLabel">No destacar producto</h4>
            </div>
            <div class="modal-body">
                ¿Deaseas dejar de destacar el producto: <strong class="username"></strong>, con la id: <strong class="userid"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
                <button type="button" class="btn btn-danger nodes-prod"><i class="glyphicon glyphicon-ban-circle"></i> Desactivar</button>
            </div>
        </div>
    </div>
</div>
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