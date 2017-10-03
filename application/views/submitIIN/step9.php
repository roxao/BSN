<section section-id="9" class="section_iin float_right" style="display:none">
	<h1 class="title_iin">Menerima IIN Baru</h1>
	<p>Permohonan penerbitan IIN yang sudah anda ajukan, sudah disetujui dan dikeluarkan oleh Otoritas Registrasi dalam hal ini ABA.</p>
	<br>
	<p>Silakan klik tombol “Download IIN” untuk mengunduh informasi penerbitan nomor IIN. Namun sebelumnya aka nada halaman pengisian questioner / survey kepuasan pelanggan untuk meningkatkan kualitas pelayanan kami sebagai Sekretariat Layanan Otoritas Sponsor.</p>
	</br>
	<p>
	Demikian kami sampaikan, atas perhatian dan kerjasama yang diberikan, kami mengucapkan terima kasih.
	</p>

		<br/>
		<br/>

	<div class="clearfix">
		<button style="background: red" class="float_left">Kembali</button>	
		<?php $no=0; foreach($download_upload as $data) { 
		 	 switch ($data->key) {
		 	 	case 'IPPSA':?>
		<button style="background: #01923f; color: #fff"  class="float_right"> <a href="<?php echo base_url();?>submit_iin/download?var1=<?php echo $data->file_url;?>" class="btn_download">Download IIN</button>		
	</div>
	<?php break;} 
 } ?>
</section>	
