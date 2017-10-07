<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<title><?php site_url(); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />	
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/main-admin.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/admin.script.js"></script>
</head>
<body>
	<input type="hidden" id="base_url" value="<?php echo base_url(); ?>/dashboard">
	<header>
		<nav id="wrapper">
			<div id="nav">
				<div class="clearfix" style="padding: 10px 20px">
					<div class="nav_left float_left">
						<div class="nav_logo">
							<img src="<?php  echo base_url(); ?>/assets/logo.png" alt="" class="float_left">
							<div class="float_right">
								<h1>Sistem Informasi Penerbitan Issuer Identification Number (SIPIN)</h1>
								<h2>Badan Standarisasi Nasional</h2>
								<h2>National Standardization Agency of Indonesia</h2>
							</div>
						</div>
					</div>
					<div class="nav_right float_right" style="margin-top: 10px">
						<ul class="user_nav clearfix">
							<li><div id="btn_register" onclick="unfade('popup_box')" action="btnPopUp" data-id="register_frame">Selamat Datang, <b>Admin</b></div></li>
							<li><div href="" id="btn_login" action="btnPopUp" data-id="login_frame">Notifikasi</div>
								<ul class="notif_box">
									<li class="notif false">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, neque libero</li>
									<li class="notif false">Lorem ipsum dolor sit amet, consectetur elit. Voluptatem, neque libero</li>
									<li class="notif true">Lorem ipsum dolor sit amet,  elit. , neque libero</li>
									<li class="notif true">Lorem ipsum dolor sit amet, consectetur consectetur adipisicing elit. Voluptatem, neque libero</li>
									<li class="notif true">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, neque libero</li>
								</ul>
							</li>
							<li><a href="<?php base_url(); ?>logout">Keluar</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</header>

	<ul id="dashboard_menu">
		<li><a href="">Dashboard / Inbox</a></li>
		<li><a href="">Penerbitan IIN</a></li>
		<li><a href="">Pengawasan IIN</a></li>
		<li><a href="">Penerima IIN</a></li>
		<li><a href="">Laporan</a></li>
		<li><a href="">Pengaturan</a></li>
	</ul>
