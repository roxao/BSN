<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<title></title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />	
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/style.css"/>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.slides.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/script.min.js"></script>

</head>
<body>
	<div class="content-background"></div>
	<header>
		<nav id="wrapper">
			<div id="nav">
				<div class="top_nav  container clearfix">
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
							<?php if ($this->session->flashdata('validasi-login') == '') {?>
								<li><a href="#" action="modal_pupop" data-id="#register_frame">DAFTAR</a></li>
								<li><a href="#" action="modal_pupop" data-id="#login_frame">MASUK</a></li>
							<?php } else { ?>
								<li><a href="#" action="modal_pupop" data-id="#notifikasi">NOTIFIKASI <span>5</span></a></li>
								<li><a href="#" action="modal_popup" data-id="#log_out">KELUAR</a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<div class="bot_nav clearfix">
					<img src="assets/logo.png" alt="" class="stickyNavShow float_left" height="30px" style="margin: 7px; display: none" >
					<ul class="page_nav float_left clearfix">
						<!-- Loop DB_MENU -->
						<!-- TEMPLATE -->
						<!-- <li><a href="menu_url">menu_name</a></li> -->

						<li class="nav_parent"><a href="">Layanan IIN</a>
							<ul>
								<li><a href="iin-new.html"> Daftar Penerbitan IIN baru </a></li>
								<li><a href="iin-publish-lama.html"> Daftar Pengawasan IIN Lama </a></li>
							</ul>
						</li>
						<li class="nav_parent"><a href="">Informasi IIN</a>
							<ul>
								<li><a href="iin-publish.html">Daftar penerima IIN</a></li>
								<li><a href="#"> File ISO 7812</a></li>
								<li><a href="#"> Hasil Survey</a></li>
							</ul>
						</li>
						<li><a href="contact-us.html">Hubungi Kami</a></li>
					</ul>
					<ul class="user_nav float_right stickyNavShow" style="margin-top: 13px; margin-right: 10px; display: none">
						<?php if ($this->session->flashdata('validasi-login') == '') {?>
							<li><a href="#" action="modal_pupop" data-id="#register_frame">DAFTAR</a></li>
							<li><a href="#" action="modal_pupop" data-id="#login_frame">MASUK</a></li>
						<?php } else { ?>
							<li><a href="#" action="modal_pupop" data-id="#notifikasi">NOTIFIKASI <span>5</span></a></li>
							<li><a href="#" action="modal_popup" data-id="#log_out">KELUAR</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>
	</header>



	<?php $this->load->view('component/modal') ?>
