<section section-id="7" class="section_iin float_right" style="display:none">
	<h1 class="title_iin">Assessment Lapangan</h1>
	<p>Permohonan IIN baru yang anda ajukan sudah memasuki tahapan Assessment Lapangan oleh tim yang ditunjuk Sekretariat Layanan dan berikut terlampir surat penugasan untuk kegiatan terkait. Dilakan diunduh jika diperlukan sebagai dokumen pendukung.</p>
	
	<ul class="list_iin_download">
		 <?php $no=0; 
		 	foreach($download_upload as $data) { 
		 	 	switch ($data->key) {
		 	 		case 'IPPSA':?>
		 				<div class="item-download">
							<div><?php $no++; echo "$no.  "; echo $data->display_name; ?></div>
							 <a href="<?php echo base_url();?>submit_iin/download?var1=<?php echo $data->file_url;?>" class="btn_download"  >Download</a>
		 				</div>	
		 <?php 			break;
				} 
	 		} ?>  
	</ul>


	<p >Hasil dari kegiatan Assement Lapangan ini akan dilakukan verifikasi. Jika instansi anda telah memnuhi persyaratan permohonan IIN, maka silakan anda menunggu dalam waktu maksimal 9 hari kerja untuk menerima informasi penerbitan IIN. Namun, jika persyaratan permohonan IIN anda belum terpenuhi, maka anda harus melakukan perbaikan hasil Assessment yang akan diinformasikan setelah rapat pembahsan hasil verifikasi lapangan oleh Sekretariat Layanan melalui aplikasi SIPIN ini..</p>
	<br>
	</br>
	<p >
	Silakan klik tombol “Selanjutnya” jika anda sudah memahami alur proses di tahap ini dan siap untuk melanjutkan ke tahapan proses penerbitan IIN selanjutnya.
	</p>
		<br/>
		<br/>

	<div class="clearfix">
		<button style="background: red" class="float_left">Kembali</button>	
		<button style="background: #01923f" class="float_right">Lanjutkan Proses</button>	
	</div>
</section>
