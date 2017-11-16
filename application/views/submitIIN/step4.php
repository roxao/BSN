<section section-id="4" class="section_iin float_right" style="display:none">
	<h1 class="title_iin">Konfirmasi Surat Lulus Kelengkapan dan Kode Billing</h1>
	<p>Berdasarkan persetujuan pada proses verifikasi dan validasi terhadap status permohonan anda, dengan ini terlampir suat persetujuan untuk dokumen-dokumen terlampir.</p>

	<p>Silakan unduh (download) beberapa dokumen berikut dan diunggah (upload) kembali setelah dilengkapi.</p>

	<ul class="list_iin_download">
		 <?php $no=0; 
		 	foreach($download_upload_kode_bill as $data) { 
		 	 	switch ($data->key) {
		 	 		case 'SPP':?>
		 				<div class="item-download">
							<div><?php echo $data->display_name; ?></div>
							 <a href="<?php echo base_url();?>submit_iin/download?var1=<?php echo $data->file_url;?>" class="btn_download"  >Download</a>
		 				</div>	
		 <?php 			break;
				} 
	 		} ?> 
	</ul>
	<ul class="list_iin_download">
		 <?php $no=0; 
		 	foreach($download_upload_kode_bill as $data) { 
		 	 	switch ($data->key) {
		 	 		case 'SPL PNBP':?>
		 				<div class="item-download">
							<div><?php echo $data->display_name; ?></div>
							 <a href="<?php echo base_url();?>submit_iin/download?var1=<?php echo $data->file_url;?>" class="btn_download"  >Download</a>
		 				</div>	
		 <?php 			break;
				} 
	 		} ?> 
	</ul>

	<ul class="list_iin_download">
		 <?php $no=0; 
		 	foreach($download_upload_kode_bill as $data) { 
		 	 	switch ($data->key) {
		 	 		case 'KBS':?>
		 				<div class="item-download">
							<div><?php echo $data->display_name; ?></div>
							 <a href="<?php echo base_url();?>submit_iin/download?var1=<?php echo $data->file_url;?>" class="btn_download"  >Download</a>
		 				</div>	
		 <?php 			break;
				} 
	 		} ?> 
	</ul>

	<p >Silakan klik tombol “Lanjutkan Proses Permohonan IIN Baru” untuk melanjutkan ke proses pembayaran penerbitan IIN baru.</p>
		<br/>
		<br/>

	<div class="clearfix">
		<button style="background: red" class="float_left">Kembali</button>	
		<!-- <button style="background: #01923f" class="float_right" id="upload_button2">Lanjutkan Proses</button>	 -->
		<a href="<?php echo base_url()?>submit_iin/step_4">
			<button style="background: #01923f" class="float_right step4_next" value="step1_next">  Lanjutkan Proses</button>
		</a>	
	</div>
</section>

<script type="text/javascript">
	var upload_status = "<?php echo $upload_status2?>";
	console.log(upload_status);


	if (upload_status == 'success') {
		$(".step4_next").hide();
	} else {
		$(".step4_next").show();
	}
</script>