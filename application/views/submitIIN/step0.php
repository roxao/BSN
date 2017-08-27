
<!-- 
// ISI Input dengan JSON dibawah:
JSON =	{"step": 0,
		 "status": 0,
		 "app_data":[{
			"app_address": "",
			"app_date": "",
			"app_num": "",
			"app_instance": "",
			"app_mail": "",
			"app_phone": "",
			"app_div": ""
			}]
		}	
 -->

<section section-id="0" class="section_iin float_right" style="width: 70%;">
	<h1 class="title_iin">Pengajuan Surat Permohonan IIN Baru</h1>
	<form action="">
		<p>Silakan mengisi form di bawah ini untuk melakukan permohonan IIN baru. Sebelum anda mengirim surat ini melalui sistem dengan klik button <b>"Kirim"</b>, maka sebelumnya Anda harus mengunduh(download) surat permohonan yang sudah diisi yang akan akan digunakan kembali jika status data Anda sudah terverifikasi dan disetujui oleh Sekretariat Layanan.</p>
		<article style="margin: 50px">
			<div class="clearfix">
				<label class="input_dashed float_left" style="width: 65%">
					Lokasi Pengajuan Surat
					<input id="app_address" type="text" placeholder="Lokasi Pengajuan Surat" required/>
				</label>
				<label class="input_dashed float_right" style="width: 35%">
					Tanggal Pengajuan Surat
					<input id="app_date" type="date" placeholder="dd/MM/yyyy" required/>
				</label>
			</div>
			<label class="input_dashed float_left" style="width: 100%">
				Nomor Surat
				<input id="app_num" type="text" placeholder="Nomor Surat" required/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nama Instansi Pemohon
				<input id="app_instance" type="text" placeholder="Nama Instansi Pemohon" required/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				E-mail Instansi Pemohon
				<input id="app_mail" type="text" placeholder="E-mail Instansi Pemohon" required/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nomor Telepon Instansi Pemohon
				<input id="app_phone" type="text" placeholder="Nomor Telepon Instansi Pemohon" required/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nama Direktur Utama/Manager/Kepala Divisi Pemohon
				<input id="app_div" type="text" placeholder="Nama Direktur Utama/Manager/Kepala Divisi Pemohon" required/>
			</label>

			<div class="inputValidation2">
				<div class="g-recaptcha" style="background: #ddd;width: 250px;display: table;vertical-align: middle;text-align: center;color:#aaa;font-size: 28px;margin: 0 auto;padding: 20px;" data-sitekey="6LerwS0UAAAAAF27mC7K-XWf-IYBMyrZcTKbhEeB" > </div>
				<input type="text" placeholder="Type the character you see ..." style="width: 200px; margin: 10px auto"><br/> <br/><br/><br/>
				<div class="clearfix">
					<button class="float_left" style="background: red">Batal</button>
					<button class="float_right" style="background: #01923f">Kirim</button>
					<button class="float_right" style="background: #00a8cf">Download Surat</button>
				</div>
			</div>
		</article>
	</form>

	<!-- form  -->
</section>
