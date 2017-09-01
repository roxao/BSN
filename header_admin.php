<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<title></title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />	
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/style.css">
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.slides.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/script.min.js"></script>
		var options = {
		  valueNames: [ 'id_no', 'id_name', 'id_pt', 'id_type', 'id_date', 'id_status' ],
		};
		var inboxList = new List('tableInbox', options);
	</script>
</head>
<body style="background: #eff3f6">
	<header>
		<nav id="wrapper">
			<div id="nav">
				<div class="container clearfix" style="padding: 10px 20px">
					<div class="nav_left float_left">
						<div class="nav_logo">
							<img src="assets/logo.png" alt="" class="float_left">
							<div class="float-right">
								<h1>Sistem Informasi Penerbitan Issuer Identification Number (SIPIN)</h1>
								<h2>Badan Standarisasi Nasional</h2>
								<h2>National Standardization Agency of Indonesia</h2>
							</div>
						</div>
					</div>
					<div class="nav_right float_right" style="margin-top: 10px">
						<ul class="user_nav clearfix">
							<li><div id="btn_register" onclick="unfade('popup_box')" action="btnPopUp" data-id="register_frame">Selamat Datang, <b>Admin</b></div></li>
							<li><div href="" id="btn_login" action="btnPopUp" data-id="login_frame">Notifikasi</div></li>
							<li><div> <a href="<?php echo base_url('insert_admin')?>">tambahAdmin </a></div></li>
							<li><div> <a href="<?php echo base_url('insert_assesment_admin')?>">tambahTimAsesement </a></div></li>
							<li><div> <a href="<?php echo base_url('data_asesment')?>">tampilTimAsesement </a></div></li>
							<li><div> <a href="<?php echo base_url('data_user')?>">tampilUser </a></div></li>
							<li><div> <a href="<?php echo base_url('inbox')?>">Inbox </a></div></li>
							<li><div> <a href="<?php echo base_url('logout_admin')?>">Keluar </a></div></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</header>