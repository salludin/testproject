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
 
session_start();
require_once('database.php');
	
$action = $_GET['action'];

switch($action) {
	case 'add-cons':
		addCons();
	break;
	
	case 'approve-courier':
	
	approveCourier();
	
	break;
	
	 case 'update-booking':	
	updateBooking();	
	break;
	
	case 'add-customer':
		addCustomer();
	break;
	
	case 'add-client':
		addclient();
	break;
	
	case 'shipping-charges':
		shippingcharges();
	break;
	
	case 'update-admin':
		updateadmin();
	break;
	
	case 'update-courier':
		updatecourier();
	break;
	
	case 'update-addcourier':
		addcourier_update();
	break;

	case 'change-profile':
		changeProfile();
	break;

	case 'change-pass':
		changePass();
	break;
	
	case 'company':
		changeCompany();
	break;
	
	case 'change-logo':
		changelogo();
	break;
	
	case 'send-msg':
		sendMsg();
	break;

	case 'edit-user':
		edituser();
	break;
	
	case 'update-client':
		updateclient();
	break;

	case 'delivered':
		markDelivered();
	break;
	
	case 'deliveredcredit':
		markDeliveredcredit();
	break;	
	
	case 'deliveredondelivery':
		Deliveredondelivery();
	break;
	
	case 'add-office':
		addNewOffice();
	break;
	
	case 'add-customer':
		addNewCustomer();
	break;
	
	case 'add-manager':
		addManager();
	break;
	
	case 'add-managers':
		addManagers();
	break;
	
	case 'update-status':
		updateStatus();
	break;
	
	case 'update-paid':
		updatePaid();
	break;
	
	case 'change-pass':
		changePass();
	break;
			
	case 'logOut':
		logOut();
	break;		
	
}//switch

function addCons(){

	$Shippername = $_POST['Shippername'];
	$Shipperphone = $_POST['Shipperphone'];
	$Shipperaddress = $_POST['Shipperaddress'];
	$Shippercc = $_POST['Shippercc'];
	
	$Receivername = $_POST['Receivername'];
	$Receiverphone = $_POST['Receiverphone'];
	$Receiveraddress = $_POST['Receiveraddress'];
	$Receivercc_r = $_POST['Receivercc_r'];
	$Receiveremail = $_POST['Receiveremail'];
	
	$ConsignmentNo = $_POST['ConsignmentNo'];
	$Shiptype = $_POST['Shiptype'];
	$Weight = $_POST['Weight'];
	$variable = $_POST['variable'];
	$shipping_subtotal = $_POST['shipping_subtotal'];
	$Invoiceno = $_POST['Invoiceno'];
	$Qnty = $_POST['Qnty'];

	$Bookingmode = $_POST['Bookingmode'];
	$Totalfreight = $_POST['Totalfreight'];
	$Totaldeclarate = $_POST['Totaldeclarate'];
	$Mode = $_POST['Mode'];
	
	$Packupdate = $_POST['Packupdate'];
	$Schedule = $_POST['Schedule'];
	$Pickuptime = $_POST['Pickuptime'];
	$status = $_POST['status'];
	$Comments = $_POST['Comments'];
	$officename = $_POST['officename'];
	$user = $_POST['user'];	

	$sql = "INSERT INTO courier (cons_no, ship_name, phone, s_add, cc, rev_name, r_phone, r_add, cc_r, email, type, weight, variable, shipping_subtotal, invice_no, qty, book_mode, freight, declarate, mode, pick_date, schedule, pick_time, status, comments, officename, user, book_date)
			VALUES('$ConsignmentNo', '$Shippername','$Shipperphone', '$Shipperaddress', '$Shippercc', '$Receivername','$Receiverphone','$Receiveraddress', '$Receivercc_r', '$Receiveremail', '$Shiptype',$Weight , '$variable', '$shipping_subtotal', '$Invoiceno', $Qnty, '$Bookingmode', '$Totalfreight',  '$Totaldeclarate', '$Mode', '$Packupdate', '$Schedule', '$Pickuptime', '$status', '$Comments', '$officename', '$user', curdate())";	
		//echo $sql;
	dbQuery($sql);
					
					
	$result1 =  mysql_query("SELECT * FROM company");
	while($row = mysql_fetch_array($result1)) {
	
	$to  = $row["bemail"];
	$address  = $row["caddress"];
	$namecompany  = $row["cname"];

    // subject

    $subject = 'SHIPPING SENT YOUR DESTINATION | '.$row["cname"].'';
	$from = $row["bemail"];
    // message
	$text_message    = "Hi ".$Receivername." this is our address, <br /><br /> <strong> ".$address." Please consider your environmental responsibility. Before printing this e-mail message, ask yourself whether you really need a hard copy.</strong><br /><br /> IMPORTANT:</strong> The contents of this email and any attachments are confidential. They are intended for the named recipient(s) only. If you have received this email by mistake, please notify the sender immediately and do not disclose the contents to anyone or make copies thereof.";			   	
	
	// HTML email starts here
	
	$message  = "<html><body>";	
	$message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";	
	$message .= "<tr><td>";	
	$message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:800px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";		
	$message .= "<thead>
				<tr height='80'>
					<th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >".$namecompany."</th>
				</tr>
				</thead>";
		
	$message .= "<tbody>
				
				<tr>
					<td colspan='4' style='padding:15px;'>
						<p><img src='".$row['website']."deprixa/image_logo.php?id=1'></p>
						<br><br>
						<p style='font-size:16px;'><strong>".$Receivername."</strong>, the Lord <strong>".$Shippername."</strong>, has sent you a package to your address with the following details: </p>
						<hr />
						<p style='font-size:14px;'>Email: <strong> ".$Receiveremail."</strong></p>					
						<p style='font-size:14px;'>Tracking: <strong> ".$ConsignmentNo."</strong></p>
						<p style='font-size:14px;'>Destination: <strong> ".$Pickuptime."</strong></p>
						<p style='font-size:14px;'>Details: <strong> ".$Shiptype."</strong></p>
						<br><br>
						<p style='font-size:14px;'>Tracking Details URL:<a style='background:#eee;color:#333;padding:10px;' href='".$row["website"]."tracking.php' >See shipping</a></p>
						<br>
						<p><a style='background:#eee;color:#333;padding:10px;' href='".$row["website"]."login.php' >Customer Login</a></p>
						<br><br>
						<p style='font-size:13px; font-family:Verdana, Geneva, sans-serif;'>".$text_message.".</p>
					</td>
				</tr>												
				</tbody>";				
	$message .= "</table>";	
	$message .= "</td></tr>";
	$message .= "</table>";	
	$message .= "</body></html>";

	}
    // To send HTML mail, the Content-type header must be set

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   // Additional headers
    $headers .= 'From: '.$from."\r\n";	
    // this line checks that we have a valid email address
	mail($to, $subject, $message, $headers); //This method sends the mail.
	mail($Receiveremail, $subject, $message, $headers); //This method sends the mail.
   
   echo "<script type=\"text/javascript\">
			alert(\"'$_POST[rev_name]' shipping satisfactory to the client, will be notified by mail.\");
			window.location = \"add-courier.php\"
		</script>";																			
	
	//echo $Ship;
}//addCons

function addcourier_update(){
	$cid = (int)$_POST['cid'];
	$Shippername = $_POST['Shippername'];
	$Shipperphone = $_POST['Shipperphone'];
	$Shipperaddress = $_POST['Shipperaddress'];
	$Shippercc = $_POST['Shippercc'];
	
	$Receivername = $_POST['Receivername'];
	$Receiverphone = $_POST['Receiverphone'];
	$Receiveraddress = $_POST['Receiveraddress'];
	$Receivercc_r = $_POST['Receivercc_r'];
	$Receiveremail = $_POST['Receiveremail'];
	
	$ConsignmentNo = $_POST['ConsignmentNo'];
	$Shiptype = $_POST['Shiptype'];
	$Weight = $_POST['Weight'];
	$variable = $_POST['variable'];
	$shipping_subtotal = $_POST['shipping_subtotal'];
	$Invoiceno = $_POST['Invoiceno'];
	$Qnty = $_POST['Qnty'];

	$Bookingmode = $_POST['Bookingmode'];
	$Totalfreight = $_POST['Totalfreight'];
	$Totaldeclarate = $_POST['Totaldeclarate'];
	$Mode = $_POST['Mode'];
	
	$Packupdate = $_POST['Packupdate'];
	$Schedule = $_POST['Schedule'];
	$Pickuptime = $_POST['Pickuptime'];
	$status = $_POST['status'];
	$Comments = $_POST['Comments'];
	$officename = $_POST['officename'];
	$user = $_POST['user'];	

	$sql = "UPDATE courier
                       SET cons_no='$ConsignmentNo', ship_name='$Shippername',phone='$Shipperphone',s_add='$Shipperaddress', cc='$Shippercc', rev_name='$Receivername',r_phone='$Receiverphone',r_add='$Receiveraddress', cc_r='$Receivercc_r', email='$Receiveremail', type='$Shiptype', weight='$Weight', variable='$variable', invice_no='$Invoiceno',declarate='$Totaldeclarate', mode ='$Mode', pick_date='$Packupdate' , schedule='$Schedule',pick_time='$Pickuptime',book_mode='$Bookingmode',freight='$Totalfreight',
					   qty='$Qnty', shipping_subtotal='$shipping_subtotal', status='$status', comments='$Comments', officename='$officename', user='$user'  
                       WHERE cid = '$cid'";	
		//echo $sql;
	dbQuery($sql);		

	echo "<script type=\"text/javascript\">
						alert(\"Updates applied successfuly.\");
						window.location = \"admin.php\"
					</script>";

	//echo $Ship;
}//addcourier_update


function shippingcharges(){

    $name_courier = $_POST['name_courier'];
	$services = $_POST['services'];
	$rate = $_POST['rate'];
	$Length = $_POST['Length'];
	$Width = $_POST['Width'];
	$Height	 = $_POST['Height'];
	$Weight = $_POST['Weight'];
	$WeightType = $_POST['WeightType'];

	
	$sql = "INSERT INTO scheduledpickup (name_courier, services, rate, Length, Width, Height, Weight, WeightType)
			VALUES ('$name_courier', '$services', '$rate', '$Length', '$Width', '$Height', '$Weight', '$WeightType')";
	dbQuery($sql);
	echo "<script type=\"text/javascript\">
						alert(\"$name_courier has been added to the Scheduled Pickup.\");
						window.location = \"shipping-charge.php\"
					</script>";	
 
}

function approveCourier(){

   	$cid = (int)$_POST['cid'];
    $sname = $_POST['sname'];
	$sphone = $_POST['sphone'];
	$sadd = $_POST['sadd'];
	$rname = $_POST['rname'];
	$rphone = $_POST['rphone'];
	$radd = $_POST['radd'];
    $weight = $_POST['weight'];
	$freight = $_POST['freight'];
	$Qnty = $_POST['Qnty'];
	$variable = $_POST['variable'];
	$shipping_subtotal = $_POST['shipping_subtotal'];
	$service = $_POST['service'];
	$no = $_POST['no'];
	$office = $_POST['office'];
	$type = $_POST['type'];
	$note = $_POST['note'];
	$status = $_POST['status'];
	$payment = $_POST['payment'];
    $fcity = $_POST['fcity'];
	$tcity = $_POST['tcity'];
    $date = $_POST['bdate'];
    $ddate = $_POST['ddate'];
	$user = $_POST['user'];
	
	$sql = "INSERT INTO courier_online (cons_no, ship_name,s_add,s_phone,r_phone,r_add,type,note,time,status,payment,book_mode,rev_name,weight,date,fromcity, tocity , deliverydate,freight, Qnty, variable, 	shipping_subtotal, office, user)
		VALUES('$no', '$sname','$sadd','$sphone','$rphone','$radd','$type','$note', NOW(),'$status','Pending','$service','$rname','$weight','$date','$fcity','$tcity','$ddate','$freight','$Qnty', 
		'$variable', '$shipping_subtotal', '$office', '$user')";
	dbQuery($sql);
	
	$sql_1 = "UPDATE online_booking SET status='Approved' , tracking='$no' WHERE id='$cid'";
    dbQuery($sql_1);	 
	
	$result1 =  mysql_query("SELECT * FROM company");
	while($row = mysql_fetch_array($result1)) {
	
	$to  = $row["bemail"];
	$address  = $row["caddress"];
	$namecompany  = $row["cname"];

    // subject

    $subject = 'SHIPPING APPROVED | '.$row["cname"].'';
	$from = $row["bemail"];
    // message
	$text_message    = "Hi ".$sname." this is our address, <br /><br /> <strong> ".$address." Please consider your environmental responsibility. Before printing this e-mail message, ask yourself whether you really need a hard copy.</strong><br /><br /> IMPORTANT:</strong> The contents of this email and any attachments are confidential. They are intended for the named recipient(s) only. If you have received this email by mistake, please notify the sender immediately and do not disclose the contents to anyone or make copies thereof.";			   	
	
	// HTML email starts here
	
	$message  = "<html><body>";	
	$message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";	
	$message .= "<tr><td>";	
	$message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:800px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";		
	$message .= "<thead>
				<tr height='80'>
					<th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >".$namecompany."</th>
				</tr>
				</thead>";
		
	$message .= "<tbody>
				
				<tr>
					<td colspan='4' style='padding:15px;'>
						<p><img src='".$row['website']."deprixa/image_logo.php?id=1'></p>
						<br><br>
						<p style='font-size:14px;'>Customer Name: <strong>".$sname."</strong></p>
						<hr />
						<p style='font-size:14px;'> Your booking has been approved and ready to ship. Shipping respresentative will be in touch with soon regarding shipping details.</p>
						<p style='font-size:14px;'>You can start tracking your shipment status with this unique Airwaybill no :<strong> ".$no."</strong></p>											
						<br><br>
						<p><a style='background:#eee;color:#333;padding:10px;' href='".$row["website"]."login.php' >Customer Login</a></p>
						<br><br>
						<p style='font-size:13px; font-family:Verdana, Geneva, sans-serif;'>".$text_message.".</p>
					</td>
				</tr>												
				</tbody>";				
	$message .= "</table>";	
	$message .= "</td></tr>";
	$message .= "</table>";	
	$message .= "</body></html>";

	}
    // To send HTML mail, the Content-type header must be set

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   // Additional headers
    $headers .= 'From: '.$from."\r\n";	
    // this line checks that we have a valid email address
	mail($to, $subject, $message, $headers); //This method sends the mail.
	mail($sadd, $subject, $message, $headers); //This method sends the mail.
   
   echo "<script type=\"text/javascript\">
			alert(\"'$_POST[sname]' Shipping approved satisfactorily.\");
			window.location = \"online-bookings.php\"
		</script>";																			


}

function updatecourier() {
	
    $sname = $_POST['sname'];
	$sphone = $_POST['sphone'];
	$sadd = $_POST['sadd'];
	$rname = $_POST['rname'];
	$rphone = $_POST['rphone'];
	$radd = $_POST['radd'];
	$no= $_POST['no'];
    $weight = $_POST['weight'];
	$freight = $_POST['freight'];
	$Qnty = $_POST['Qnty'];
	$variable = $_POST['variable'];
	$shipping_subtotal = $_POST['shipping_subtotal'];
	$mode = $_POST['mode'];
	$type = $_POST['type'];
    $fcity = $_POST['fcity'];
	$tcity = $_POST['tcity'];
	$time = $_POST['btime'];
    $date = $_POST['bdate'];
    $ddate = $_POST['ddate'];
	$status = $_POST['status'];
	$user = $_POST['user'];
	$cid = (int)$_POST['cid'];
	
             $sql_1 = "UPDATE courier_online
                       SET cons_no='$no', ship_name='$sname',s_phone='$sphone',s_add='$sadd', rev_name='$rname',r_phone='$rphone',r_add='$radd',weight='$weight',date='$date',fromcity='$fcity', tocity ='$tcity', deliverydate='$ddate' , time='$time',type='$type',book_mode='$mode',freight='$freight',
					   Qnty='$Qnty', variable='$variable', shipping_subtotal='$shipping_subtotal', status='$status', user='$user'
                       WHERE cid = '$cid'";
					   
	$result1 =  mysql_query("SELECT * FROM company");
	while($row = mysql_fetch_array($result1)) {
	
	$to  = $row["bemail"];
	$address  = $row["caddress"];
	$namecompany  = $row["cname"];

    // subject

    $subject = 'SHIPPING ONLINE BOOKING UPDATE | '.$row["cname"].'';
	$from = $row["bemail"];
    // message
	$text_message    = "Hi ".$sname." this is our address, <br /><br /> <strong> ".$address." Please consider your environmental responsibility. Before printing this e-mail message, ask yourself whether you really need a hard copy.</strong><br /><br /> IMPORTANT:</strong> The contents of this email and any attachments are confidential. They are intended for the named recipient(s) only. If you have received this email by mistake, please notify the sender immediately and do not disclose the contents to anyone or make copies thereof.";			   	
	
	// HTML email starts here
	
	$message  = "<html><body>";	
	$message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";	
	$message .= "<tr><td>";	
	$message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:800px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";		
	$message .= "<thead>
				<tr height='80'>
					<th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >".$namecompany."</th>
				</tr>
				</thead>";
		
	$message .= "<tbody>
				
				<tr>
					<td colspan='4' style='padding:15px;'>
						<p><img src='".$row['website']."deprixa/image_logo.php?id=1'></p>
						<br><br>
						<p style='font-size:14px;'>Customer Name: <strong>".$sname."</strong></p>
						<hr />
						<p style='font-size:14px;'> Your shipment was updated and following your shipping State is: <strong> ".$status."</strong></p>											
						<br><br>
						<p><a style='background:#eee;color:#333;padding:10px;' href='".$row["website"]."login.php' >Customer Login</a></p>
						<br><br>
						<p style='font-size:13px; font-family:Verdana, Geneva, sans-serif;'>".$text_message.".</p>
					</td>
				</tr>												
				</tbody>";				
	$message .= "</table>";	
	$message .= "</td></tr>";
	$message .= "</table>";	
	$message .= "</body></html>";

	}
    // To send HTML mail, the Content-type header must be set

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   // Additional headers
    $headers .= 'From: '.$from."\r\n";	
    // this line checks that we have a valid email address
	mail($to, $subject, $message, $headers); //This method sends the mail.
	mail($sadd, $subject, $message, $headers); //This method sends the mail.				   

	         dbQuery($sql_1);
             echo "<script type=\"text/javascript\">
						alert(\"your shipment was updated and following your shipping State is: <strong> ".$status."</strong>\");
                        window.location = \"admin.php\"
					</script>";
}

function updateBooking(){
  	    
	$name = $_POST['name'];
	$cid = (int)$_POST['cid'];
	$reasons = $_POST['reasons'];
	 
	$sql_1 = "UPDATE online_booking SET status='Cancelled',reasons='$reasons' WHERE id='$cid'";
    dbQuery($sql_1);
	$to  = $_POST['email'];	 
	
	$result1 =  mysql_query("SELECT * FROM company");
	while($row = mysql_fetch_array($result1)) {
	
	$to  = $row["bemail"];
	$address  = $row["caddress"];
	$namecompany  = $row["cname"];

    // subject

    $subject = 'SHIPPING CANCELLED | '.$row["cname"].'';
	$from = $row["bemail"];
    // message
	$text_message    = "Hi ".$name." this is our address, <br /><br /> <strong> ".$address." Please consider your environmental responsibility. Before printing this e-mail message, ask yourself whether you really need a hard copy.</strong><br /><br /> IMPORTANT:</strong> The contents of this email and any attachments are confidential. They are intended for the named recipient(s) only. If you have received this email by mistake, please notify the sender immediately and do not disclose the contents to anyone or make copies thereof.";			   	
	
	// HTML email starts here
	
	$message  = "<html><body>";	
	$message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";	
	$message .= "<tr><td>";	
	$message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:800px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";		
	$message .= "<thead>
				<tr height='80'>
					<th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >".$namecompany."</th>
				</tr>
				</thead>";
		
	$message .= "<tbody>
				
				<tr>
					<td colspan='4' style='padding:15px;'>
						<p><img src='".$row['website']."deprixa/image_logo.php?id=1'></p>
						<br><br>
						<p style='font-size:14px;'>Customer Name: <strong>".$name."</strong></p>
						<hr />						
						<p style='font-size:14px;'>Your booking has been cancelled, due to :<strong> ".$reasons."</strong></p>
						<p style='font-size:14px;'> Kindly call.<strong> ".$reasons."</strong> for further information.</p>
						<br><br>
						<p><a style='background:#eee;color:#333;padding:10px;' href='".$row["website"]."login.php' >Customer Login</a></p>
						<br><br>
						<p style='font-size:13px; font-family:Verdana, Geneva, sans-serif;'>".$text_message.".</p>
					</td>
				</tr>												
				</tbody>";				
	$message .= "</table>";	
	$message .= "</td></tr>";
	$message .= "</table>";	
	$message .= "</body></html>";

	}
    // To send HTML mail, the Content-type header must be set

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   // Additional headers
    $headers .= 'From: '.$from."\r\n";	
    // this line checks that we have a valid email address
	mail($to, $subject, $message, $headers); //This method sends the mail.
	mail($email, $subject, $message, $headers); //This method sends the mail.
   
   echo "<script type=\"text/javascript\">
			alert(\"'$_POST[name]' cancelled-online booking.\");
			window.location = \"online-bookings.php\"
		</script>";				
					

}


function updateclient() {
	
	$pwd = $_POST['pwd'];
    $name = $_POST['user'];
	$email = $_POST['email'];
	$add= $_POST['add'];
	$phone = $_POST['phone'];
	$id = $_POST['cid'];

	$sql_1 = "UPDATE tbl_clients
				SET name='$name',password = '$pwd' , phone='$phone', email='$email',address='$add' WHERE id= '$cid'";
	dbQuery($sql_1);
	echo "<script type=\"text/javascript\">
						alert(\"Changes applied successfuly\");
						window.location = \"client?id=$cid\"
					</script>";
}

function changeProfile() {

	$pwd = $_POST['password'];
    $name = $_POST['name'];
	$email = $_POST['email'];
	$add= $_POST['address'];
	$phone = $_POST['phone'];
	$id = $_POST['id'];
	
	$sql_1 = "UPDATE tbl_clients
				SET name='$name',password = '$pwd' , phone='$phone', email='$email',address='$add' WHERE id= '$id'";
	dbQuery($sql_1);
	echo "<script type=\"text/javascript\">
						alert(\"Changes applied successfuly\");
						window.location = \"panel-customer/profile_customer.php\"
					</script>";
}


function markDelivered() {
	$cid = (int)$_GET['cid'];
	$sql = "UPDATE courier SET status = 'Delivered', status_delivered = 'Delivered' WHERE cid= $cid";
	dbQuery($sql);
	
	echo "<script type=\"text/javascript\">
						alert(\"Shipping has changed the State successfully.\");
						window.location = \"admin.php\"
					</script>"; 
	
			
}//markDelivered();


function Deliveredondelivery() {
	
	$cid = (int)$_POST['cid'];
	$dboy = $_POST['deliveryboy'];
	$rby = $_POST['receivedby'];
	$drs = $_POST['drs'];
	
	$sql = "UPDATE courier_online SET status = 'Delivered', deliveryboy='$dboy', receivedby='$rby', drs='$drs' WHERE cid= $cid";
	dbQuery($sql);

	echo "<script type=\"text/javascript\">
						alert(\"Their shipping is has delivered successfully.\");
						window.location = \"admin.php\"
					</script>"; 
			
}//markDeliveredondelivery();



function addNewOffice() {
	
	$OfficeName = $_POST['OfficeName'];
	$OfficeAddress = $_POST['OfficeAddress'];
	$City = $_POST['City'];
	$PhoneNo = $_POST['PhoneNo'];
	$OfficeTiming = $_POST['OfficeTiming'];
	$ContactPerson = $_POST['ContactPerson'];
	
	$sql = "INSERT INTO offices (off_name, address, city, ph_no, office_time, contact_person)
			VALUES ('$OfficeName', '$OfficeAddress', '$City', '$PhoneNo', '$OfficeTiming', '$ContactPerson')";
	dbQuery($sql);
	header('Location: office-add-success.php');
}//addNewOffice

function addNewCustomer() {
	
	$Shippername = $_POST['Shippername'];
	$Shipperaddress = $_POST['Shipperaddress'];
	$Shipperphone = $_POST['Shipperphone'];
	$Shippercc = $_POST['Shippercc'];
	
	$sql = "INSERT INTO customer (Shippername, Shipperaddress, Shipperphone, Shippercc)
			VALUES ('$Shippername', '$Shipperaddress', '$Shipperphone', '$Shippercc')";
	dbQuery($sql);
	header('Location: customer.php');
}//addNewCustomer

function addManager() {
	
	$ManagerName = $_POST['ManagerName'];
	$Password = $_POST['Password'];
	$Address = $_POST['Address'];
	$Email = $_POST['Email'];
	$PhoneNo = $_POST['PhoneNo'];
	$OfficeName = $_POST['OfficeName'];
	
	$sql = "INSERT INTO courier_officers (officer_name, off_pwd, address, email, ph_no, office, reg_date)
			VALUES ('$ManagerName', '$Password', '$Address', '$Email', '$PhoneNo', '$OfficeName', NOW())";
	dbQuery($sql);
	header('Location: manager-add-success.php');

}//addManager

function addManagers() {
	$customer = $_POST['customer'];
	$ManagerName = $_POST['ManagerName'];
	$Password = $_POST['Password'];
	$Address = $_POST['Address'];
	$Email = $_POST['Email'];
	$PhoneNo = $_POST['PhoneNo'];
	$OfficeName = $_POST['OfficeName'];
	
	$sql = "INSERT INTO courier_customer (id_customer,officer_name, off_pwd, address, email, ph_no, office, reg_date)
			VALUES ('$customer', $ManagerName', '$Password', '$Address', '$Email', '$PhoneNo', '$OfficeName', NOW())";
	dbQuery($sql);
	header('Location: manager-add-success.php');

}//addManagers

function updateStatus() {
	
	$pick_time = $_POST['pick_time'];
	$status = $_POST['status'];
	$comments = $_POST['comments'];
	$cid = (int)$_POST['cid'];
	$cons_no = $_POST['cons_no'];
	//$OfficeName = $_POST['OfficeName'];
	
	$sql = "INSERT INTO courier_track (cid, cons_no, pick_time, status, comments, bk_time)
			VALUES ($cid, '$cons_no', '$pick_time', '$status', '$comments', NOW())";
	dbQuery($sql);
	
	$sql_1 = "UPDATE courier SET status='$status', pick_time='$pick_time' WHERE cid = $cid AND cons_no = '$cons_no'";
	dbQuery($sql_1);

	header("Location: edit-courier.php?cid=$cid");

}//updateStatus

function updatePaid() {
	
	$book_mode = $_POST['book_mode'];
	$on_delivery = $_POST['on_delivery'];
	$cid = (int)$_POST['cid'];
	$cons_no = $_POST['cons_no'];
	
	$sql = "INSERT INTO courier_paid (cid, cons_no, book_mode, on_delivery, date)
			VALUES ($cid, '$cons_no', '$book_mode', '$on_delivery', NOW())";
	dbQuery($sql);
	
	$sql_1 = "UPDATE courier SET book_mode = '$book_mode' WHERE cid = $cid AND cons_no = '$cons_no'";
	dbQuery($sql_1);

	header('Location: admin-on-delivery.php');

}//updatePaid

function changePass() {

	$pwd = $_POST['pwd'];
	$cid = $_POST['cid'];

	$sql_1 = "UPDATE manager_user SET pwd = '$pwd'	WHERE cid= '$cid'";
		dbQuery($sql_1);

	echo "<script type=\"text/javascript\">
				alert(\"Changes applied successfuly\");
				window.location = \"preferences_user.php\"
		  </script>";

}
function changeCompany() {

	$cname = $_POST['cname'];
	$cemail = $_POST['cemail'];
	$bemail = $_POST['bemail'];
	$cphone = $_POST['cphone'];
	$caddress = $_POST['caddress'];
	$website = $_POST['website'];
	$nit = $_POST['nit'];
	$country = $_POST['country'];
	$city = $_POST['city'];
	$currency = $_POST['currency'];
	$date = $_POST['date'];
	$footer_website = $_POST['footer_website'];

	$sql_2 = "UPDATE company SET cname='$cname', nit='$nit', cemail='$cemail', cphone='$cphone', caddress='$caddress', country='$country', 
	city='$city', website='$website', footer_website='$footer_website', currency='$currency', bemail='$bemail', date='$date' ";
	dbQuery($sql_2);

	echo "<script type=\"text/javascript\">
			alert(\"Changes applied successfuly\");
			window.location = \"preferences.php\"
		</script>";		
	

}


function logOut(){
	if(isset($_SESSION['user_name'])){
		unset($_SESSION['user_name']);
	}
	if(isset($_SESSION['user_type'])){
		unset($_SESSION['user_type']);
	}
	if(isset($_SESSION['user_customer'])){
		unset($_SESSION['user_customer']);
	}
	session_destroy();
	header('Location: ../index.php');
}//logOut

?>