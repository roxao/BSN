<section class="clearfix content_application" style="margin: 20px" >
	<div class="section_list_file">
		<p>Berikut kelengkapan dokumen yang telah di unggah (upload) oleh Pemohon.</p>
		<div class="section_iin_file_list attach_user_file">

		</div>
		<p>Pastikan bahwa dokumen yang di unggah (upload) oleh Pemohon sudah lengkap dan benar.</p>
	</div>
<?php echo form_open_multipart('admin_verifikasi_controller/VERIF_PAY_REQ_SUCCEST');?>
	
		<input type="hidden" name="id_application_status" value="">
		<input type="hidden" name="id_application" value="">
		<div id="table_assessment" style=" margin: 20px -20px 0 -20px">
			<div class="clearfix">
				<div class="custom_autocomplete assessment_autocomplete float_left">
					<input class="input_autocomplete assess_ac_text" type="text" placeholder="Ketik Nama Anggota" />
					<ul class="ul_autocomplete assessment_list"></ul>
					<select id="a_roles" class="a_roles" name="a_roles">
					</select>
				</div>
				<div class="btn_submit_assess">Submit</div>
			</div>
			

	      <table class="table_def table_assessment" style="width: 100%;">
	        <tr>
	          <th class="sort" data-sort="id_no"><center>#</center></th>
	          <th class="sort" data-sort="id_name">Nama Anggota</th>
	          <th class="sort" data-sort="id_roles">Jabatan</th>
	          <th></th>
	        </tr>
	        <tbody class="list data-assessment">
	            
	        </tbody>
	      </table>
	    </div>
		
	    <div style="margin-top: 20px">
	    	<label class="input_dashed float_left" style="width: 100%">
				Tanggal Pelaksanaan
				<input id="app_expired_date" name="expired_date" type="date" placeholder="Masukan Masa Berlaku Kode BIlling SIMPONI"/>
			</label>
			<div class="multiple_upload">
				<label class="input_dashed_file float_left" style="width: 100%">
					Dokumen
					<input id="images[]" name="images[]" type="file"/>
					<span>Pilih</span><i class="float_right"></i>
				</label>
			</div>
	    </div>
	    <button class="form-send" style="display: none">SEND</button>
    </form>
</section>

<!-- COMMENT BOX -->
<section class="slide_comment" style="display: none">
	<p>Masukan keterangan perbaikan Bukti Transfer</p>
	<button class="btn_cancel_comment float_left" style="background: red">BATAL</button>
	<div class="clearfix">
		
		<form action="<?php echo base_url('admin_verifikasi_controller/VERIF_PAY_REQ_REVISI') ?>" method="post" accept-chaset="utf-8">

		<textarea name="coment" id="coment" cols="30" rows="10" class="text_comment"></textarea>
		
		<input type="hidden" name="id_application_status" value="">
		<input type="hidden" name="id_application" value="">
		

		<button class="btn_send float_right" style="background: #00a8cf">KIRIM</button>
		</form>
	</div>
</section>


<!-- VERIFICATION BOX -->
<div class="verify_section">
	<div class="clearfix">
		<button class="btn_reject float_left" style="background: red">REVISI</button>
		<button class="btn_send float_right" style="background: #01923f">SETUJU</button>
	</div>
</div>


<tr class="tmp_assessment">
	<td></td>
	<td><input type="text" id="a_name" name="a_name[]" value="a_name_id" disabled/></td>
	<td><input type="text" id="a_role" name="a_role[]" value="a_role_id" disabled/></td>
	<td></td>
</tr>



<script>
	doc_pay=respon.doc_pay;
	assess_list=respon.assessment_list;
	assess_role=respon.assessment_roles;
	value=respon.application;
	$("input[name='id_application_status']").val(value.id_application_status);
	$("input[name='id_application']").val(value.id_application);

	for (var i = 0; i < doc_pay.length; i++) {
		$('.attach_user_file').append('<div class="clearfix"><div>'+ (i+1) +'. '+ doc_pay[i].display_name +'</div><a href="'+ doc_pay[i].file_url +'" class="btn_download float_right">Download</a></div>');
	}
	console.log(assess_role.length);
	for (var j = 0; j < assess_role.length; j++) {
		var select_roles = (j == 0 ? 'selected' : null );
		$('#a_roles').append($('<option>', {value: assess_role[j].id_assessment_team_title, text: assess_role[j].title}));

	}
	$('.btn_submit_assess').on('click', function(event){
		var attr = $('.input_autocomplete').attr('data-id');
		console.log(attr);
		if (attr != undefined && attr !== false) {
			$(".data-assessment").append($('<tr>')
									.append($('<td>'))
								    .append($('<td>')
								        .append($('<input>')
								        	.attr('type', 'hidden')
								        	.attr('name', 'a_names[]')
								            .attr('value', $('.input_autocomplete').attr('data-id'))
								            )
								        .append($('.input_autocomplete').val()))
								    .append($('<td>')
								    	.append($('<input>')
								    		.attr('type', 'hidden')
								        	.attr('name', 'a_roles[]')
								            .attr('value', $( ".a_roles option:selected" ).val())
								            )
								        .append($( ".a_roles option:selected" ).text()))
								    .append($('<td>')
								    	.append('<button class="del-row-table">DEL</button>')
								    	)
								);
			$('.input_autocomplete').val('');
			$('.input_autocomplete').attr('data-id', '');
			$('.del-row-table').click(function(event) {
				$(this).parent().parent().remove();
			});
		}
		
	})

	$('.btn_send').click(function(event) {
		$('.form-send').click();
	});


	$('.assess_ac_text').keyup(function(event) {
		key = $(this).val();
		$('.assessment_list').empty();
		if(key.length > 1){
			for (var i = 0; i < assess_list.length; i++) {
				$('.assessment_list').slideDown()
				if(assess_list[i].name.toLowerCase().indexOf(key.toLowerCase()) !== -1){
					$('.assessment_list').append('<li data-id="'+assess_list[i].id_assessment_team+'" data-name="'+assess_list[i].name+'">'+assess_list[i].name+'</li>');
				}
			}
			$('.custom_autocomplete li').click(function(event) {
				$(this).parent().parent().children('.input_autocomplete').val($(this).attr('data-name'));
				$(this).parent().parent().children('.input_autocomplete').attr('data-id', $(this).attr('data-id'));
				$('.ul_autocomplete').slideUp();
			});
		}
	});

	$('.custom_autocomplete li').click(function(event) {
		$(this).parent().parent().children('input').val($(this).attr('data-name'));
		$('.ul_autocomplete').slideUp();
	});

	$("input[type=file]").change(function() {
	    var fileName = $(this).val().split('/').pop().split('\\').pop();
	    $(this).next().next().html(fileName);
	});

	$('document').ready(function(){
      var options = {valueNames: [ 'id_no', 'id_name', 'id_pt', 'id_type', 'id_date' ]};
      var inboxList = new List('table_assessment', options);
    });
</script>
