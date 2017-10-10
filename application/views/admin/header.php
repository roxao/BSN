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
		<nav class="clearfix">
			<div class="nav-menu float_left"><div>MENU</div></div>
			<div class="nav-logo float_left"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>/assets/logo.png" alt="SIPIN"></a></div>
			<ul class="nav-list float_right" style="padding-right: 20px">
				<?php if($this->session->userdata('status') != "login") {?>
				<li class="nav-sess"><a href="<?php echo base_url();?>" class="open_modal" action="login">Masuk</a></li>
				<li class="nav-sess register"><a href="<?php echo base_url();?>" class="open_modal" action="register">Daftar</a></li>

				<?php } else { ?>
				<li class="nav-notif"><a href="<?php echo base_url();?>">Notifikasi <span>2</span></a>
					<ul class="box_notif">
						<li class="false"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore, facilis.</a></li>
						<li class="false"><a href="#">Ipsum vitae quos at esse cumque obcaecati ullam temporibus ex eveniet totam</a></li>
						<li class="true"><a href="#">Similique quae nisi, quibusdam recusandae accusantium non consectetur dignissimos </a></li>
						<li class="true"><a href="#">Eius saepe expedita, eum dolor nostrum aspernatur voluptas quo eaque aperiam error </a></li>
						<li class="true"><a href="#">Magnam consectetur fugit recusandae tenetur ipsum cupiditate ipsam inventore dolor,</a></li>
					</ul>
				</li>
				<li class="nav-sess"><a href="<?php echo base_url();?>SipinHome/logout">Keluar</a></li>
				<?php } ?>
			</ul>
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
