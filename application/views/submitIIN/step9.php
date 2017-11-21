<section section-id="9" class="section_iin float_right" style="display:none">
	<h1 class="title_iin">Menerima IIN Baru</h1>
	<p>Permohonan IIN yang sudah Anda ajukan, sudah disetujui dan dikeluarkan oleh Otoritas Registrasi dalam hal ini ABA.</p>
	<br>
	<p>Silakan klik tombol “Download IIN” untuk mengunduh informasi penerbitan nomor IIN. Namun sebelumnya akan ada halaman pengisian questioner / survey kepuasan pelanggan untuk meningkatkan kualitas pelayanan kami sebagai Sekretariat Layanan Otoritas Sponsor.</p>
	</br>
	<p>
	Demikian kami sampaikan, atas perhatian dan kerjasama yang diberikan, kami mengucapkan terima kasih.
	</p>

	<br/>
	<br/>

	<!-- <div class="clearfix">
		<a href="<?php echo base_url()?>submit_iin/download_iin">
			<button style="background: #01923f" class="float_right step4_next" >Download IIN</button>
		</a>	
	</div> -->

	<?php 
			$no=0; 
		 	// foreach($download_upload as $data) { 
		 	foreach($iin_download as $data) { 
		 	 	switch ($data->key) {
		 	 		case 'IIN':?>
		 				<div class="clearfix">
							<a href="<?php echo base_url()?>submit_iin/download_iin?var1=<?php echo $data->path_id;?> ">
								<button style="background: #01923f" class="float_right step4_next" >Download IIN</button>
							</a>
						</div>
		<?php 	
					break;
				} 
	 		} 
 		?>

</section>	
