

<section class="class_modal sheets_paper">
<div class="close_modal sp-icon-dark"></div>
<h1 class="title_modal">Verifikasi Pengajuan Permohonan</h1>
<div id="content_model">
  	<article style="margin: 20px">
		<div class="clearfix content_application">
			<div class="clearfix">
				<label class="input_dashed float_left" style="width: 65%">
					Lokasi Pengajuan Surat
					<input id="app_address" name="app_address" type="text" placeholder="Lokasi Pengajuan Surat"  disabled/>
				</label>
				<label class="input_dashed float_right" style="width: 35%">
					Tanggal Pengajuan Surat
					<input id="app_date" name="app_date"  type="date" placeholder="dd/MM/yyyy"  disabled/>
				</label>
			</div>
			<label class="input_dashed float_left" style="width: 100%">
				Nomor Surat
				<input id="app_num" name="app_num"  type="text" placeholder="Nomor Surat"  disabled/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nama Pemohon
				<input id="app_num" name="app_num"  type="text" placeholder="Nomor Surat"  disabled/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nomor Telepon Pemohon
				<input id="app_num" name="app_num"  type="text" placeholder="Nomor Surat" disabled/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nama Instansi Pemohon
				<input id="app_instance" name="app_instance" type="text" placeholder="Nama Instansi Pemohon"disabled/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				E-mail Instansi Pemohon
				<input id="app_mail" name="app_mail" type="text" placeholder="E-mail Instansi Pemohon" disabled />
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nomor Telepon Instansi Pemohon
				<input id="app_phone" name="app_phone" type="text" placeholder="Nomor Telepon Instansi Pemohon" disabled/>
			</label>
			<label class="input_dashed float_left" style="width: 100%">
				Nama Direktur Utama/Manager/Kepala Divisi Pemohon
				<input id="app_director" name="app_director" type="text" placeholder="Nama Direktur Utama/Manager/Kepala Divisi Pemohon" disabled/>
			</label>
		</div>

		<!-- COMMENT BOX -->
		<div class="slide_comment" style="display: none">
			<p>Masukan keterangan perbaikan dokumen yang harus di unggah oleh Pemohon</p>
			<textarea name="" id="" cols="30" rows="10" class="text_comment"></textarea>
			<div class="clearfix">
				<button class="btn_cancel_comment float_left" style="background: red">BATAL</button>
				<button class="btn_send float_right" style="background: #00a8cf">KIRIM</button>
			</div>
		</div>

		<!-- VERIFICATION BOX -->
		<div class="verify_section">
			<div class="clearfix">
				<button class="btn_reject float_left" style="background: red">REVISI</button>
				<button class="btn_send float_right" style="background: #01923f">SETUJU</button>
			</div>
		</div>
	</article>
</div>
</section>




<script>
	value=respJson.application;
	$('#modal_content').slideDown();
	$(".title_modal").html(respJson.title_box);
	$("input[name='app_address']").val(value.mailing_location);
    $("input[name='app_date']").val(value.application_date);
    $("input[name='app_num']").val(value.mailing_number);
    $("input[name='app_instance']").val(value.instance_name);
    $("input[name='app_mail']").val(value.instance_email);
    $("input[name='app_phone']").val(value.applicant_phone_number);
    $("input[name='app_director']").val(value.instance_director);
    setPosition('.class_modal');
    close_modal('.close_modal', '#popup_box');
    reject_function();
	// });
</script>
