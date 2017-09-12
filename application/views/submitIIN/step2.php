
<!-- 
// ISI Input dengan JSON dibawah:
JSON =	{"step": 1,
		 "status": 0,
		 "upload":[   
			 		{ 
			 		  "attach_name": "Informasi Persyaratan Pendaftaran Sponsoring Authority (kode: F.PKS.8.0.2)",
			 	      "attach_url": "localhost/BSN/abcdefg.pdf"
				    },
				    { 
			 		  "attach_name": "Informasi Persyaratan Pendaftaran Sponsoring Authority (kode: F.PKS.8.0.2)",
			 	      "attach_url": "localhost/BSN/abcdefg.pdf"
				    },
				    { 
			 		  "attach_name": "Informasi Persyaratan Pendaftaran Sponsoring Authority (kode: F.PKS.8.0.2)",
			 	      "attach_url": "localhost/BSN/abcdefg.pdf"
				    },
			 ],
		}	
 -->

<section section-id="2" class="section_iin float_right" style="width: 70%; display:none">
	<h1 class="title_iin">Submit Kelengkapan Dokumen Permohonan IIN</h1>
	<p>Silakan mengunggah dokumen-dokumen yang sudah dilengkapi dan dipersiapkan ke dalam berdasarkan urutan di bawah ini.</p>

	<ul class="section_iin_download">

	<!-- LOOP url1 DISINI -->
		 <?php $no=0; foreach($download_upload as $data) {
		 switch ($data->type) {
		 	 	/*Ini tinggal dirubah aja yah key nya */
		 	 	case 'DYNAMIC': ?>
		<li> <input type="checkbox" required/> class="btn_download" <?php  $no++; echo "$no.  "; echo $data->display_name; ?>  <a href="echo form_open_multipart('upload/do_upload');"> Upload</a></li> 	
 <?php break; }
 } ?> 

	</ul>

	<p >*Dokumen yang wajib disertakan</p>
		<br/>
		<br/>

	<div class="clearfix">
		<button id="btn_back" style="background: red" class=" btn_back float_left">Kembali</button>	
		<button style="background: #01923f" class="float_right">Lanjutkan Proses</button>	
	</div>
</section>
