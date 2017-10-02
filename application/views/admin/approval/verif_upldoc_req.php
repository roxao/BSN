<section class="clearfix content_application" style="margin: 20px" >
	<div class="section_list_file">
		<p>Berikut kelengkapan dokumen yang telah di unggah (upload) oleh Pemohon.</p>
		<div class="section_iin_file_list attach_user_file">

		</div>
		<p>Pastikan bahwa dokumen yang di unggah (upload) oleh Pemohon sudah lengkap dan benar.</p>
	</div>
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
		<form action="<?php echo base_url('admin_verifikasi_controller/VERIF_UPLDOC_REQ_PROSES_SUCCEST') ?>" method="post" accept-chaset="utf-8">

		<input type="hidden" name="id_application_status" value="">
		<input type="hidden" name="id_application" value="">

		<button class="btn_send float_right" style="background: #01923f">SETUJU</button>

	</form>
	</div>
</div>


<script>
// value=respJson.application;
value=respon.doc_user;
app=respon.application;

$("input[name=id_application_status]").val(app.id_application_status);
$("input[name=id_application]").val(app.id_application);

for (var i = 0; i < value.length; i++) {
	$('.attach_user_file').append('<div class="clearfix"><div>'+ (i+1) +'. '+ value[i].display_name +'</div><a href="'+ value[i].file_url +'" class="btn_download float_right">Download</a></div>');
}
</script>
