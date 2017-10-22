<section class="clearfix content-approval">
	<p class="p-desc">Silakan unggah dokumen penugasan Tim Assessment:</p>
	<?php echo form_open_multipart('admin_verifikasi_controller/CRA_APPROVAL_REQ_PROSES') ?>
		<input type="hidden" name="id_application_status">
		<input type="hidden" name="id_application">
		<div class="content-upload clearfix"></div>
		<input type="submit" name="submit_approval" hidden/>
	</form>
</section>


<script>
	doc=respon.revdoc_user;
	value=respon.application;
	$("[name=id_application_status]").val(value.id_application_status);
	$("[name=id_application]").val(value.id_application);

	add_upload();
	function add_upload(){
		html  = '<div class="item-upload-v2 clearfix"><label class="input_dashed_file float_left" >';
		html +=	'Pilih Dokumen';
		html +=	'<input name="doc[]" type="file" accept=".doc,.docx,.pdf,.png,.jpg"/>';
		html +=	'<span>Pilih</span><i class="float_right"></i>';
		html +=	'</label><img fill="#fff" src="<?php echo base_url('assets/delete.svg')?>" class="img-del" alt="Hapus" height="16px" width="16px"></div>';
		$('.content-upload').append(html);
			$("[type=file]").change(function() {
		    var fileName = $(this).val().split('/').pop().split('\\').pop();
		    $(this).next().next().html(fileName);
		    console.log(fileName);
		});
		$('.img-del').on('click', function(event) {
			$(this).parent().remove();
		});	
	}

	$('#btn-approval').html('Unggah Dokumen').css('margin',"5px auto");
   	$('#btn-approval').on('click', function(event) {$('[name=submit_approval]').click()});
	$('#btn-revision').remove();
	$('#section-revision').remove();
	
</script>
<style>
	.item-upload-v2>label{
		padding-right: 10px !important
	}
</style>
