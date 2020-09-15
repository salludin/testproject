<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  logistics Worldwide Software                               *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: osorio2380@yahoo.es                                            *
// * Website: http://www.jaom.info                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// * If you Purchased from Codecanyon, Please read the full License from   *
// * here- http://codecanyon.net/licenses/standard                         *
// *                                                                       *
// *************************************************************************
 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
require_once('database-settings.php');
require_once('database.php');
require_once('library.php');

$sql = "SELECT *
		FROM offices";
$result = dbQuery($sql);		
isUser();
?>
<!DOCTYPE html>
<html>
 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Page Description and Author -->
	<meta name="description" content="Courier Deprixa V2.5 "/>
	<meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
	<meta name="author" content="Jaomweb">

	<!-- App Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- App title -->
	<title>DEPRIXA | OFFICE MANAGER </title>
	
	<!-- Switchery css -->
    <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

    <!-- App CSS -->
	<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
	
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
	<link rel="stylesheet" href="css/font.css" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet">
	<link href="js/css/dataTables.bootstrap.css" rel="stylesheet">
	<link href="js/plugins/sweetalert/css/sweetalert.css" rel="stylesheet">
	<link rel="stylesheet" href="css/footer-basic-centered.css">
 
</head>
<body>
<?php include("header.php"); ?>

<!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
				<?php
				include("icon_settings.php");
				?> 
  
		        <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
							<table border="0" align="center" width="100%">

							<tr>
								  <td class="TrackTitle" valign="top"><div  align=""><h3 class="classic-title1"><span><strong></strong></span></h3>
								</tr>
							<div class="row">
									<div class="col-xs-12" align="center">
									<h2>Add New Office Manager</h2>
									<br>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12">
									<!--Botones principales-->
									<button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#nuevo"><i class="fa fa-user-plus"></i>
									 New Office</button>
									 <button type="button" class="btn btn-md btn-info" id="recarga"><i class="fa fa-refresh"></i>
									 To Update</button>
									</div>
								<div class="col-xs-12">
								<div class="table">
								<br>
								<!--Inicio de tabla usuarios-->
								<table id="tabla-usuarios" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<!--encabezado tabla-->
								<thead>
											<tr>
												<th>Office Name</th>
												<th>Address</th>
												<th>City</th>
												<th>Phone Number</th>
												<th>Office Timing</th>
												<th>Status</th>
												<th>Actions</th>
											</tr>
										</thead>

								</table>
								<!--fin de tabla-->

								</div>
								</div>
								</div>


								<!-- Modal nuevo usuario -->
								<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-plus"></i> New Office</h4>
									  </div>
									  <div class="modal-body">
									  <!--Cuerpo del modal aquí el formulario-->
												   <form class="form-horizontal" id="formularioNuevo">
								  <div class="form-group " id="gnombre">
									<label for="off_name" class="col-sm-2 control-label">Office Name </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control off_name" name="off_name"  placeholder="Office Name">
									</div>
								  </div>
								  <div class="form-group" id="gapellido">
									<label for="address" class="col-sm-2 control-label">Address </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control address" name="address"   placeholder="Address ">
									</div>
								  </div>
								  <div class="form-group" id="gtelefono">
									<label for="city" class="col-sm-2 control-label">City</label>
									<div class="col-sm-10">
									  <input class="form-control city" name="city" placeholder="City">						
									  
									</div>
								  </div>
								  <div class="form-group" id="gemail">
									<label for="ph_no" class="col-sm-2 control-label">Phone No.</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control ph_no" name="ph_no"  placeholder="Phone ">
									</div>
								  </div>
								  <div class="form-group" id="gusuario">
									<label for="office_time" class="col-sm-2 control-label">Office Timing</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control office_time" name="office_time"  placeholder="Office Timing">
									</div>
								  </div>
								  <div class="form-group" id="gpassword">
									<label for="contact_person" class="col-sm-2 control-label">Contact Person</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control contact_person" name="contact_person"  placeholder="Contact Person">
									</div>
								  </div>
								  <div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<div class="checkbox checkbox-success">
											<input id="checkbox3" type="checkbox" name="estado" value="1" checked>
											<label for="checkbox3">
												Success
											</label>
										</div>
									</div>
								  </div>
								  
								</form>
								<!--Fin del cuerpo del modal-->
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>
								 Close</button>
										<button type="button" id="guardarNuevo" class="btn btn-primary"><i class="fa fa-floppy-o"></i>
								 Save</button>
									  </div>
									</div>
								  </div>
								</div>
								<!--fin de modal nuevo usuario-->


								<!-- Modal para editar Usuario -->
								<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i>
								 Edit Office</h4>
									  </div>
									  <div class="modal-body">
								<!--Cuerpo del modal aquí el formulario-->
									<form class="form-horizontal" id="formularioEditar">
								  <div class="form-group" id="Enombre">
									<label for="off_name" class="col-sm-2 control-label">Office Name </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="off_name" placeholder="Office Name">
									</div>
								  </div>
								  <div class="form-group" id="Eapellido">
									<label for="address" class="col-sm-2 control-label">Address </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="address" placeholder="Address ">
									</div>
								  </div>
								  <div class="form-group" id="Etelefono">
									<label for="city" class="col-sm-2 control-label">City</label>
									<div class="col-sm-10">
									  <input class="form-control" name="city" placeholder="City ">							
									</div>
								  </div>
								  <div class="form-group" id="Eemail">
									<label for="ph_no" class="col-sm-2 control-label">Phone No.</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="ph_no"  placeholder="Phone ">
									</div>
								  </div>
								  <div class="form-group" id="Eusuario">
									<label for="office_time" class="col-sm-2 control-label">Office Timing</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="office_time" placeholder="Office Timing">
									</div>
								  </div>
								  <div class="form-group">
									<label for="contact_person" class="col-sm-2 control-label">Contact Person</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="contact_person" placeholder="Contact Person">
									</div>
								  </div>
								 <div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<div class="checkbox checkbox-success">
											<input id="checkbox3" type="checkbox" name="estado" value="1" >
											<label for="checkbox3">
												Success
											</label>
										</div>
									</div>
								  </div>
								  <!--campo oculto-->
								  <input type="hidden" name="id" id="id_user">
								</form>   
								<!--Fin del cuerpo del modal-->  
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="button" id="actualizar" class="btn btn-primary">Save</button>
									  </div>
									</div>
								  </div>
								</div>
								<!--fin de modal nuevo usuario-->
                        </div>
                    </div>
                </div>
                <!-- end row -->
    
		<!-- Footer -->
		<?php
			include("footer.php");
		?>
		<!-- End Footer -->

         </div> <!-- container -->
        </div> <!-- End wrapper -->
 
		<script type='text/javascript' src="js/jquery.js"></script>
		<script type='text/javascript' src="js/bootstrap.min.js"></script> 
		<script type='text/javascript' src="plugins/DataTables/js/jquery.dataTables.js"></script>
		<script type='text/javascript' src="plugins/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
		<script type='text/javascript' src="js/dataTables.bootstrap.js"></script> 
		<script type='text/javascript' src="plugins/bootstrap-notify/bootstrap-notify.min.js"></script> 
		<script type='text/javascript' src="plugins/sweetalert/js/sweetalert.min.js"></script>  

		<script type='text/javascript' src="js/crud.js"></script>
		
		<!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

</body></html>