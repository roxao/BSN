<!-- <form action="<?php echo base_url('admin_verifikasi_controller/CRA_APPROVAL_REQ_PROSES') ?>" method="post" accept-chaset="utf-8"> -->
<?php echo form_open_multipart('admin_verifikasi_controller/CRA_APPROVAL_REQ_PROSES') ?>
<section class="clearfix content_application" style="margin: 20px" >
	<div class="section_list_file">
		<p>Berikut kelengkapan dokumen yang telah di unggah (upload) oleh Pemohon.</p>
		<div class="attach_user_file">
			
		</div>
		<p>Pastikan bahwa dokumen yang di unggah (upload) oleh Pemohon sudah lengkap dan benar.</p>
	</div>
</section>





<!-- VERIFICATION BOX -->
<div class="verify_section">
	<div class="clearfix">
		

		<input type="hidden" name="id_application_status" value="">
		<input type="hidden" name="id_application" value="">
		<button class="btn_send float_right" style="background: #01923f">SETUJU</button>
		</form>
	</div>
</div>


<script>
// value=respJson.application;
value=respon.revdoc_user;
app=respon.application;

$("input[name=id_application_status]").val(app.id_application_status);
$("input[name=id_application]").val(app.id_application);

for (var i = 0; i < value.length; i++) {
	$('.attach_user_file').append('<div><label><input name="doc[]" type="file" id="id_admin" value="'+value[i].id_document_config+'" />'+value[i].display_name+'</label></div>');
}


// $("input[type=file]").change(function() {
// 	    var fileName = $(this).val().split('/').pop().split('\\').pop();
// 	    $(this).next().html(fileName);
// 		$(this).parent().prev().prop('checked',(fileName.length>1?true:false));
// 	});
</script>


<!-- <script>
$(document).ready(function(){
	console.log(respJson);
	value = respJson.doc_user;
});
</script>
 -->