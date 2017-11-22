<section section-id="0" class="section_iin float_right" >
	<h1 class="title_iin"><?php echo $title_iin0 ?></h1>
		<p>Silakan mengisi form di bawah ini untuk melakukan permohonan IIN baru. Sebelum anda mengirim surat ini melalui sistem dengan klik button <b>"Kirim"</b>, maka sebelumnya Anda harus mengunduh(download) surat permohonan yang sudah diisi yang akan akan digunakan kembali jika status data Anda sudah terverifikasi dan disetujui oleh Sekretariat Layanan.</p>
		<article style="margin: 50px">
		
	<form action="<?php echo base_url()?>submit_iin/step_0" method="post" onSubmit="return saveComment();">
			<div class="clearfix">
				<label class="input_dashed float_left" style="width: 65%">
					Lokasi Pengajuan Surat
					<input   required  id="app_address" name="app_address" type="text" placeholder="Lokasi Pengajuan Surat" />
				</label>
				<label class="input_dashed float_right right-input" style="width: 35%">
					Tanggal Pengajuan Surat
					<input  required  id="app_date" name="app_date"  type="date" placeholder="dd/MM/yyyy"/>
				</label>
			</div>
			<label  required  class="input_dashed float_left" style="width: 100%">
				Nomor Surat
				<input  required  id="app_num" name="app_num"  type="text" placeholder="Nomor Surat"/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nama Instansi Pemohon
				<input  required  id="app_instance" name="app_instance" type="text" placeholder="Nama Instansi Pemohon"/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				E-mail Instansi Pemohon
				<input  required  id="app_mail" name="app_mail" type="text" placeholder="E-mail Instansi Pemohon"/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nomor Telepon Instansi Pemohon
				<input  required  id="app_phone" name="app_phone" type="text" placeholder="Nomor Telepon Instansi Pemohon"/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Tujuan Permohonan IIN baru
				<input  required  id="app_purpose" name="app_purpose" type="text" placeholder="Tujuan Permohonan IIN baru" />
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nama Direktur Utama/Manager/Kepala Divisi Pemohon
				<input   required id="app_div" name="app_div" type="text" placeholder="Nama Direktur Utama/Manager/Kepala Divisi Pemohon"/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nama Pemohon
				<input  required  id="app_applicant" name="app_applicant"  type="text" placeholder="Nama Pemohon"/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nomor Telepon Pemohon
				<input  required  id="app_no_applicant" name="app_no_applicant"  type="text" placeholder="Nomor Telepon" />
			</label>


			<input type="hidden" id="no_type" name="no_type" />

			<div class="inputValidation2">
				<div class="g-recaptcha" style="background: #ddd;width: 250px;display: table;vertical-align: middle;text-align: center;color:#aaa;font-size: 28px;margin: 0 auto;padding: 20px;" >  <?php echo $this->session->userdata('myimgcaptcha');?> 
				</div>
				<input type="text" name='security_code' placeholder="Type the character you see ..." style="width: 200px; margin: 10px auto"><br/> <br/><br/><br/>
				<div class="clearfix">
					<button class="float_right" style="background: #01923f" name="kirim" value="kirim" type="kirim">Kirim</button>
				</div>
			</div>

			
		
		</form>
		
	</article>



	<script type="text/javascript">
		var app_type = "<?php echo $app_type ?>";
		$("#no_type").val(app_type);
		console.log(app_type);
	</script>
	<script type="text/javascript">
		var mailing_location = ("<?php echo $mailing_location ?>" != "") ? "<?php echo $mailing_location ?>" : '';
		var application_date = ("<?php echo $application_date ?>" != "") ? "<?php echo $application_date ?>" : '';
		var application_purpose = ("<?php echo $application_purpose ?>" != "") ? "<?php echo $application_purpose ?>" : '';
		var mailing_number = ("<?php echo $mailing_number ?>" != "") ? "<?php echo $mailing_number ?>" : '';
		var instance_name = ("<?php echo $instance_name ?>" != "") ? "<?php echo $instance_name ?>" : '';
		var instance_email = ("<?php echo $instance_email ?>" != "") ? "<?php echo $instance_email ?>" : '';
		var instance_phone = ("<?php echo $instance_phone ?>" != "") ? "<?php echo $instance_phone ?>" : '';
		var instance_director = ("<?php echo $instance_director ?>" != "") ? "<?php echo $instance_director ?>" : '';
		var applicant = ("<?php echo $applicant ?>" != "") ? "<?php echo $applicant ?>" : '';
		var applicant_phone_number = ("<?php echo $applicant_phone_number ?>" != "") ? "<?php echo $applicant_phone_number ?>" : '';


		
		if (mailing_location != "") {
			$(".inputValidation2").hide();
		}
		if (mailing_location != "" && app_type == "new") {
			$("#app_address").prop('disabled','disabled');
		}
		if (application_date != "" && app_type == "new") {
			$("#app_date").prop('disabled','disabled');
		}
		if (application_purpose != "" && app_type == "new") {
			$("#app_purpose").prop('disabled','disabled');
		}
		if (mailing_number != "" && app_type == "new") {
			$("#app_num").prop('disabled','disabled');
		}
		if (instance_name != "" && app_type == "new") {
			$("#app_instance").prop('disabled','disabled');
		}
		if (instance_email != "" && app_type == "new") {
			$("#app_mail").prop('disabled','disabled');
		}
		if (instance_phone != "" && app_type == "new") {
			$("#app_phone").prop('disabled','disabled');
		}
		if (instance_director != "" && app_type == "new") {
			$("#app_div").prop('disabled','disabled');
		}
		if (applicant != "" && app_type == "new") {
			$("#app_applicant").prop('disabled','disabled');
		}
		if (applicant_phone_number != "" && app_type == "new") {
			$("#app_no_applicant").prop('disabled','disabled');
		}

		$("#app_address").val(mailing_location);
		$("#app_date").val(application_date);
		$("#app_purpose").val(application_purpose);
		$("#app_num").val(mailing_number);
		$("#app_instance").val(instance_name);
		$("#app_mail").val(instance_email);
		$("#app_phone").val(instance_phone);
		$("#app_div").val(instance_director);
		$("#app_applicant").val(applicant);
		$("#app_no_applicant").val(applicant_phone_number);
	</script>
	<!-- <script type="text/javascript">
		document.getElementById("app_address").value = localStorage.getItem("address");

		function saveComment() {
			var app_address = document.getElementById("app_address").value;


			localStorage.setItem("address", app_address);
		}
	</script> -->
	<!-- form  -->
</section>
