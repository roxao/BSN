
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
		<li>Informasi Persyaratan Pendaftaran Sponsoring Authority (kode: F.PKS.8.0.2)			<a href="" class="btn_download">Download</a></li>
	</ul>

	<p>Silakan unduh (download) beberapa dokumen berikut dan diunggah (upload) kembali setelah dilengkapi.</p>

	<!-- LOOP url2 DISINI -->
	<ul class="section_iin_download">
		<li>1. Term & Condition (kode: F.PKS.8.0.3)												<a href="" class="btn_download">Download</a></li>
		<li>2. Form Aplikasi (Form Annex B) ISO IEC 7812-2_2015 (kode: DP.PKS.30)				<a href="" class="btn_download">Download</a></li>
	</ul>

	<p >Setelah mengunduh dan melengkapi isi dari masing-masing dokumen, silakan klik button link di bawah ini untuk melanjutkan proses permohonan dengan melengkapi dokumen-dokumen yang dibutuhkan untuk diproses oleh Sekretariat Layanan.</p>
		<br/>
		<br/>

	<div class="clearfix">
		<button style="background: red" class="btn_back float_left">Kembali</button>	
		<button style="background: #01923f" class="float_right">Lanjutkan Proses</button>	
	</div>
</section>