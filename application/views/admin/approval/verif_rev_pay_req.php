<section class="clearfix content_application" style="margin: 20px" >
	<div class="section_list_file">
		<p>Berikut kelengkapan dokumen yang telah di unggah (upload) oleh Pemohon.</p>
		<div class="section_iin_file_list attach_user_file">

		</div>
		<p>Pastikan bahwa dokumen yang di unggah (upload) oleh Pemohon sudah lengkap dan benar.</p>
	</div>

	<div id="table_assessment" style=" margin: 20px -20px 0 -20px">
		<div class="clearfix">
			<div class="custom_autocomplete assessment_autocomplete float_left">
				<input class="input_autocomplete assess_ac_text" type="text" placeholder="Ketik Nama Anggota" />
				<ul class="ul_autocomplete assessment_list"></ul>
				<select name="">
					<option value="">Ketua Tim</option>
					<option value="">Anggota Tim</option>
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
        <tbody class="list">
            <tr>
              <td class="id_no">ab</td>
              <td class="id_name">a</td>
              <td class="id_roles">a</td>
              <td></td>
            </tr>
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
				<input id="" name="" type="file"/>
				<span>Pilih</span><i class="float_right"></i>
			</label>
		</div>
    </div>
</section>


<!-- VERIFICATION BOX -->
<div class="verify_section">
	<div class="clearfix">
<form action="<?php echo base_url('admin_verifikasi_controller/VERIF_PAY_REQ_REVISI') ?>" method="post" accept-chaset="utf-8">

		<button class="btn_reject float_left" style="background: red">REVISI</button>
</form>
		<form action="<?php echo base_url('admin_verifikasi_controller/VERIF_PAY_REQ_SUCCEST') ?>" method="post" accept-chaset="utf-8">
		<button class="btn_send float_right" style="background: #01923f">SETUJU</button>
		</form>
	</div>
</div>


<script>



	doc_pay=respon.doc_pay;
	assess_list=respon.assessment_list;
	console.log(respon);
	for (var i = 0; i < doc_pay.length; i++) {
		$('.attach_user_file').append('<div class="clearfix"><div>'+ (i+1) +'. '+ doc_pay[i].display_name +'</div><a href="'+ doc_pay[i].file_url +'" class="btn_download float_right">Download</a></div>');
	}

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
				$('.ul_autocomplete').slideUp();
			});
		}
	});

	$('.input_roles').click(function(event) {
		console.log("alksjdlkajskld");
		$('.roles_list').slideDown();
	});
	$('.assess_roles input').click(function(event) {
		$(this).next().slideDown();
	});
	$('.custom_autocomplete li').click(function(event) {
		$(this).parent().parent().children('input').val($(this).attr('data-name'));
		$('.ul_autocomplete').slideUp();
	});

	$("input[type=file]").change(function() {
	    var fileName = $(this).val().split('/').pop().split('\\').pop();
	    $(this).next().next().html(fileName);
	    console.log(fileName);
	});

	$('document').ready(function(){
      var options = {valueNames: [ 'id_no', 'id_name', 'id_pt', 'id_type', 'id_date' ]};
      var inboxList = new List('table_assessment', options);
    });
</script>
