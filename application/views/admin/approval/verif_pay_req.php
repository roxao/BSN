<article style="margin: 20px">
	<div class="clearfix content_application">
		<div class="section_list_file">
			<p>Bukti Transfer Pemohon.</p>
			<div class="section_iin_file_list attach_user_file">
			</div>
			<p>Pastikan bahwa dokumen yang di unggah (upload) oleh Pemohon sudah lengkap dan benar.</p>
		</div>
	</div>
	<div class="clearfix content_application">
		<h2>Tim Assessment Lapangan</h2>
		<div>
			<div id="assessment_autocomplete">
				<ul id="assessment_list">
					<input id="assessment_input" type="text" name="">
				</ul>
			</div>
			<select name="">
				<option value="">Ketua Tim</option>
				<option value="">Anggota</option>
			</select>
			<button type="">Masukan</button>
		</div>
		<div id="table_assessment">
			<table>
				<tr>
					<th class="sort" data-sort="id_name">Nama Anggota</th>
					<th class="sort" data-sort="id_title">Jabatan</th>
					<th></th>
				</tr>
				<tbody>
					<tr>
						<td class="id_name"><span>NR</span>Novalen Ramadhan</td>
						<td class="id_title">Ketua Tim</td>
						<td></td>
					</tr>
					<tr>
						<td class="id_name"><span>DD</span>Dicky Dharma</td>
						<td class="id_title">Ketua Tim</td>
						<td></td>
					</tr>
					<tr>
						<td class="id_name"><span>AA</span>Ahmad Andaru</td>
						<td class="id_title">Ketua Tim</td>
						<td></td>
					</tr>
				</tbody>
			</table>
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
			<button class="btn_agree_step2 float_right" style="background: #01923f">SETUJU</button>
		</div>
	</div>
</article>


<script>
	console.log(respJson);
	// assessment_list = respJson.assessment_list;
	// for (var i = 0; i < assessment_list.length; i++) {
	// 	$('#assessment_list').append('<li data-id="'+assessment_list[i].id_assessment_team+'" data-name="'+assessment_list[i].name.toUpperCase()+'" style="display:none">'+assessment_list[i].name+'</li>');
	// }
	// $('#assessment_input').focus(function(event) {
	// 	$(this).keyup(function(event) {
	// 		$('#assessment_list li').hide();
	// 		txt = $(this).val().toUpperCase();
	// 		if(txt.length > 1){
	// 			$('#assessment_list li[data-name*="'+txt+'"]').show();
	// 		}
	// 	});
	// });
	
	
</script>
