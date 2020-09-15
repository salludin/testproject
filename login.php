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
require_once('deprixa/database-settings.php');
require_once('deprixa/library.php');


?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8" />	    
    <title>Log In | DEPRIXA</title>
	<meta name="description" content="Courier Deprixa V2.5 "/>
	<meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
	<meta name="author" content="Jaomweb">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--html5 ie include-->
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
    
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="/Styles/ie-fixes.css" />
    <![endif]-->
    <!-- style -->
    <link href="deprixa_components/content/cssefe4.css" rel="stylesheet"/>   
    <link href="deprixa_components/styles/login.css" rel="stylesheet" />
 
</head>

   <!-- Menu -->
<?php include_once "menu.php"; ?>
    <!-- /Menu -->
	
 <div class="slide">   
</div>
<main class="slide">    
<section class="login">
    <div class="col-xs-12 cf fl col-sm-6 col-md-6 login-col">
        <h2>Log in</h2>
		<div class="col-md-12 well">
			<form name="form1" autocomplete="off" method="post" />    
			
			<div class="form-horizontal">
				<div class="panel-heading">                                		

					<?php 
							if(isset($_POST['user'])){
								$error = verify_users($_POST['user'],$_POST['password']);									
							}else{
								
								echo '<div class="form-group">
										<label class="control-label col-md-3 col-md-offset-1" for="Email">Email</label>
										<div class="col-md-8">
											<input class="form-control text-box single-line" data-val="true" data-val-required="Please enter an email" name="user"id="user" type="text" value="" />
											<span class="field-validation-valid text-danger" data-valmsg-for="Email" data-valmsg-replace="true"></span>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-md-offset-1" for="Password">Password</label>
										<div class="col-md-8">
											<input class="form-control text-box single-line password" data-val="true" data-val-required="Please enter a password" name="password" id="password" type="password" value="" />
											<span class="field-validation-valid text-danger" data-valmsg-for="Password" data-valmsg-replace="true"></span>
										</div>
									</div>
									<div class="form-group">
									<div class="col-md-10 col-md-offset-1 form-inline">
										<input type="submit" value="Log in" class="btn btn-primary pull-right" />
									</div>
									</div>';
							}	
					?>
					
				</div>    
			</div>
		</div>
	</div>
    <div class="col-xs-12 fl col-sm-6 col-md-6 signup-col">
        <h2>Sign up</h2>
        <div class="col-md-12 well cf">
            <div class="col-md-12">
                <p>Sign up with us and enjoy some great benefits.</p>
                <ul class="signup-benefits">
                    <li>Plenty of choice with dozens of services.</li>
                    <li>Delivery updates and offers, especially for you.</li>
                    <li>Extra benefits + including cashback for future bookings.</li>
                </ul>
                <a href='signup.php' class="btn btn-primary pull-right" role="button">
                    Sign up
                </a>
            </div>
        </div>
    </div>
</section>


</main>
<?php include_once "footer.php"; ?> 


    <script src="deprixa_components/bundles/jquery"></script>
    <script src="deprixa_components/bundles/bootstrap"></script>
    <script src="deprixa_components/bundles/modernizr"></script>
    <script src="deprixa_components/scripts/CookieManager.js"></script>
    <script src="deprixa_components/scripts/MPD/Common/ga-events.js"></script>   
    <script src="deprixa_components/bundles/jqueryval"></script>
    <script src="deprixa_components/scripts/trimFields.js"></script>

</body>
</html>