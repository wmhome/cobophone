<?php
include("libs/php/funcions.php");
session_start();
ob_start();

if (!$_SESSION['usuarioa'] || $_SESSION['usuarioa']=="Invitado"){
	header("Location:index.php");
}

$link=conecta();
$ids=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WMLiB</title>


    <link rel="stylesheet" href="css/components/mfileupload/jquery.fileupload.css">
    <!-- Jasny Bootstrap for uploadfiles -->
    <link href="css/components/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="ckeditor/contents.css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- WM CSS Lib -->
    <link href="css/wmhcsslib.css" rel="stylesheet">
</head>
<body>
<header>
    <?php include("layout/header.php");?>
</header>
<div class="page-wrap" id="page-content-wrapper">
    <div class="container">
        <div class="page-header">
            <h1>Reparaciones <small>modificar</small></h1>
        </div>
        <?php
		$sql0="select * from reparacion where id_reparacion='$ids'";
		$res0=busqueda($sql0,$link);
		$row0=recibir_array($res0);
		$id_marca=$row0['id_marca'];
		$id_modelo=$row0['id_modelo'];
		$sql_ma="select nombre from marcas where id_marca='$id_marca'";
		$res_ma=busqueda($sql_ma, $link);
		$row_ma=recibir_array($res_ma);
		$nombre_marca=utf8_encode($row_ma['nombre']);
		$sql_mo="select nombre from modelos where id_modelo='$id_modelo'";
		$res_mo=busqueda($sql_mo, $link);
		$row_mo=recibir_array($res_mo);
		$nombre_modelo=utf8_encode($row_mo['nombre']);
		?>
        <form class="form-horizontal" method="post" name="servicios" enctype="multipart/form-data" action="reparaciones_mod.php">
            <div class="form-group">
                <label for="id" class="col-sm-2 control-label">ID#</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" readonly="readonly" name="id" id="id" placeholder="Identificador producto" value="<?=$ids?>">
                </div>
            </div>
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre producto" value="<?php echo utf8_encode($row0['nombre']);?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Marca</label>
                <div class="col-sm-10">
                    <select class="form-control marca" name="marca" id="marca">
                        <option value="<?=$id_marca?>" selected><?=$nombre_marca?></option>
                        <?php
                        $sql_ma="select * from marcas where id_marca!='$id_marca' order by id_marca asc";
                        $res_ma=busqueda($sql_ma, $link);
                        while($row_ma=recibir_array($res_ma)){
                            $id_marca2=$row_ma['id_marca'];
                            $nombre_marca=utf8_encode($row_ma['nombre']);
                            ?>
                            <option value="<?=$id_marca2?>"><?=$nombre_marca?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <?php
            if($id_modelo == 0){
                $nombre_modelo="Escoge una opción";
                $class="hidden";
                ?>
                <div class="form-group r_marca">
                    <label class="col-sm-2 control-label">Reparación general marca</label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="r_marca" id="r_marca" checked>
                    </div>
                </div>
            <?php
            }
            else $class="";
            ?>
            <div class="form-group r_modelo <?=$class?>">
                <label class="control-label col-sm-2">Escoge un modelo</label>
                <div class="col-sm-10">
                    <select class="form-control modelo" name="modelo" id="modelo">
                        <option value="<?=$id_modelo?>" selected><?=$nombre_modelo?></option>
                        <?php
                        $sql_mod="select * from modelos where id_modelo!='$id_modelo' and id_marca='$id_marca'";
                        $res_mod=busqueda($sql_mod, $link);
                        while($row_mod=recibir_array($res_mod)){
                        ?>
                        <option value="<?=$row_mod['id_modelo']?>"><?=utf8_encode($row_mod['nombre'])?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="fecham" class="col-sm-2 control-label">Fecha modificación</label>
                <div class="col-sm-10">
                    <input type="text" readonly="readonly" class="form-control" name="fecham" id="fecham" placeholder="Fecha" value="<?php echo date('d/m/Y H:s');?>">
                </div>
            </div>
            <div class="form-group">
                <label for="precio" class="col-sm-2 control-label">Precio</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio producto" value="<?php echo $row0['precio'];?>">
                    <p class="text-muted">Precio 0€ indicará que se tiene que consultar con tienda.</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Estado</label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" name="estado" id="estado_on" value="1" <?php if($row0['estado']=="1"){?> checked <?php }?>> Activado
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="estado" id="estado_off" value="0" <?php if($row0['estado']=="0"){?> checked <?php }?>> Desactivado
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-md-offset-2">
                    <button type="submit" name="editaproducto" id="editaproducto" class="btn btn-info"><span class="fa fa-pencil-square-o"></span> Modificar</button>
                    <a href="tarifas.php?id_marca=<?=$id_marca?>&id_modelo=<?=$id_modelo?>" class="btn btn-default"><span class="fa fa-step-backward"></span> Volver al listado de reparaciones</a>
                </div>
            </div>
        </form>
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
<!-- Images holder -->
<script src="libs/js/components/holder/holder.js"></script>

<script>
    $(document).ready(function(){
        $(".marca").change(function(){
            var id=$(this).val();
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
        $(".r_marca").change(function(){
            var id=$('.marca').val();
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
        $(".r_marca").change(function (){
            alert("La reparación cambiara de tipo.");
            $(".r_modelo").toggle('slow');
        });
    });
</script>
</body>
</html>