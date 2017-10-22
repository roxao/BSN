<section class="clearfix content-approval">
	<?php echo form_open_multipart('admin_verifikasi_controller/UPL_RES_ASSESS_REQ_SUCCESS') ?>
		<input type="hidden" name="id_application_status">
		<input type="hidden" name="id_application">
		<section class="clearfix content_application" >
			<div class="clearfix">
				<label class="input_dashed float_left" style="width: 65%">
					Lokasi Pengajuan Surat
					<input name="mailing_location" type="text" placeholder="Lokasi Pengajuan Surat" disabled/>
				</label>
				<label class="input_dashed float_right" style="width: 35%">
					Tanggal Pengajuan Surat
					<input name="application_date" type="text" placeholder="dd/MM/yyyy" disabled/>
				</label>
			</div>
			<label class="input_dashed float_left" style="width: 100%">
				Nomor Surat
				<input name="mailing_number"  type="text" placeholder="Nomor Surat" disabled/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nama Pemohon
				<input name="applicant"  type="text" placeholder="Nomor Surat" disabled/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nomor Telepon Pemohon
				<input name="applicant_phone_number"  type="text" placeholder="Nomor Surat" disabled/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nama Instansi Pemohon
				<input name="instance_name" type="text" placeholder="Nama Instansi Pemohon" disabled/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				E-mail Instansi Pemohon
				<input name="instance_email" type="text" placeholder="E-mail Instansi Pemohon" disabled/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nomor Telepon Instansi Pemohon
				<input name="instance_phone" type="text" placeholder="Nomor Telepon Instansi Pemohon"  disabled/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nama Direktur Utama/Manager/Kepala Divisi Pemohon
				<input name="instance_director" type="text" placeholder="Nama Direktur Utama/Manager/Kepala Divisi Pemohon" disabled/>
			</label>
		</section>
		<input type="submit" name="submit_approval" hidden/>
	</form>
</section>





<section class="clearfix content-revision" style="display:none">
	<p>Masukan keterangan perbaikan dokumen yang harus di unggah oleh Pemohon</p>
	<?php echo form_open_multipart('admin_verifikasi_controller/VERIF_NEW_REQ_ETC') ?>
		<input type="hidden" name="id_application_status">
		<input type="hidden" name="id_application">
		<textarea name="coment" cols="30" rows="10" class="text_comment"></textarea>
		<input type="submit" name="submit_revision" hidden/>
	</form>
</section>








<script>
	value=respon.application;
	$("[name=id_application_status]").val(value.id_application_status);
	$("[name=id_application]").val(value.id_application);
	$("[name=applicant]").val(value.applicant);
	$("[name=applicant_phone_number]").val(value.applicant_phone_number);
	$("[name=application_date]").val(value.application_date);
	$("[name=instance_director]").val(value.instance_director);
	$("[name=instance_email]").val(value.instance_email);
	$("[name=instance_name]").val(value.instance_name);
	$("[name=instance_phone]").val(value.instance_phone);
	$("[name=mailing_location]").val(value.mailing_location);
	$("[name=mailing_number]").val(value.mailing_number);

   	$('#btn-approval').on('click', function(event) {
   		$('[name=submit_approval]').click()
   		});
   	$('#btn-revision-back-send').on('click', function(event) {
   		$('[name=submit_revision]').click()
   		});
	$('#btn-revision').on('click', function(event) {
		$('.content-approval').hide();
		$('.content-revision').slideDown();
		$('#section-approval').hide();
		$('#section-revision').slideDown();
		});
	$('#btn-revision-back').on('click', function(event) {
		$('.content-approval').slideDown();
		$('.content-revision').hide();
		$('#section-approval').slideDown();
		$('#section-revision').hide();
		});
</script>
