	<div style="margin-top: 54px">
		<!-- SLIDESHOW -->

		<ul id="slideshow">
			<?php foreach ($banner as $key => $data) {
					if (empty(parse_url($data['url'])['scheme']))$data['url'] = 'http://' . ltrim($data['url']);
				?>
				<li class="item_slideshow" style="background-image: url(<?=$data['path']?>);">
					
					<div class="item_slideshow_caption">
						<a href="<?=$data['url']?>">
							<h1><?=$data['title']?></h1>
							<h2><?=$data['text']?></h2>
						</a>
					</div>
					
				</li>
			<?php } ?>
		</ul>
		<ul id="slideshow-control">
			<li></li>
			<li></li>
			<li style="width: 30px; background: #555"></li>
		</ul>

		<script>
			var slide_option = {
				target 	 : $('#slideshow'),
				interval : 3, // second units
				fadeTime : 'slow' // fast, 400, slow
			}
			carousel(slide_option);
			
		</script>

		<div class="content_welcome_world container_article" >	
			<article class="content_hello_world" style="margin-bottom: 50px" >
				<div class="welcome_title">
					<h1>Selamat Datang di <b>SIPIN</b></h1>
				</div>
				<img src="assets/logo.png" alt="" width="200px" >
				<div>
				Silakan mengisi form di bawah ini untuk melakukan permohonan IIN baru. Sebelum anda mengirim surat ini melalui sistem<br/><br/></div>
				<div style="margin-bottom: 50px" ><a href="#" class="next_home_article">Selengkapnya</a></div>
			</article>

			<div class="submit_iin">
				<article id="submit_new_iin">
					<h1  class="float_right">PENERBITAN IIN BARU</h1>
					<div class="float_right">Silakan mengisi form di bawah ini untuk melakukan permohonan IIN baru. Sebelum anda mengirim surat ini melalui sistem<br/>
						<a href="<?php echo base_url("SipinHome/submit_application/"); ?>">
							<div class="float_right">
							<button class="btn_submit_iin float_right">DAFTAR</button>
						</div>
						</a>
					</div>
				</article>
				<article id="submit_old_iin">
					<h1>PENGAWASAN IIN LAMA</h1>
					<div>Silakan mengisi form di bawah ini untuk melakukan permohonan IIN baru. Sebelum anda mengirim surat ini melalui sistem<br/>
						<a href="<?php echo base_url("SipinHome/submit_application/"); ?>">
							<div class="float_left"><button class="btn_submit_iin float_right">DAFTAR</button></div>
						</a>
						
					</div>
				</article>
			</div>
		</div>
	</div>
