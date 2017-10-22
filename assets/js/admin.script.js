$(document).ready(function() {
	var base_url = $('#base_url').val();
	$('.get_process').click(function(event) {
  		if($(this).attr('data-step')!=null) getStep($(this).attr('data-id'), $(this).attr('data-id-status'),  $(this).attr('data-step').toLowerCase(), $(this).attr('data-status'));
	  });

	function getStep(id, id_status, step, status) {
    	$("#popup_box").load(base_url + "/set_view/component/modal", function () {
    		setModal();
    		console.log(id);
	   	 	$.ajax({ url: base_url + "/get_app_data", type: "POST", data: {'id_app': id, 'id_status': id_status, 'step': step}, dataType: 'json',
		        success: function (data) {
	        		respon=data;
	        		console.log(data);
					$("#content_modal").load(base_url + "/set_view/approval/"+step, function () {
						$(".title_modal").html(status);
						$(this).slideDown('400',function(){setContentModal()});
					 	reject_function();
					 	setModal();
					});
				},
				error: function(data){ alert("fail");}
			});
	   	 })
    }

    function getApproval(id, id_status, step, status) {
		$("body").append("<div id='modal_approval'></div>");
		$("#modal_approval").load(base_url + "/set_view/approval/modal_approval", function () {
			$.ajax({ url: base_url + "/get_app_data", type: "POST", data: {'id_app': id, 'id_status': id_status, 'step': step}, dataType: 'json',
		        success: function (data) {
	        		respon=data;
					$(".modal-content").load(base_url + "/set_view/approval/"+step, function () {
						$(".modal-title").html(status);
						$("#section-approval").slideDown('fast');
						$(this).slideDown('400',function(){setContentModal()});
					});
				},
				error: function(data){
					console.log(data);
				}
			})
		});
    }

	getApproval('42','528', 'verif_pay_req','Verifikasi Pembayaran');
	// getApproval('15','571', 'upl_iin_doc_req','Upload Dokumen IIN');
    // Modal Customize
	function setModal(){
		$('#popup_box').fadeIn('400',function(){});
		$('.close_modal').click(function(event) {
			$('.box_modal').slideUp('slow', function(){
				$('#popup_box').fadeOut('slow', function() {
					$('#popup_box').html('');
				});('');
			});
		});
	}
	function setContentModal(){ 
		$('#content_modal').height(($('.box_modal').height() - 50));
	}
	function setModalPosition(){
		$('#popup_box').fadeIn('400',function(){setContentModal()});
	}

	function setPosition(t) {
		var x = $(window).width()/2 - $(t).width()/2;
		var y = $(window).height()/2 - $(t).height()/2;
		$(t).animate({ 'marginLeft': x+'px', 'marginTop': y+'px' }, 100);
	}

	function close_modal(x,y){
		$(x).click(function(){ 
			$(y + ">section").slideUp('fast', function() { 
				$(y).empty()
			});
			$(y).fadeOut(); 
		});
	}

	function reject_function(){
		$('.btn_reject').click(function(){ 
			$('.content_application').slideUp();
			$('.verify_section').slideUp();
			$('.slide_comment').slideDown('400', function() {
				setPosition('.class_modal')
			});
		});
		$('.btn_cancel_comment').click(function(){ 
			$('.content_application').slideDown();
			$('.verify_section').slideDown();
			$('.slide_comment').slideUp('400', function() {
				setPosition('.class_modal')
			});
		});
	}
});
