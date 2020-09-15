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
 
?>         
				<div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <button type="button" class="btn btn-custom dropdown-toggle waves-effect waves-light"
                                    data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i
                                    class="fa fa-cog"></i></span></button>
							<?php
								if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') {
							?>		
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="service_mode.php"><i class="fa fa-gift"></i>&nbsp;Product Types</a>
                                <a class="dropdown-item" href="type-of-shipments.php"><i class="fa fa-truck"></i>&nbsp;Type of Shipments</a>
                                <a class="dropdown-item" href="add-office.php"><i class="fa fa-map-marker"></i>&nbsp;Location</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="preferences.php"><i class="fa fa-briefcase"></i>&nbsp;Company</a>
                            </div>
								<?php } ?>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>