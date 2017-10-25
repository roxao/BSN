$(document).ready(function() {
	var base_url = $('#base_url').val();
	$('.get_process').click(function(event) {
  		if($(this).attr('data-step')!=null) get_approval($(this).attr('data-id'), $(this).attr('data-id-status'),  $(this).attr('data-step').toLowerCase(), $(this).attr('data-status'));
	  });

    $.get_approval = function (id, id_status, step, status) {
		$("body").append("<div id='modal_approval' style='display:none'></div>");
		$("#modal_approval").fadeIn('fast', function() {
			$(this).load(base_url + "/set_view/approval/modal_approval", function () {
				$(".box-modal").fadeIn('fast', function() {

					$.ajax({ url: base_url + "/get_app_data", type: "POST", data: {'id_app': id, 'id_status': id_status, 'step': step}, dataType: 'json',
				        success: function (data) {
			        		respon=data;
							$(".modal-content").load(base_url + "/set_view/approval/"+step, function () {
								$(".modal-title").html(status);
								$("#section-approval").slideDown('fast', function(){
									$.set_modal_position();
								});
								
							});
						},
						error: function(data){
							console.log(data);
						}
					})
				})
			});
		});
    }

    get_excel = function(m){
		f='';t='';
		$($('#filtertable input:checked')).each(function(){f=f+this.value+'||';t=t+this.title+'||';});
		f=f.substring(0,f.length-2);
		t=t.substring(0,t.length-2);
    	window.location.href = (base_url + "/excel?f="+f+"&t="+t+"&m="+m);
    }

	$.set_value_data = function(){
		app=respon.application;
		doc_pay=respon.doc_pay;
		assess_role=respon.assessment_roles;
		doc=respon.revdoc_user;
		$("[name=id_application_status]").val(app.id_application_status);
		$("[name=id_application]").val(app.id_application);
	}
	$.base_config_approval = function(){
		$('[type=date]').prop('type','text').datepicker().datepicker("setDate", new Date());
		$('#btn-approval').on('click', function(event) {$('[name=submit_approval]').click()});
		$('#btn-revision-back-send').on('click', function(event) {$('[name=submit_revision]').click()});
		$('#btn-revision').on('click', function(event) {
			$('.content-approval').hide();$('.content-revision').slideDown();
			$('#section-approval').hide();$('#section-revision').slideDown();
			});
		$('#btn-revision-back').on('click', function(event) {
			$('.content-approval').slideDown();$('.content-revision').hide();
			$('#section-approval').slideDown();$('#section-revision').hide();
			});
	}
	$.config_file_type = function(e){
		$("[type=file]").prop('accept','doc,docx, application/pdf, image/*');
		$("[type=file]").change(function() {
			// if(this.files[0].size > 10485760){
			if(this.files[0].size > ((10*1024)*1024)){
				alert('Maksimum file yang harus di upload adalah 10 MB');
				$(this).val('');
			}
		    var fileName = $(this).val().split('/').pop().split('\\').pop();
		    $(this).next().next().html(fileName);
		});
	}

	$.set_assessment_roles_on_select = function(){
		for (var j = 0; j < assess_role.length; j++) {
			var select_roles = (j == 0 ? 'selected' : null );
			$('#a_roles').append($('<option>', {value: assess_role[j].id_assessment_team_title, text: assess_role[j].title}));
		}
	}

	$.set_add_upload = function(){
		html  = '<div class="item-upload-v2 clearfix"><label class="input_dashed_file float_left" >';
		html +=	'Pilih Dokumen';
		html +=	'<input name="doc[]" type="file" accept=".doc,.docx,.pdf,.png,.jpg"/>';
		html +=	'<span>Pilih</span><i class="float_right"></i>';
		html +=	'</label><img fill="#fff" src="'+(base_url.replace("dashboard",""))+'/assets/delete.svg" class="img-del" alt="Hapus" height="16px" width="16px"></div>';
		$('.content-upload').append(html);
			$("[type=file]").change(function() {
		    var fileName = $(this).val().split('/').pop().split('\\').pop();
		    $(this).next().next().html(fileName);
		});
		$('.img-del').on('click', function(event) {
			$(this).parent().remove();
		});	
	}

	$.set_modal_position = function(){
		var x = $(window).width()/2 - $('.box-modal').width()/2;
		var y = $(window).height()/2 - $('.box-modal').height()/2;
		$('.box-modal').animate({ 'marginLeft': (x<0?0:x)+'px', 'marginTop': (y<0?0:y)+'px' }, 100);
	}
	$(window).on('resize', function(){$.set_modal_position()});


	// $.get_approval('18','198', 'cra_approval_req','Proses Permohonan ke CRA');
	$.get_approval('14','132', 'field_assess_req','Assessment Lapangan');
	// get_approval('8','36', 'reupl_bill_req','Reupload Billing Code SIMPONI');
	// get_approval('13','118', 'rev_assess_req','Revisi Jadwal Assessment Lapangan');
	// get_approval('7','27', 'upl_bill_req','Upload Billing Code SIMPONI');
	// get_approval('19','217', 'upl_iin_doc_req','Upload Dokumen IIN');
	// get_approval('161','5295', 'verif_new_req','Verifikasi Pengajuan Permohonan');
	// get_approval('42','528', 'verif_pay_req','Verifikasi Pembayaran');
	// get_approval('11','67', 'verif_rev_pay_req','Verifikasi Revisi Bukti Pembayaran');
	// get_approval('5','15', 'verif_revdoc_req','Verifikasi Revisi Kelengkapan Dokumen');
	// get_approval('41','218', 'verif_upldoc_req','Verifikasi Kelengkapan Dokumen');

	// BELUM ADA DATANYA DI DB
	// getApproval('42','528', 'verif_res_assess_req','');
	// getApproval('42','528', 'upl_res_assess_req','');
});
