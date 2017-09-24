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
    	console.log(post_data);
	    $.ajax({ url: base_url + "get_app_data", type: "POST", data: post_data, dataType: 'json',
	        success: function (data) {
	        	console.log(data);
	        	respJson=data; 
	        	$("#popup_box").load(base_url + "approval/"+step, function () {
	        	 setModal();
	        	});	
	        }
	    });
	};

	function setModal(){
		$('#popup_box').fadeIn();

    	setPosition('.class_modal');
    	close_modal('.close_modal', '#popup_box','.content_model');
	}


	function setPosition(t) {
		var x = $(window).width()/2 - $(t).width()/2;
		var y = $(window).height()/2 - $(t).height()/2;
		$(t).animate({ 'marginLeft': x+'px', 'marginTop': y+'px' }, 100);
	}

	function open_modal(y){
		$(y).fadeIn('fast'); 
		$(y +' > section').slideDown('fast');
	}

	function close_modal(x,y,z){
		$(x).click(function(){ 
			$(y + ">section").slideUp('fast', function() { 
				$(z).empty()
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
