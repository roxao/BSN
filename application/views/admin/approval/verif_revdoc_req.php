<section class="clearfix content-approval">
	<div class="section_list_file">
		<p>Berikut kelengkapan dokumen yang telah di unggah (upload) oleh Pemohon.</p>
		<div class="section_iin_file_list attach_user_file">

		</div>
		<p>Pastikan bahwa dokumen yang di unggah (upload) oleh Pemohon sudah lengkap dan benar.</p>
	</div>
	<?php echo form_open_multipart('admin_verifikasi_controller/VERIF_REVDOC_REQ_PROSES') ?>
		<input type="hidden" name="id_application_status">
		<input type="hidden" name="id_application">
		<input type="submit" name="submit_approval" hidden/>
	</form>
</section>





<section class="clearfix content-revision" style="display:none">
	<p>Masukan keterangan perbaikan dokumen yang harus di unggah oleh Pemohon</p>
	<?php echo form_open_multipart('admin_verifikasi_controller/VERIF_REVDOC_REQ_REVITION') ?>
		<input type="hidden" name="id_application_status">
		<input type="hidden" name="id_application">
		<div class="doc_rev">
			
		</div>
		<input type="submit" name="submit_revision" hidden/>
	</form>
</section>








<script>
	$.set_value_data();
	$.base_config_approval();
	value=respon.revdoc_user;
	app=respon.application;

	$("input[name=id_application_status]").val(app.id_application_status);
	$("input[name=id_application]").val(app.id_application);

	for (var i = 0; i < value.length; i++) {
		$('.attach_user_file').append('<div class="clearfix"><div>'+ (i+1) +'. '+ value[i].display_name
		 			+'</div><a href="<?php echo base_url();?>submit_iin/download?var1='+ value[i].path_id 
		 			+'" class="btn_download float_right">Download</a></div>');
	}

	for (var i = 0; i < value.length; i++) {
		$('.doc_rev').append($('<label>')
						.addClass('clearfix')
						.append($('<div>')
							.append($('<input>')
								.prop('name', 'docRef[]')
								.prop('type','checkbox')
								.val(value[i].key)))
						.append($('<span>')
							.append(value[i].display_name)));
	}
</script>

