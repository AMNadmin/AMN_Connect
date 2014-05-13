/*=========================================================================	
	Fetch Project Status Progress % data and display on Client Dashboard 	-	[ CLIETNT ]
========================================================================*/ 
function fetch_project_status( theURL ){
	$.ajax({
		url: theURL,
		type: 'GET',
		success: function(data) {
			var $progressNum = $(data).find('#project_discussion');
			var progress = $progressNum.data('progress'),
				progress = progress + '%';
				
			  $('#progress-status span').text(progress); 
		}
	});
}

/*=========================================================================	
	 Fetch Invoice Balance data and display on Client Dashboard 			-	[ CLIETNT ]
==========================================================================*/ 
function fetch_invoice_balance( theURL ){
  	$.ajax({
		url: theURL,
		type: 'GET',
		success: function(data) {
			var $balances = $(data).find('#account-balance'),
				$invoice_form = $(data).find('#online_payment_form-wpi_paypal'),
				$invoice_button = $(data).find('#cc_pay_button'),
				$balancesHTML= $balances.text();
				
				
				$invoice_form_hiddens = $(data).find('input[type=hidden]'),
				$invoice_form_action = $(data).find('#online_payment_form-wpi_paypal').attr('action'),
				
			invoice_total = $balances.val();
			$('#current-balance').text($balances.text());
			$('.account-balance').text($balances.text());
			
		}
	});
}
function invoice_overview( theURL ) {
	$.ajax({
		url: theURL,
		type: 'GET',
		success: function(data) {
			var $invoice_description = $(data).find('.invoice_description'),
				$wpi_checkout_form_wrapper = $(data).find('#wpi_checkout_form_wrapper'),
				$invoice_table = $(data).find('#invoice_table'),
				$wpi_checkout = $(data).find('.wpi_checkout'),
				$online_payment_form_wrapper = $(data).find('#online_payment_form_wrapper'),
				$wpi_gateway_form_errors = $(data).find('#wpi_gateway_form_errors'),
				$script_tags = $(data).find('script');
				
			//$('#wpi_checkout_form_wrapper').append($script_tags);
			//$('#online_payment_form_wrapper').html($online_payment_form_wrapper.html());
			$('#invoice-overview-portlet-body .ajax-place-loader').fadeOut();
			$('#invoice_description').html($invoice_description.html());
			$('#wpi_checkout_form_wrapper').html($wpi_checkout_form_wrapper.html());
			$('#wpi_checkout_form_wrapper').append($wpi_gateway_form_errors);
		},
		error: function() { 
			$('#invoice-overview-portlet-body .ajax-place-loader').fadeOut(); 
		}
	});
}
function account_summary_overview( theURL ) {
	$.ajax({
		url: theURL,
		type: 'GET',
		success: function(data) {
			var $subtotal = $(data).find('#subtotal'),
				$adjustments = $(data).find('#adjustments'),
				$account_balance = $(data).find('#account-balance');
			var payments_made = '';
			$('#account-summary-overview').fadeIn();
			$('#invoice-total').html('');
			$('#payments-made').html('');
			$('#statement-balance').html('');
			
			$('#invoice-total').html($subtotal.html());
				if($adjustments.html() == null){ 
					payments_made = '0'; 
					$('#payments-made').html(payments_made);
				}
				else {
					$('#payments-made').html($adjustments.html());
				}
			$('#statement-balance').html($account_balance.html());
		},
		error: function() { 
			$('#account-summary-overview').hide(); 
		}
	});
}

function show_invoice_page( theURL ) {
	$.ajax({
		url: theURL,
		type: 'GET',
		success: function(data) {
			var $content_view_panel = $(data).find('#invoice_page');
			
			$('#invoice-view-panel .ajax-place-loader').fadeOut();
			$('#invoice-view-panel').html($content_view_panel.html());
			$('#online_payment_form_wrapper_btn').fadeIn();
		}
	});
}

/*=========================================================================	
	Fetch Support Ticket data Messaging and display on Client Dashboard 		-	[ CLIETNT ]
===========================================================================*/ 
function fetch_support_ticket_system( theURL ){
	$.ajax({
		url: theURL,
		type: 'GET',
		success: function(data) {
			var $tickets = $(data).find('#wpscst_edit_div table'),
				$panel = $(data).find('#support-ticket-system-panel');
				
				$('#create-ticket-pane').html($panel.html());
			  	$('#wpscst_edit_ticket').hide();
				$('.wpscst-table').hide();
		}
	});
}

/*=========================================================================	
	User Questionnaire Functions
 ========================================================================*/ 
function amn_questionnaires() {

		$('#insert_user').removeClass('btn-primary');
		$('#insert_user').addClass('btn-success');
		$('#submit').css('margin-top', '20px');
		
		$('#um_page_segment_6 .btn-primary:eq(0)').after($('#insert_user'));
		$('#um_page_segment_6 div input#insert_user').remove();
		
		$('#tab_6_1').append($('#um_page_segment_1'));
		$('#tab_6_2').append($('#um_page_segment_2'));
		$('#tab_6_3').append($('#um_page_segment_3'));
		$('#tab_6_4').append($('#um_page_segment_4'));
		$('#tab_6_5').append($('#um_page_segment_5'));
		$('#tab_6_6').append($('#um_page_segment_6'));
		$('#tab_6_7').append($('#um_page_segment_7'));
		$('#tab_6_8').append($('#um_page_segment_8'));
		$('#tab_6_9').append($('#um_page_segment_9'));
		$('#um_page_segment_1').show();
		$('#um_page_segment_1 .btn-primary').val('Event Brand Design');
		$('#um_page_segment_2').show();
		$('#um_page_segment_2 .btn-primary:eq(0)').val('Brand Design');
		$('#um_page_segment_2 .btn-primary:eq(1)').val('Graphic Design');
		$('#um_page_segment_3').show();
		$('#um_page_segment_3 .btn-primary:eq(0)').val('Event Brand Design');
		$('#um_page_segment_3 .btn-primary:eq(1)').val('Web Design + Development');
		$('#um_page_segment_4').show();
		$('#um_page_segment_4 .btn-primary:eq(0)').val('Graphic Design');
		$('#um_page_segment_4 .btn-primary:eq(1)').val('Social Media Marketing');
		$('#um_page_segment_5').show();
		$('#um_page_segment_5 .btn-primary:eq(0)').val('Web Design + Development');
		$('#um_page_segment_5 .btn-primary:eq(1)').val('Finish and Submit');
		$('#um_page_segment_6').show();
		
		$('#um_page_segment_6 .btn-primary:eq(0)').val('Social Media Marketing');
		
		
		// Brandmark Design Nav
		$('#um_page_segment_1 .btn-primary').click(function(){
  			$('#questionnaires-nav-tabs li:eq(2) a').tab('show');
		});
		
		// Event Branding Design Nav
		$('#um_page_segment_2 .btn-primary:eq(0)').click(function(){
  			$('#questionnaires-nav-tabs li:eq(1) a').tab('show');
		});
		$('#um_page_segment_2 .btn-primary:eq(1)').click(function(){
  			$('#questionnaires-nav-tabs li:eq(3) a').tab('show');
		});
		
		// Graphic Design Nav
		$('#um_page_segment_3 .btn-primary:eq(0)').click(function(){
  			$('#questionnaires-nav-tabs li:eq(2) a').tab('show');
		});
		$('#um_page_segment_3 .btn-primary:eq(1)').click(function(){
  			$('#questionnaires-nav-tabs li:eq(4) a').tab('show');
		});
		
		// Web Design Nav
		$('#um_page_segment_4 .btn-primary:eq(0)').click(function(){
  			$('#questionnaires-nav-tabs li:eq(3) a').tab('show');
		});
		$('#um_page_segment_4 .btn-primary:eq(1)').click(function(){
  			$('#questionnaires-nav-tabs li:eq(5) a').tab('show');
		});
		
		
		// Social Media Management Nav
		$('#um_page_segment_5 .btn-primary:eq(0)').click(function(){
  			$('#questionnaires-nav-tabs li:eq(4) a').tab('show');
		});
		$('#um_page_segment_5 .btn-primary:eq(1)').click(function(){
  			$('#questionnaires-nav-tabs li:eq(6) a').tab('show');
		});
		
		// Form Submit Nav
		$('#um_page_segment_6 .btn-primary').click(function(){
  			$('#questionnaires-nav-tabs li:eq(5) a').tab('show');
		});
}

/*=========================================================================	
	CLIENT Messaging Functions
 ========================================================================*/ 
 
	$('.comment_image_delete').hide();
	
	$('#comment_image').change(function(){
		var uploadedImageName = $(this).val().split('\\').pop(),
			comID = $(this).data('commentpostid');
		if($(this).val() != ''){ 
			$('#comment_image_name span.alert').text(uploadedImageName);
			$('#current_comment_image').text(uploadedImageName);
			$('#comment_image_name span.alert').attr('title', uploadedImageName);
			$('#current_comment_image').attr('title', uploadedImageName);
			$('#comment_image_name img').show( );
			$('#comment_image_delete').show();
			$('#comment_image_name span.alert').hide();
			$('#current_comment_image').fadeIn();
		}
	});
	$('#comment_image_delete').click(function(){
		var comID = $(this).data('commentpostid');
		if($('#comment_image').val() != ''){ 
			$('#comment_image').val('');
			$('#comment_image_name span.alert').hide();
			$('#comment_image_name span.alert').text('');
			$('#current_comment_image').hide();
			$('#current_comment_image').text('');
			$(this).fadeOut();
		}
	});
	$('#picture-save-btn').click(function(){ 
		var comID = $(this).data('commentpostid'),
			uploadedImageName = $("#comment_image").val().split('\\').pop();
		if($('#comment_image').val() != ''){ 
			$('#comment_image_name img').fadeOut();
			$('#comment_image_name span').text(uploadedImageName);
			$('#comment_image_name span').attr('title', uploadedImageName);
			$('#comment_image_name span').fadeIn();
			$('#comment_image_delete').fadeIn();
		}
		else {
			alert('No image to save. Please upload an image for your message.');
			return false;
		}
	});
	$('#picture-delete-btn').click(function(){
		var comID = $(this).data('commentpostid');
		if($('#comment_image').val() != ''){ 
			$('#comment_image').val('');
			$('#comment_image_name span.alert').hide();
			$('#comment_image_name span.alert').text('');
			$('#current_comment_image').fadeOut();
			$('#current_comment_image').text('');
			$('#comment_image_delete').fadeOut();
			$('#comment_image_name img').fadeOut();
		} 
		else {
			alert('No image to delete. Please upload an image for your message.');
		}
	});
	$('#reply_comment_image').click(function(){
		var uploadedImageName = $(this).val().split('\\').pop(),
			comID = $(this).data('commentid');
			if($(this).val() != ''){ 
				$('#reply_comment_image_name span.alert').text(uploadedImageName);
				$('#reply_comment_image_name span.alert').attr('title', uploadedImageName);
				$('#reply_comment_image_name span.alert').fadeIn();
			}
	});
	$("#picture-cancel-btn").click(function(){ 
		var comID = $(this).data('commentpostid'),
			uploadedImageName = $("#comment_image").val().split('\\').pop();
		if($('#comment_image').val() != ''){ 
			$('#comment_image_name img').fadeOut();
			$('#comment_image_name span').text(uploadedImageName);
			$('#comment_image_name span').attr('title', uploadedImageName);
			$('#comment_image_name span').fadeIn();
			$('#comment_image_delete').fadeIn();
		}
		else {
			$('#comment_image').val('');
			$('#comment_image_name span.alert').hide();
			$('#comment_image_name span.alert').text('');
			$('#current_comment_image').fadeOut();
			$('#current_comment_image').text('');
			$('#comment_image_delete').fadeOut();
			$('#comment_image_name img').fadeOut();
		}
	});
	
	$('.comment-form').each(function(){
		var $wrap = $(this),
			$reloader = $(this).find('.reload');
			$reloader.click(function(){
				setTimeout(function () {
					$wrap.find('.wrapper').refresh();
				}, 0);	
			});
	});
	
	// Comment / Messaging Form Validation Check
	$('#client-discussion-form').submit(function(){
		var formkey = $(this).find('.formkey').val(),
			comment_image = $('body').find('#comment_image').val(),
			comment_field = $('body').find('#comment_content').val();
		
		if(comment_field == ''){
			alert('Please enter a message.');
			return false;
		}
		else if(comment_field == '' && comment_image == '') {
			alert('Please enter a message or upload an image.');
			return false;
		}
		else {
			$('.spinnerbg').show();
		}
	});
	$('.discussion-form').each(function(){
		var $discuss_form = $(this),
			$comment_image = $discuss_form.find('.comment_image'),
			$comment_post_ID_select = $discuss_form.find('.comment_project_id');
		
		$comment_image.change(function(){
			if($(this).val() != ''){ 
			var uploadedImageName = $comment_image.val().split('\\').pop();
				$discuss_form.find('#selected_image').text(uploadedImageName);
				$discuss_form.find('#selected_image').fadeIn();
			}
		});
		$comment_post_ID_select.change(function(){
			var selected = $comment_post_ID_select.children('option:selected').val();
			if(selected != ''){
				$comment_image.attr('name', 'comment_image_' + selected);
			}
		});
		$(this).submit(function(){
		var	comment_field = $(this).find('.comment_content').val(),
			comment_image_field = $(this).find('.comment_image').val();
			if($comment_post_ID_select.children('option:selected').val() == ''){
				alert('Please choose a project thread.');
				return false;
			}
			else if(comment_field == ''){
				alert('Please enter a message.');
				return false;
			}
			else if(comment_field == '' && comment_image_field == '') {
				alert('Please enter a message or upload an image.');
				return false;
			}
			else {
				$('.spinnerbg').show();
			}
		});
		
	});
	$('#comment_post_ID_select').change(function(){
		
	});
	
	$('.delete-comment-form').submit(function(){
		$('.spinnerbg').show();
	});
	$('#login-submit').click(function(){
		$('.spinnerbg').show();
	});
	
/*=========================================================================	
	Comment Messaging Functions
 ========================================================================*/ 
function AMN_messaging_control() {
	
	/*$('.comment_image').change(function(){
		var uploadedImageName = $(this).val().split('\\').pop(),
			comID = $(this).data('commentpostid');
		if($(this).val() != ''){ 
			$('#comment_image_name_' + comID +' span.label').text(uploadedImageName);
			$('#current_comment_image_' + comID).text(uploadedImageName);
			$('#comment_image_name_' + comID + ' span.label').attr('title', uploadedImageName);
			$('#current_comment_image_' + comID).attr('title', uploadedImageName);
			$('#comment_image_name_' + comID + ' img').show( );
			$('#comment_image_delete_' + comID).show();
			$('#comment_image_name_' + comID + ' span.label').hide();
			$('#current_comment_image_' + comID).fadeIn();
		}
	});*/
	
	/*$('.reply_comment_image').click(function(){
		var uploadedImageName = $(this).val().split('\\').pop(),
			comID = $(this).data('commentid');
			if($(this).val() != ''){ 
				$('#reply_comment_image_name_' + comID +' span.label').text(uploadedImageName);
				$('#reply_comment_image_name_' + comID + ' span.label').attr('title', uploadedImageName);
				$('#reply_comment_image_name_' + comID + ' span.label').fadeIn();
			}
		
	});*/
	/*
	$('.comment_image_delete').click(function(){
		var comID = $(this).data('commentpostid');
		if($('#comment_image_' + comID).val() != ''){ 
			$('#comment_image_' + comID).val('');
			$('#comment_image_name_' + comID +' span.label').hide();
			$('#comment_image_name_' + comID +' span.label').text('');
			$('#current_comment_image_' + comID).hide();
			$('#current_comment_image_' + comID).text('');
			$(this).fadeOut();
		}
	});*/
	/*
	$('.picture-delete-btn').click(function(){
		var comID = $(this).data('commentpostid');
		if($('#comment_image_' + comID).val() != ''){ 
			$('#comment_image_' + comID).val('');
			$('#comment_image_name_' + comID +' span.label').hide();
			$('#comment_image_name_' + comID +' span.label').text('');
			$('#current_comment_image_' + comID).fadeOut();
			$('#current_comment_image_' + comID).text('');
			$('#comment_image_delete_' + comID).fadeOut();
			$('#comment_image_name_' + comID + ' img').fadeOut();
		} 
		else {
			alert('No image to delete. Please upload an image for your message.');
		}
	});
	*/
	/*$('.picture-save-btn').click(function(){ 
		var comID = $(this).data('commentpostid'),
			uploadedImageName = $("#comment_image_" + comID).val().split('\\').pop();
		if($('#comment_image_' + comID).val() != ''){ 
			$('#comment_image_name_' + comID +' img').fadeOut();
			$('#comment_image_name_' + comID +' span').text(uploadedImageName);
			$('#comment_image_name_' + comID +' span').attr('title', uploadedImageName);
			$('#comment_image_name_' + comID +' span').fadeIn();
			$('#comment_image_delete_' + comID).fadeIn();
		}
		else {
			alert('No image to save. Please upload an image for your message.');
			return false;
		}
	});*/
	
	
	
	/*$('.new-comment-image-modal').each(function(){
		var $modal	= $(this),
			$save_btn = $(this).find('.picture-save-btn'),
			$comment_image = $(this).find('.comment_image');
		var comID = $(this).find('.comment_image').data('commentpostid');
			$save_btn.click(function(){
				if($comment_image.val() == ''){
					alert('No image to save. Please upload an image for your message.');
					return false;
				}
				else {
					$('#comment_image_name_' + comID +' img').fadeOut();
					$('#comment_image_name_' + comID +' span').text(uploadedImageName);
					$('#comment_image_name_' + comID +' span').attr('title', uploadedImageName);
					$('#comment_image_name_' + comID +' span').fadeIn();
					$('#comment_image_delete_' + comID).fadeIn();
				}
			});
	});*/
	
	/*$(".picture-cancel-btn").click(function(){ 
		var comID = $(this).data('commentpostid'),
			uploadedImageName = $("#comment_image_" + comID).val().split('\\').pop();
		if($('#comment_image_' + comID).val() != ''){ 
			$('#comment_image_name_' + comID +' img').fadeOut();
			$('#comment_image_name_' + comID +' span').text(uploadedImageName);
			$('#comment_image_name_' + comID +' span').attr('title', uploadedImageName);
			$('#comment_image_name_' + comID +' span').fadeIn();
			$('#comment_image_delete_' + comID).fadeIn();
		}
		else {
			$('#comment_image_' + comID).val('');
			$('#comment_image_name_' + comID +' span.label').hide();
			$('#comment_image_name_' + comID +' span.label').text('');
			$('#current_comment_image_' + comID).fadeOut();
			$('#current_comment_image_' + comID).text('');
			$('#comment_image_delete_' + comID).fadeOut();
			$('#comment_image_name_' + comID + ' img').fadeOut();
		}
	});*/
	
	
	// Comment / Messaging Form Validation Check
	/*$('.comment-form').submit(function(){
		var formkey = $(this).find('.formkey').val(),
			comment_field = $('body').find('#comment_image_' + formkey).val(),
			comment_image = $('body').find('#comment_content_' + formkey).val();
			
		if(comment_field == '' && comment_image == '') {
			alert('Please enter a message or upload an image.');
			return false;
		}
		else {
			$('.spinnerbg').show();
		}
	});*/
}

	$('.replyto-cancel-btn').click(function(){
		var formkey = $(this).data('commentid');
			$('#comment_image_' + formkey).val('');
	});
	$('#mobile-thread-wrapper a.thread-toggler').click(function(){
		var margin_left = $('#mobile-thread-wrapper').css("margin-left");
		if (margin_left == "-250px") {
			$('#mobile-thread-wrapper').animate({marginLeft: "0px"});
		} else {
			$('#mobile-thread-wrapper').animate({marginLeft: "-250px"});
		}
		return false;
	});

	$('#all-overview-tab').click(function(){
		setTimeout(function () {
			dashboardWrapper_scroll.refresh();
		}, 0);
	});
	
	$('#all-discussions-tab').click(function(){
		setTimeout(function () {
			discussionsWrapper_scroll.refresh();
		}, 0);
	});
	$('#make-payment-btn').click(function(){
		$('#all-invoice-tab').tab('show');
		$('#all-invoice-tab').addClass('active');
	});
	$('.all-projects-btn').click(function(){
		$('#all-projects-tab').tab('show');
		$('#all-projects-tab').addClass('active');
		$('#mobile-bottom-nav ul li').removeClass('active');
		$('#mobile-bottom-nav ul li:nth-child(5)').addClass('active');
	});
	
	$('#project-discussions-tab').click(function(){
		$('#tab_1_3').tab('show');
		$('#tab_1_3').addClass('active');
		setTimeout(function(){
			messagingWrapper_scroll.refresh();
		}, 0);
	});
	$('.mobile-bottom-nav ul li').click(function(){
		$('.mobile-bottom-nav ul li').removeClass('active');
		$(this).addClass('active');	
	});
	$('.mobile-bottom-nav ul li:nth-child(3)').click(function(){
		setTimeout(function () {
			discussionsWrapper_scroll.refresh();
		}, 0);
	});
	$('#all-discussions-mobile-tab').click(function(){
		setTimeout(function(){
			discussionsWrapper_scroll.refresh();
		}, 0);
	});
	$('#all-messages-tab').click(function(){
		setTimeout(function(){
			recentActivityWrapper_scroll.refresh();
		}, 0);
	});
	
	
	$('input').focus(function(){
		$('#mobile-bottom-nav').hide();
	});
	$('input').blur(function(){
		$('#mobile-bottom-nav').show();
	});
	
	// Admin Project Navigation
	$('#project-nav').change(function(){
		var path = $('#project-nav option:selected').val();
		$('.spinnerbg').fadeIn('slow');
		window.location = path;	
	});

	$(window).scroll(function() {
		var offset = $(document).scrollTop();
		  if(offset >= 120){
			  $('#discussion-form-wrapper').addClass('fixed');
			  $('#discussion-form-wrapper').focus(function(){
				  $(this).css('opacity', '0.7');
			  });
			  $('#discussion-form-wrapper').blur(function(){
				  $(this).css('opacity', '1');
			  });
		  }
		  else {
			  $('#discussion-form-wrapper').removeClass('fixed');
		  }
	});

	