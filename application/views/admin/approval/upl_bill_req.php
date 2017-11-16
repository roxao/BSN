<section class="clearfix content-approval">
	<?php echo form_open_multipart('admin_verifikasi_controller/UPL_BILL_REQ_SUCCEST') ?>
		<input type="hidden" name="id_application_status">
		<input type="hidden" name="id_application">
		<input type="hidden" name="created_by">
		<div class="content-upload clearfix">
			<label class="input_dashed float_left" style="width: 100%">
				Kode Billing SIMPONI
				<input name="app_bill_code" type="text" placeholder="Masukan Kode SIMPONI" required />
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Masa Berlaku
				<input name="expired_date" type="text" placeholder="Masukan Masa Berlaku Kode BIlling SIMPONI" required/>
			</label>
			<label class="input_dashed_file float_left" style="width: 100%">
				Kode Billing SIMPONI
				<input name="bill[]"  type="file" placeholder="Masukan Dokumen Kode Billing SIMPONI" required/>
				<span>Pilih</span><i class="float_right"></i>
			</label>
			<label class="input_dashed_file float_left" style="width: 100%">
				Surat Persetujuan Proses
				<input name="bill[]"  type="file" placeholder="Masukan Surat Persetujuan Proses" required/>
				<span>Pilih</span><i class="float_right"></i>
			</label>
			<label class="input_dashed_file float_left" style="width: 100%">
				Surat Permohonan PNBP
				<input name="bill[]"  type="file" placeholder="Masukan Surat Permohonan PNBP" required/>
				<span>Pilih</span><i class="float_right"></i>
			</label>
		</div>
		<!-- <div onclick="add_upload()" class="btn-add-doc">Tambah Dokumen</div> -->
		<input type="submit" name="submit_approval" />
	</form>
</section>


<script>
	$.set_value_data();
	$.base_config_approval();
	$.config_file_type();

	$('#btn-approval').html('Proses').css('margin',"5px auto");
	$('#btn-revision').remove();
	$('#section-revision').remove();
	
</script>

