$(document).ready(function() {
	// SET BASE URL
	var base_url = 'http://localhost/BSN/dashboard/';
	function setPosition(t) {
		var x = $(window).width()/2 - $(t).width()/2;
		var y = $(window).height()/2 - $(t).height()/2;
		$(t).css('margin-left', x+'px');
		$(t).css('margin-top', y+'px');
	}
	$('.btn_inbox_process').click(function(event) {
  		var target = $(this).attr('data-id');
  		var stepTarget = $(this).attr('data-step');
  		console.log(stepTarget);
  		switch(stepTarget) {
  			case '1': getStep1(target); break;
  			case '2': getStep2(target); break;
  			case '3': getStep3(target); break;
  			case '4': getStep4(target); break;
  			case '5': getStep5(target); break;
  			case '6': getStep6(target); break;
  		};	
		return false;
	  });
    
    function getStep1(id) {
    	var url = base_url + "application_crud/get_application/"+id;
    	var query = 0;
	    $.ajax({ url: url, type: "GET", data: query, dataType: 'json',
	        success: function (data) {
	        	var value = data[0];
	        	console.log(data);
	        	$("#popup_box" ).load( base_url + "view_step/step1", function () {
	        		// SET VALUE TO INPUT
					$("input[name='app_address']").val(value.mailing_location);
		            $("input[name='app_date']").val(value.application_date);
		            $("input[name='app_num']").val(value.mailing_number);
		            $("input[name='app_instance']").val(value.instance_name);
		            $("input[name='app_mail']").val(value.instance_email);
		            $("input[name='app_phone']").val(value.applicant_phone_number);
		            $("input[name='app_director']").val(value.instance_director);
		            // SET POSITION MODAL/POPUP
    	            setPosition('.class_modal');
    	            close_modal('.close_modal', '#popup_box', '#modal_content');
	        	});
	        }
	    });
	};

	function getStep2(id) {
		var url = base_url + "application_crud/get_application";
	    $.ajax({ url: url, type: "GET", data: 0, dataType: 'json',
	        success: function (data) {
	        	var value = data[0];
	        	console.log(data);
	        	$("#popup_box").slideDown('slow', function () {
		        	$("#popup_box" ).load( base_url + "view_step/step2", function () {
		        		// SET VALUE TO INPUT
		        		for (var i = Things.length - 1; i >= 0; i--) {
		        			$('.attach_user_file').html('<li>1. Lampiran 1 (kode: F.PKS.8.0.1)			<a href="" class="btn_download">Download</a></li>');
		        		}
		        		
			            // SET POSITION MODAL/POPUP
	    	            setPosition('.class_modal');
	    	            close_modal('.close_modal', '#popup_box', '#modal_content');
		        	});
	        	});
	        }
	    });
	};
	function getStep3(id) {
		console.log('INI STEP 2');
	};
	function getStep4(id) {
		console.log('INI STEP 2');
	};
	function getStep5(id) {
		console.log('INI STEP 2');
	};
	function getStep6(id) {
		console.log('INI STEP 2');
	};

	function close_modal(x,y,z){
		$(x).click(function(){
			$(y).fadeOut('slow');
			$(z).children('section').slideUp('slow', function() {
			   $(y).empty()
			});
    	});
	}
});
