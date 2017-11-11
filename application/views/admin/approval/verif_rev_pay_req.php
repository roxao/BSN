<section class="clearfix content-approval">
	<div class="section_list_file">
		<p>Berikut kelengkapan dokumen yang telah di unggah (upload) oleh Pemohon.</p>
		<div class="section_iin_file_list attach_user_file">

		</div>
		<p>Pastikan bahwa dokumen yang di unggah (upload) oleh Pemohon sudah lengkap dan benar.</p>
	</div>

	<div id="assessment_team">
		<div style="flex:1">
			<select id="a_roles" class="a_roles" name="a_roles"></select>
		</div>
		<div style="flex:2" class="autocomplete-parent-assessment">
			<input type="text" name="assessment_list" data-key="assessment_team" placeholder="Ketik nama anggota ..." />
		</div>
	</div>

	<?php echo form_open_multipart('admin_verifikasi_controller/VERIF_REV_PAY_REQ_SUCCEST') ?>
		<input type="hidden" name="id_application_status">
		<input type="hidden" name="id_application">
		<ul id="assessment-team-list" class="assessment-team-list">
			<li class="team-header">
				<div class="x1">POSISI</div><div class="x2">NAMA ANGGOTA</div><div class="x3"></div>
			</li>
		</ul>

		<!-- TANGGAL PELAKSANAAN -->
		<label class="input_dashed float_left" style="width: 100%">
			Tanggal Pelaksanaan
			<input id="app_expired_date" name="expired_date" type="text" placeholder="Masukan Tanggal Pelaksanaan Assessment"/>
		</label>

		<!-- DOKUMEN PENDUKUNG -->
		<label class="input_dashed_file float_left" style="width: 100%">
			Dokumen
			<input name="images[]"  type="file" placeholder="Masukan Surat Persetujuan Proses"/>
			<span>Pilih</span><i class="float_right"></i>
		</label>
		<input type="submit" name="submit_approval" />
	</form>
</section>




<section class="clearfix content-revision" style="display:none">
	<p>Masukan keterangan perbaikan dokumen yang harus di unggah oleh Pemohon</p>
	<?php echo form_open_multipart('admin_verifikasi_controller/VERIF_REV_PAY_REQ_REVISI') ?>
		<input type="hidden" name="id_application_status">
		<input type="hidden" name="id_application">
		<textarea name="coment" cols="30" rows="10" class="text_comment"></textarea>
		<input type="submit" name="submit_revision" />
	</form>
</section>








<script>
	doc_pay=respon.doc_pay;
	assess_list=respon.assessment_list;
	assess_role=respon.assessment_roles;
	value=respon.application;
	$("[name=id_application_status]").val(value.id_application_status);
	$("[name=id_application]").val(value.id_application);
	for (var j = 0; j < assess_role.length; j++) {
		var select_roles = (j == 0 ? 'selected' : null );
		$('#a_roles').append($('<option>', {value: assess_role[j].id_assessment_team_title, text: assess_role[j].title}));
	}
	$("input[type=file]").change(function() {
	    var fileName = $(this).val().split('/').pop().split('\\').pop();
	    $(this).next().next().html(fileName);
	});
	$("[name=assessment_list]").autocomplete({
      	source:function(request,response){$.ajax({
				url: "<?php echo base_url('dashboard/get_autocomplete/')?>" + $('[name=assessment_list]').attr('data-key'),
				dataType: "json",
				data:{term: $("[name=assessment_list]").val()},
				success: function( data ) {response(data);}
      		});
      	},
      	minLength: 2,
      	appendTo: ".autocomplete-parent-assessment",
      	select: function( event, ui ) {
      		$('#assessment-team-list').append($('<li>').append($('<div>').addClass('x1').append($('<input>').attr('type','hidden').attr('name','assessment_title[]').attr('value',$(".a_roles option:selected").val())).append($(".a_roles option:selected").text())).append($('<div>').addClass('x2').append($('<input>').attr('type','hidden').attr('name','assessment_name[]').attr('value',ui.item.id_team)).append(ui.item.label)).append($('<div>').addClass('x3').append('Hapus')))
    	 	$('.x3').on('click',function(event){$(this).parent().remove()});
      	}
    });

	$('[name=expired_date]').datepicker().datepicker("setDate", new Date());



   	$('#btn-approval').on('click', function(event) {
   		$('[name=submit_approval]').click()
   		});
   	$('#btn-revision-back-send').on('click', function(event) {
   		$('[name=submit_revision]').click()
   		});
	$('#btn-revision').on('click', function(event) {
		$('.content-approval').hide();
		$('.content-revision').slideDown();
		$('#section-approval').hide();
		$('#section-revision').slideDown();
		});
	$('#btn-revision-back').on('click', function(event) {
		$('.content-approval').slideDown();
		$('.content-revision').hide();
		$('#section-approval').slideDown();
		$('#section-revision').hide();
		});
</script>
