	<div style="margin-top: 54px">
		<!-- SLIDESHOW -->
		<script>
		$(function() {
		      $('#slideshow').slidesjs({
		      	width: 1920,
		      	height: 850,
		      	navigation: {active: false},
		        play: {
		          active: true,
		          auto: true,
		          interval: 3000,
		          swap: true,
		          pauseOnHover: true
		        }
		      });
		    });
		</script>
		<ul id="slideshow">
			<li class="item_slideshow" style="background-image: url(assets/banner2.jpeg);">
				<div class="item_slideshow_caption">
					<h1>Slideshow Title 1</h1>
					<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem facilis modi aliquam eligendi placeat deleniti perferendis, amet unde voluptatum obcaecati excepturi molestiae eum autem. Reprehenderit explicabo tempore soluta praesentium totam.</h2>
				</div>
			</li>
			<li class="item_slideshow" style="background-image: url(assets/banner2.jpeg)">
				<div class="item_slideshow_caption">
					<h1>Slideshow Title 2</h1>
					<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem facilis modi aliquam eligendi placeat deleniti perferendis, amet unde voluptatum obcaecati excepturi molestiae eum autem. Reprehenderit explicabo tempore soluta praesentium totam.</h2>
				</div>
			</li>
			<li class="item_slideshow" style="background-image: url(assets/banner2.jpeg)">
				<div class="item_slideshow_caption">
					<h1>Slideshow Title 3</h1>
					<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem facilis modi aliquam eligendi placeat deleniti perferendis, amet unde voluptatum obcaecati excepturi molestiae eum autem. Reprehenderit explicabo tempore soluta praesentium totam.</h2>
				</div>
			</li>
		</ul>
		<ul id="slideshow-control">
			<li></li>
			<li></li>
			<li style="width: 30px; background: #555"></li>
		</ul>

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
