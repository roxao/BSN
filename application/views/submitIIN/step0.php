<section section-id="0" class="section_iin float_right" >
	<h1 class="title_iin">Pengajuan Surat Permohonan IIN Baru</h1>
		<p>Silakan mengisi form di bawah ini untuk melakukan permohonan IIN baru. Sebelum anda mengirim surat ini melalui sistem dengan klik button <b>"Kirim"</b>, maka sebelumnya Anda harus mengunduh(download) surat permohonan yang sudah diisi yang akan akan digunakan kembali jika status data Anda sudah terverifikasi dan disetujui oleh Sekretariat Layanan.</p>
		<article style="margin: 50px">
		
	<form action="<?php echo base_url()?>submit_iin/step_0" method="post" onSubmit="return saveComment();">
			<div class="clearfix">
				<label class="input_dashed float_left" style="width: 65%">
					Lokasi Pengajuan Surat
					<input   required  id="app_address" name="app_address" type="text" placeholder="Lokasi Pengajuan Surat"<?php  ?> />
				</label>
				<label class="input_dashed float_right right-input" style="width: 35%">
					Tanggal Pengajuan Surat
					<input  required  id="app_date" name="app_date"  type="date" placeholder="dd/MM/yyyy" />
				</label>
			</div>
			<label  required  class="input_dashed float_left" style="width: 100%">
				Nomor Surat
				<input  required  id="app_num" name="app_num"  type="text" placeholder="Nomor Surat" />
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nama Instansi Pemohon
				<input  required  id="app_instance" name="app_instance" type="text" placeholder="Nama Instansi Pemohon" />
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				E-mail Instansi Pemohon
				<input  required  id="app_mail" name="app_mail" type="text" placeholder="E-mail Instansi Pemohon" />
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nomor Telepon Instansi Pemohon
				<input  required  id="app_phone" name="app_phone" type="text" placeholder="Nomor Telepon Instansi Pemohon" />
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Tujuan Permohonan IIN baru
				<input  required  id="app_purpose" name="app_purpose" type="text" placeholder="Tujuan Permohonan IIN baru" />
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nama Direktur Utama/Manager/Kepala Divisi Pemohon
				<input   required id="app_div" name="app_div" type="text" placeholder="Nama Direktur Utama/Manager/Kepala Divisi Pemohon" />
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nama Pemohon
				<input  required  id="app_applicant" name="app_applicant"  type="text" placeholder="Nama Pemohon" />
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nomor Telepon Pemohon
				<input  required  id="app_no_applicant" name="app_no_applicant"  type="text" placeholder="Nomor Telepon" />
			</label>
			

			<div class="inputValidation2">
				<!-- <div class="g-recaptcha" style="background: #ddd;width: 250px;display: table;vertical-align: middle;text-align: center;color:#aaa;font-size: 28px;margin: 0 auto;padding: 20px;" data-sitekey="6LerwS0UAAAAAF27mC7K-XWf-IYBMyrZcTKbhEeB" > </div> -->

	<div class="g-recaptcha" style="background: #ddd;width: 250px;display: table;vertical-align: middle;text-align: center;color:#aaa;font-size: 28px;margin: 0 auto;padding: 20px;" >  <?php echo $this->session->userdata('myimgcaptcha');?> </div>
			<input type="text" name='security_code' placeholder="Type the character you see ..." style="width: 200px; margin: 10px auto"><br/> <br/><br/><br/>
			<div class="clearfix">
			<!-- 	<button class="float_left" style="background: red" name="batal" value="batal" type="batal">Batal</button> -->
				<button class="float_right" style="background: #01923f" name="kirim" value="kirim" type="kirim">Kirim</button>
			</div>
		</div>
		</article>
	</form>

	<script type="text/javascript">
		$('[type=date]').datepicker();
	</script>
	<!-- <script type="text/javascript">
		document.getElementById("app_address").value = localStorage.getItem("address");
		document.getElementById("app_date").value = localStorage.getItem("date");
		document.getElementById("app_num").value = localStorage.getItem("num");
		document.getElementById("app_instance").value = localStorage.getItem("instance");
		document.getElementById("app_mail").value = localStorage.getItem("mail");
		document.getElementById("app_phone").value = localStorage.getItem("phone");
		document.getElementById("app_purpose").value = localStorage.getItem("purpose");
		document.getElementById("app_div").value = localStorage.getItem("div");
		document.getElementById("app_applicant").value = localStorage.getItem("applicant");
		document.getElementById("app_no_applicant").value = localStorage.getItem("no_applicant");


		function saveComment() {
		    var app_address = document.getElementById("app_address").value;
		    var app_date = document.getElementById("app_date").value;
		    var app_num = document.getElementById("app_num").value;
		    var app_instance = document.getElementById("app_instance").value;
		    var app_mail = document.getElementById("app_mail").value;
		    var app_phone = document.getElementById("app_phone").value;
		    var app_purpose = document.getElementById("app_purpose").value;
		    var app_div = document.getElementById("app_div").value;
		    var app_applicant = document.getElementById("app_applicant").value;
		    var app_no_applicant = document.getElementById("app_no_applicant").value;


		    localStorage.setItem("address", app_address);
		    localStorage.setItem("date", app_date);
		    localStorage.setItem("num", app_num);
		    localStorage.setItem("instance", app_instance);
		    localStorage.setItem("mail", app_mail);
		    localStorage.setItem("phone", app_phone);
		    localStorage.setItem("purpose", app_purpose);
		    localStorage.setItem("div", app_div);
		    localStorage.setItem("applicant", app_applicant);
		    localStorage.setItem("no_applicant", app_no_applicant);
		    alert("Your comment has been saved!");
			
		    location.reload();
		    // return false;
		    //return true;
		}
	</script> -->

	<!-- form  -->
</section>
