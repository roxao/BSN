
<!-- 
// ISI Input dengan JSON dibawah:
JSON =	{"step": 1,
		 "status": 0,
		 "url1":[   
			 		{ "attach_name": "Informasi Persyaratan Pendaftaran Sponsoring Authority (kode: F.PKS.8.0.2)",
			 	      "attach_url": "localhost/BSN/abcdefg.pdf"
				    },
					{ "attach_name": "Informasi Persyaratan Pendaftaran Sponsoring Authority (kode: F.PKS.8.0.2)",
			 		  "attach_url": "localhost/BSN/abcdefg.pdf"
			 		}
			 ],
		 "url2":[   
		 		{ "attach_name": "Informasi Persyaratan Pendaftaran Sponsoring Authority (kode: F.PKS.8.0.2)",
		 	      "attach_url": "localhost/BSN/abcdefg.pdf"
			    },
				{ "attach_name": "Informasi Persyaratan Pendaftaran Sponsoring Authority (kode: F.PKS.8.0.2)",
		 		  "attach_url": "localhost/BSN/abcdefg.pdf"
		 		}
		 ],
		}	
 -->

<section section-id="1" class="section_iin float_right" style="width: 70%; display:none">
	<h1 class="title_iin">Hasil Verifikasi Status Permohonan</h1>
	<p>Status Permohonan IIN Baru Anda telah di Verifikasi dan telah disetujui. Berikut ini merupakan surat yang diterbitkan oleh Sekretariat Layanan terkait permohonan Anda. Silakan diunduh (download) sebagai bukti untuk bisa melanjutkan permohonan ke tahap selanjutnya.</p>

	
	<ul class="section_iin_download">
		<!-- LOOP url1 DISINI -->
		 <?php foreach($download_upload as $data) {?>

		
		<li> <?php echo $data->display_name; ?>  	<a href="<?php echo base_url().'submit_iin/download/'.$data->path_file; ?>" class="btn_download"  >Download</a> </li> 
		
                
        
		
 <?php } ?> 
	</ul>
	
	


	<p>Silakan unduh (download) beberapa dokumen berikut dan diunggah (upload) kembali setelah dilengkapi.</p>

	<!-- LOOP url2 DISINI -->
	<ul class="section_iin_download">
		<li>1. Term & Condition (kode: F.PKS.8.0.3)												<a href="<?php echo base_url();?>submit_iin/download_Upload_aplication_step" class="btn_download" method="post" name="StepDuaFile" value="2" >Download</a></li>
		<li>2. Form Aplikasi (Form Annex B) ISO IEC 7812-2_2015 (kode: DP.PKS.30)				<a href="<?php echo base_url();?>submit_iin/download_Upload_aplication_step" class="btn_download" method="post" name="StepDuaFile" value="3">Download</a></li>
	</ul>

	<p >Setelah mengunduh dan melengkapi isi dari masing-masing dokumen, silakan klik button link di bawah ini untuk melanjutkan proses permohonan dengan melengkapi dokumen-dokumen yang dibutuhkan untuk diproses oleh Sekretariat Layanan.</p>
		<br/>
		<br/>

	<div class="clearfix">
		<button style="background: red" class="btn_back float_left">Kembali</button>	
		<button style="background: #01923f" class="float_right">Lanjutkan Proses</button>	
	</div>
</section>
