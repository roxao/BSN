<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<title><?php site_url(); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />	
	<link rel="stylesheet" href="<?php echo base_url('assets/main-admin.css'); ?>">
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/admin.script.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.min.js')?>"></script>
</head>
<body>
	<input type="hidden" id="base_url" value="<?php echo base_url(); ?>/dashboard">
	<header>
		<nav class="clearfix">
			<div class="nav-menu float_left"><div>MENU</div></div>
			<div class="nav-logo float_left"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>/assets/logo.png" alt="SIPIN"></a></div>
			<ul class="nav-list float_right" style="padding-right: 20px">
				<li class="nav-sess"><span class="nav-welcome">Selamat Datang, <b><?php echo $this->session->userdata('username') ?></b></span></li>
				<li class="nav-notif"><a href="<?php echo base_url();?>">Notifikasi <span>2</span></a>
					<ul class="box_notif">
						<li class="false"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore, facilis.</a></li>
						<li class="false"><a href="#">Ipsum vitae quos at esse cumque obcaecati ullam temporibus ex eveniet totam</a></li>
						<li class="true"><a href="#">Similique quae nisi, quibusdam recusandae accusantium non consectetur dignissimos </a></li>
						<li class="true"><a href="#">Eius saepe expedita, eum dolor nostrum aspernatur voluptas quo eaque aperiam error </a></li>
						<li class="true"><a href="#">Magnam consectetur fugit recusandae tenetur ipsum cupiditate ipsam inventore dolor,</a></li>
					</ul>
				</li>
				<li class="nav-sess"><a href="<?php echo base_url('dashboard/user/logout');?>">Keluar</a></li>
			</ul>
		</nav>
	</header>

	<ul id="dashboard_menu">
		<li><a class="ic-adm ic-inbox " href="<?php echo base_url('dashboard') ?>">Dashboard / Inbox</a></li>
		<li><a class="ic-adm ic-submission" href="<?php echo base_url('dashboard/submission') ?>">Penerbitan IIN</a></li>
		<li><a class="ic-adm ic-submission" href="<?php echo base_url('dashboard/extend') ?>">Pengawasan IIN</a></li>
		<li><a class="ic-adm ic-iin " href="<?php echo base_url('dashboard/iinlist') ?>">Penerima IIN</a></li>
		<li><a class="ic-adm ic-report " href="<?php echo base_url('dashboard/report') ?>">Laporan</a></li>
		<li><a class="ic-adm ic-history " href="<?php echo base_url('dashboard/report') ?>">Historical Data Entry</a></li>
		<li><a class="ic-adm ic-setting parent">Pengaturan</a>
			<ul>
				<li><a class="ic-adm ic-user " href="<?php echo base_url('dashboard/settings/admin') ?>">Administrator</a></li>
				<li><a class="ic-adm ic-cms " href="<?php echo base_url('dashboard/settings/cms') ?>">Content Management</a></li>
				<li><a class="ic-adm ic-survey " href="<?php echo base_url('dashboard/settings/survey') ?>">Survey</a></li>
				<li><a class="ic-adm ic-report " href="<?php echo base_url('dashboard/settings/document_static') ?>">Dokumen Statis</a></li>
				<li><a class="ic-adm ic-report " href="<?php echo base_url('dashboard/settings/document_dynamic') ?>">Kelengkapan Dokumen</a></li>
				<li><a class="ic-adm ic-team " href="<?php echo base_url('dashboard/settings/assessment') ?>">Tim Assessment</a></li>
			</ul>
		</li>
	</ul>

	<script>
		$('.nav-menu').on('click', function(event) {
			if($('#dashboard_menu').hasClass('active')){
				$(this).removeClass('active');
				$('#dashboard_menu').removeClass('active')
			} else {
				$(this).addClass('active');
				$('#dashboard_menu').addClass('active')
			}
		});
	</script>
	
