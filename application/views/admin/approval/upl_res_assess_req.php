<!-- <form action="<?php echo base_url('admin_verifikasi_controller/UPL_RES_ASSESS_REQ_SUCCESS') ?>" method="post" accept-chaset="utf-8"> -->
<?php echo form_open_multipart('admin_verifikasi_controller/UPL_RES_ASSESS_REQ_SUCCESS') ?>

<section class="clearfix content_application" style="margin: 20px" >


	<label class="input_dashed_file float_left" style="width: 100%">
		Brita Acara
		<input id="app_bill_doc" name="bill[]"  type="file" placeholder="Masukan Dokumen Kode Billing SIMPONI"/>
		<span>Pilih</span><i class="float_right"></i>
	</label>
	<label class="input_dashed_file float_left" style="width: 100%">
		Hasil Assessment Lapangan
		<input id="app_agreement_process" name="bill[]"  type="file" placeholder="Masukan Surat Persetujuan Proses"/>
		<span>Pilih</span><i class="float_right"></i>
	</label>

</section>

<!-- VERIFICATION BOX -->
<div class="verify_section">
	<div class="clearfix">
		<!-- <button class="btn_reject float_left" style="background: red">REVISI</button> -->
			

		<input type="hidden" name="id_application_status" value="">
		<input type="hidden" name="id_application" value="">

		<button class="btn_send float_right" style="background: #01923f">SETUJU</button>

	
	</div>
</div>
</form>


<script>
	value=respon.application;
$("input[name=id_application_status]").val(value.id_application_status);
$("input[name=id_application]").val(value.id_application);
	
	// $('.input_dashed_file input').click(function(event) {
		$("input[type=file]").change(function() {
		    var fileName = $(this).val().split('/').pop().split('\\').pop();
		    $(this).next().next().html(fileName);
		    console.log(fileName);
		});
	// });
</script>
<!-- <script>
$(document).ready(function(){
	console.log(respJson);
	value = respJson.doc_user;
});
</script> -->
