<section class="clearfix content_application" style="margin: 20px" >
	<div class="clearfix">
		<label class="input_dashed float_left" style="width: 65%">
			Lokasi Pengajuan Surat
			<input id="app_address" name="mailing_location" type="text" placeholder="Lokasi Pengajuan Surat" disabled/>
		</label>
		<label class="input_dashed float_right" style="width: 35%">
			Tanggal Pengajuan Surat
			<input id="application_date" name="application_date"  type="date" placeholder="dd/MM/yyyy" disabled/>
		</label>
	</div>
	<label class="input_dashed float_left" style="width: 100%">
		Nomor Surat
		<input id="app_num" name="mailing_number"  type="text" placeholder="Nomor Surat" disabled/>
	</label>
	<label class="input_dashed float_left" style="width: 100%">
		Nama Pemohon
		<input id="app_num" name="applicant"  type="text" placeholder="Nomor Surat" disabled/>
	</label>
	<label class="input_dashed float_left" style="width: 100%">
		Nomor Telepon Pemohon
		<input id="app_num" name="applicant_phone_number"  type="text" placeholder="Nomor Surat" disabled/>
	</label>
	<label class="input_dashed float_left" style="width: 100%">
		Nama Instansi Pemohon
		<input id="app_instance" name="instance_name" type="text" placeholder="Nama Instansi Pemohon" disabled/>
	</label>
	<label class="input_dashed float_left" style="width: 100%">
		E-mail Instansi Pemohon
		<input id="app_mail" name="instance_email" type="text" placeholder="E-mail Instansi Pemohon" disabled/>
	</label>
	<label class="input_dashed float_left" style="width: 100%">
		Nomor Telepon Instansi Pemohon
		<input id="app_phone" name="instance_phone" type="text" placeholder="Nomor Telepon Instansi Pemohon"  disabled/>
	</label>
	<label class="input_dashed float_left" style="width: 100%">
		Nama Direktur Utama/Manager/Kepala Divisi Pemohon
		<input id="app_director" name="instance_director" type="text" placeholder="Nama Direktur Utama/Manager/Kepala Divisi Pemohon" disabled/>
	</label>
</section>


<!-- COMMENT BOX -->
<section class="slide_comment" style="display: none">
	<p>Masukan keterangan perbaikan dokumen yang harus di unggah oleh Pemohon</p>
	<textarea name="" id="" cols="30" rows="10" class="text_comment"></textarea>
	<div class="clearfix">
		<button class="btn_cancel_comment float_left" style="background: red">BATAL</button>
		<button class="btn_send float_right" style="background: #00a8cf">KIRIM</button>
	</div>
</section>


<!-- VERIFICATION BOX -->
<div class="verify_section">
	<div class="clearfix">
		<button class="btn_reject float_left" style="background: red">REVISI</button>
		
		<form action="<?php echo base_url('admin_verifikasi_controller/VERIF_NEW_REQ_PROSES') ?>" method="post" accept-chaset="utf-8">

		<input type="hidden" name="id_application_status" value="">
		<input type="hidden" name="id_application" value="">

		<button class="btn_send float_right" style="background: #01923f">SETUJU</button>

	</form>
	</div>
</div>


<script>

	value=respon.application;
$("input[name=id_application_status]").val(value.id_application_status);
$("input[name=id_application]").val(value.id_application);

	
	console.log(respon);
	$("input[name=applicant]").val(value.applicant);
	$("input[name=applicant_phone_number]").val(value.applicant_phone_number);
	$("input[name=application_date]").val(value.application_date);
	$("input[name=instance_director]").val(value.instance_director);
	$("input[name=instance_email]").val(value.instance_email);
	$("input[name=instance_name]").val(value.instance_name);
	$("input[name=instance_phone]").val(value.instance_phone);
	$("input[name=mailing_location]").val(value.mailing_location);
	$("input[name=mailing_number]").val(value.mailing_number);

</script>