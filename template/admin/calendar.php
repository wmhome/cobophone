<?php
include("libs/php/funcions.php");
session_start();
ob_start();

if (!$_SESSION['usuarioa'] || $_SESSION['usuarioa']=="Invitado"){
	header("Location:index.php");
}

$link=conecta();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WMLiB</title>

    <!-- WM CSS Lib -->
    <link href="css/wmhcsslib.css" rel="stylesheet">
	<!-- Slide Menus CSS -->
	<link href="css/components/slidemenu/style.css">
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
						<div class="row">
							<div class="col-sm-6">
								<h3></h3>
								<small>To see example with events navigate to march 2013</small>
							</div>
							<div class="col-sm-6">
								<div class="form-inline mtl pull-right">
									<div class="btn-group">
										<button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
										<button class="btn btn-default" data-calendar-nav="today">Today</button>
										<button class="btn btn-primary" data-calendar-nav="next">Next >></button>
									</div>
									<div class="btn-group">
										<button class="btn btn-warning" data-calendar-view="year">Year</button>
										<button class="btn btn-warning active" data-calendar-view="month">Month</button>
										<button class="btn btn-warning" data-calendar-view="week">Week</button>
										<button class="btn btn-warning" data-calendar-view="day">Day</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="calendar"></div>
				</div>
			</div>
		</div>
  	</div>
  	<div class="modal fade in" id="events-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title">Event</h3>
				</div>
				<div class="modal-body" style="height: 400px">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Side nav for responsive views -->
	<div class="sb-slidebar sb-right sb-style-overlay sb-width-wide plm prm pbm mt52">
		<?php include("layout/side-navs.html");?>
	</div>
	<!-- Side nav -->
	<footer class="site-footer">
		<div class="container">
			<p class="text-muted text-center mtl">&copy; WhiteMind - <a href="http://www.whitemind.es" target="_blank">www.whitemind.es</a> - <a href="http://www.wmhome.es" target="_blank">www.wmhome.es</a></p>
		</div>
	</footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="libs/js/bootstrap.min.js"></script>
    <script src="libs/js/components/calendar/calendar.js"></script>
	<script src="libs/js/components/calendar/language/es-ES.js"></script>
	<script src="libs/js/components/calendar/underscore/underscore-min.js"></script>
	<script src="libs/js/components/calendar/app.js"></script>
	<script src="libs/js/components/slidemenu/menu.js"></script>
	<script src="libs/js/components/slidemenu/side-navs.js"></script>
  </body>
</html>