$(document).ready(function() {
	// SET BASE URL
	var base_url = 'http://localhost/BSN/dashboard/';
	$(window).on('resize', function(){ setPosition('.class_modal')});
	$('.class_modal').on('resize', function(){setPosition('.class_modal')});

	$('.get_process').click(function(event) {
  		if($(this).attr('data-step')!=null) getStep($(this).attr('data-id'), $(this).attr('data-step').toLowerCase(), $(this).attr('data-status'));
	  });

    function getStep(id, step, status) {
    	post_data = {'getid': id,'getstep': step, 'status': status};
    	open_modal('#popup_box','.content_model');
	    $.ajax({ url: base_url + "get_app_data", type: "POST", data: post_data, dataType: 'json',
	        success: function (data) {
	        	respJson=data; setModal();
	        	$("#content_model").load(base_url + "approval/"+step, function () {
	        	});	
	        }
	    });
	};

	function setModal(){
		$('#popup_box').fadeIn();
    	setPosition('.class_modal');
    	close_modal('.close_modal', '#popup_box','.content_model');
	}
});
