<section class="clearfix content_application" style="margin: 20px" >
	<div class="notes_modal">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laudantium, placeat nulla! Veniam quaerat, repellat numquam autem expedita tempore ipsa dolorum eveniet repudiandae dolorem ea alias earum facere mollitia totam.
	</div>

	<label class="input_dashed float_left" style="width: 100%">
		Kode Billing SIMPONI
		<input id="app_bill_code" name="app_bill_code" type="text" placeholder="Masukan Kode SIMPONI"/>
	</label>
	<label class="input_dashed float_left" style="width: 100%">
		Masa Berlaku
		<input id="app_expired_date" name="expired_date" type="date" placeholder="Masukan Masa Berlaku Kode BIlling SIMPONI"/>
	</label>
	<label class="input_dashed_file float_left" style="width: 100%">
		Kode Billing SIMPONI
		<input id="app_bill_doc" name="app_bill_doc"  type="file" placeholder="Masukan Dokumen Kode Billing SIMPONI"/>
		<span>Pilih</span><i class="float_right"></i>
	</label>
	<label class="input_dashed_file float_left" style="width: 100%">
		Surat Persetujuan Proses
		<input id="app_agreement_process" name="app_agreement_process"  type="file" placeholder="Masukan Surat Persetujuan Proses"/>
		<span>Pilih</span><i class="float_right"></i>
	</label>
	<label class="input_dashed_file float_left" style="width: 100%">
		Surat Permohonan PNBP
		<input id="app_pnbp" name="app_pnbp"  type="file" placeholder="Masukan Surat Permohonan PNBP"/>
		<span>Pilih</span><i class="float_right"></i>
	</label>
</section>

<!-- VERIFICATION BOX -->
<div class="verify_section">
	<div class="clearfix">
		<!-- <button class="btn_reject float_left" style="background: red">REVISI</button> -->
		<button class="btn_send float_right" style="background: #01923f">KIRIM</button>
	</div>
</div>


<script>
	value=respon.application;
	// $('.input_dashed_file input').click(function(event) {
		$("input[type=file]").change(function() {
		    var fileName = $(this).val().split('/').pop().split('\\').pop();
		    $(this).next().next().html(fileName);
		    console.log(fileName);
		});
	// });
</script>
