<!-- <form action="<?php echo base_url('admin_verifikasi_controller/UPL_IIN_DOC_REQ_PROSES') ?>" method="post" accept-chaset="utf-8"> -->
<?php echo form_open_multipart('admin_verifikasi_controller/UPL_IIN_DOC_REQ_PROSES') ?>
<section class="clearfix content_application" style="margin: 20px" >
	<label class="input_dashed float_left" style="width: 100%">
		Nomor IIN
		<input id="iin_number" name="iin_number" type="text" placeholder="Masukan Nomor IIN"/>
	</label>
	<label class="input_dashed float_left" style="width: 100%">
		Tanggal Terbit
		<input id="iin_established_date" name="iin_established_date" type="date" placeholder="Masukan Tanggal Terbit IIN"/>
	</label>
	</label>
	<label class="input_dashed float_left" style="width: 100%">
		Tanggal Kadaluarsa
		<input id="iin_expiry_date" name="iin_expiry_date" type="date" placeholder="Masukan Tanggal Kadaluarsa"/>
	</label>
	<label class="input_dashed_file float_left" style="width: 100%">
		Dokumen IIN
		<input id="iin_doc" name="doc[]"  type="file" placeholder="Masukan Dokumen Dokumen IIN"/>
		<span>Pilih</span><i class="float_right"></i>
	</label>
	
</section>

<!-- VERIFICATION BOX -->
<div class="verify_section">
	<div class="clearfix">
		<!-- <button class="btn_reject float_left" style="background: red">REVISI</button> -->
			

		<input type="hidden" name="id_application_status" value="">
		<input type="hidden" name="id_application" value="">
		<input type="hidden" name="id_user" value="">

		<button class="btn_send float_right" style="background: #01923f">SETUJU</button>

	
	</div>
</div>
</form>


<script>
	value=respon.application;
$("input[name=id_application_status]").val(value.id_application_status);
$("input[name=id_application]").val(value.id_application);
$("input[name=id_user]").val(value.id_user);
	
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
</script>
 -->