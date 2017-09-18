<section section-id="4" class="section_iin float_right" style="width: 70%; display:none">
	<h1 class="title_iin">Konfirmasi Surat Lulus Kelengkapan dan Kode Billing</h1>
	<p>Berdasarkan persetujuan pada proses verifikasi dan validasi terhadap status permohonan anda, dengan ini terlampir suat persetujuan untuk dokumen-dokumen terlampir.</p>

	<p>Silakan unduh (download) beberapa dokumen berikut dan diunggah (upload) kembali setelah dilengkapi.</p>

	<ul class="section_iin_download">
		<!-- LOOP -->
		 <?php $no=0; foreach($download_upload as $data) { 
		 	 switch ($data->key) {
		 	 	case 'IPPSA':?>

		<li> <?php $no++; echo "$no.  "; echo $data->display_name; ?>  <a href="<?php echo base_url();?>submit_iin/download?var1=<?php echo $data->file_url;?>" class="btn_download"  >Download</a></li> 	
 <?php break;} 
 } ?> 
	</ul>

	<p >Silakan klik tombol “Lanjutkan Proses Permohonan IIN Baru” untuk melanjutkan ke proses pembayaran penerbitan IIN baru.</p>
		<br/>
		<br/>

	<div class="clearfix">
		<button style="background: red" class="float_left">Kembali</button>	
		<button style="background: #01923f" class="float_right">Lanjutkan Proses</button>	
	</div>
</section>
