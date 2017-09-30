<article style="margin: 20px">
	<div class="clearfix content_application">
		<div class="section_list_file">
			<p>Berikut kelengkapan dokumen yang telah di unggah (upload) oleh Pemohon.</p>
			<div class="section_iin_file_list attach_user_file">
			</div>
			<p>Pastikan bahwa dokumen yang di unggah (upload) oleh Pemohon sudah lengkap dan benar.</p>
		</div>
	</div>

	<!-- COMMENT BOX -->
	<div class="slide_comment" style="display: none">
		<ul class="section_iin_download">
		<p>Masukan keterangan perbaikan dokumen yang harus di unggah oleh Pemohon</p>
			<li>1. &nbsp; <input class="input_file_rev" style="width: 70%">			</li>
			<li>2. &nbsp; <input class="input_file_rev" style="width: 70%">			<a href="" class="btn_download">Tambah</a></li>
		</ul>
		<div class="clearfix">
			<button class="btn_cancel_comment float_left" style="background: red">BATAL</button>
			<button class="btn_send float_right" style="background: #00a8cf">KIRIM</button>
		</div>
	</div>

	<!-- VERIFICATION BOX -->
	<div class="verify_section">
		<div class="clearfix">
			<button class="btn_reject float_left" style="background: red">REVISI</button>
			<button class="btn_next_step float_right" style="background: #01923f">SETUJU</button>
		</div>
	</div>
</article>

<script>
$(document).ready(function(){
	value = respJson.doc_user;
	console.log(respJson);
	$('#modal_content').slideDown();
	for (var i = 0; i < value.length; i++) {
		$('.attach_user_file').append('<div class="clearfix"><div>'+ (i+1) +'. '+ value[i].display_name +'</div><a href="'+ value[i].file_url +'" class="btn_download float_right">Download</a></div>');
	}
});
</script>
