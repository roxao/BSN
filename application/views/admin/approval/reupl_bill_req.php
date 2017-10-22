<section class="clearfix content-approval">
	<?php echo form_open_multipart('admin_verifikasi_controller/UPL_BILL_REQ_SUCCEST') ?>
		<input type="hidden" name="id_application_status">
		<input type="hidden" name="id_application">
		<div class="content-upload clearfix">
			<label class="input_dashed float_left" style="width: 100%">
				Kode Billing SIMPONI
				<input name="app_bill_code" type="text" placeholder="Masukan Kode SIMPONI"/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Masa Berlaku
				<input name="expired_date" type="text" placeholder="Masukan Masa Berlaku Kode BIlling SIMPONI"/>
			</label>
			<label class="input_dashed_file float_left" style="width: 100%">
				Kode Billing SIMPONI
				<input name="bill[]"  type="file" placeholder="Masukan Dokumen Kode Billing SIMPONI"/>
				<span>Pilih</span><i class="float_right"></i>
			</label>
			<label class="input_dashed_file float_left" style="width: 100%">
				Surat Persetujuan Proses
				<input name="bill[]"  type="file" placeholder="Masukan Surat Persetujuan Proses"/>
				<span>Pilih</span><i class="float_right"></i>
			</label>
			<label class="input_dashed_file float_left" style="width: 100%">
				Surat Permohonan PNBP
				<input name="bill[]"  type="file" placeholder="Masukan Surat Permohonan PNBP"/>
				<span>Pilih</span><i class="float_right"></i>
			</label>
		</div>
		<!-- <div onclick="add_upload()" class="btn-add-doc">Tambah Dokumen</div> -->
		<input type="submit" name="submit_approval" hidden/>
	</form>
</section>


<script>
	value=respon.application;
	$("[name=id_application_status]").val(value.id_application_status);
	$("[name=id_application]").val(value.id_application);

	$('#btn-approval').html('Proses').css('margin',"5px auto");
   	$('#btn-approval').on('click', function(event) {$('[name=submit_approval]').click()});
	$('#btn-revision').remove();
	$('#section-revision').remove();
	
</script>

