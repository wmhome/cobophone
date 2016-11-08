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
                    <h1>Tarifas <small>añadir nueva reparación</small></h1>
                </div>
                <div class="col-sm-12">
                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="tarifas_add.php">
                        <div class="form-group">
                            <label for="fechai" class="col-sm-2 control-label">Fecha creación</label>
                            <div class="col-sm-10">
                                <input type="text" readonly="readonly" class="form-control" name="fechai" id="fechai" placeholder="Fecha" value="<?php echo date('d/m/Y H:s');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Escoge una marca</label>
                            <div class="col-sm-10">
                                <select class="form-control marca" name="marca" id="marca">
                                    <option value="0">Escoge una opción</option>
                                    <?php
                                    $sql_m="select * from marcas order by id_marca asc";
                                    $res_m=busqueda($sql_m, $link);
                                    while($row_m=recibir_array($res_m)){
                                        $id_marca=$row_m['id_marca'];
                                        $nombre_marca=utf8_encode($row_m['nombre']);
                                    ?>
                                            <option value="<?=$id_marca?>"><?=$nombre_marca?></option>
                                            <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group r_marca">
                            <label class="col-sm-2 control-label">Reparación general marca</label>
                            <div class="col-sm-10">
                                <input type="checkbox" name="r_marca" id="r_marca">
                            </div>
                        </div>
                        <div class="form-group r_modelo">
                            <label class="col-sm-2 control-label">Escoge un modelo</label>
                            <div class="col-sm-10">
                                <select class="form-control modelo" name="modelo" id="modelo">
                                    <option value="0">Escoge una opción</option>
                                </select>
                            </div>
                        </div>
                        <!-- -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre de la raparación</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe el nombre de la reparación">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Precio</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="precio" id="precio" placeholder="Precio de la reparación">
                                <p class="text-muted">Precio 0€ indicará que se tiene que consultar con tienda.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 text-right">
                                <button class="btn btn-primary" type="submit" name="enviar" id="enviar">Enviar</button>
                                <a href="tarifas.php" class="btn btn-default" type="submit" name="enviar" id="enviar">Volver al listado de tarifas</a>
                            </div>
                        </div>
                    </form>
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
    $(document).ready(function() {
        //Sergi
        $(".marca").change(function () {
            var id = $(this).val();
            var code = $(".marca").val();
            var dataString = 'id=' + id;
            $.ajax({
                type: "POST",
                url: "mods-ajax.php",
                data: dataString,
                cache: false,
                success: function (html) {
                    $(".modelo").html(html);
                }
            });
        });
        $(".r_marca").change(function (){
            alert("La reparación pasara a ser general de la marca.");
            $(".r_modelo").toggle('slow');
        });
    });
</script>
</body>
</html>