
// Stop loading spinner functions - important!
window.onload = function () {
	$('.spinnerbg').hide() 
};


// Spinner Functions

$(document).ready(function(){
	
	// Setup the spinner on the screen
	function initSpinner(){
		// Get the document offset :
		var offset = $(document).scrollTop(),
		
		// Get the window viewport height & width
		viewportHeight = $(window).height(),
		viewportWidth = $(window).width();
		
			
		$('.spinnerbg').css('height', $('html').height() + 'px');
		$('.spinnerbg').css('width', $(window).width() +'px');
		
		$('#spinner').css('top', (offset  + (viewportHeight/2)) - ($('#spinner').outerHeight()/2));
		$('#spinner').css('left', ($(window).width()/2)-20+'px');
	}	
	
	$('.spinnerbg').click(function() {
		$('.spinnerbg').hide();
	});
	
	$('#spinner').click(function() {
		$('.spinnerbg').hide();
	});
	
	// Initialize the spinner on the screen
	initSpinner();
	
	
	
	$(window).resize(function() {
		$('.spinnerbg').css('height', $(document).height() + 'px');
		$('.spinnerbg').css('width', $(window).width() +'px');
		
		$('#spinner').css('top', ($(window).height()/2)-20+'px');
		$('#spinner').css('left', ($(window).width()/2)-20+'px');

	});
	
	$(window).scroll(function() {
		// Get the document offset :
		var offset = $(document).scrollTop(),
		
		// Get the window viewport height
		viewportHeight = $(window).height(),
		viewportWidth = $(window).width();
		
		// cache your dialog element
		$spinner = $('#spinner');
		
		
		// now set your dialog position
		$('#spinner').css('top', (offset  + (viewportHeight/2)) - ($('#spinner').outerHeight()/2));
		
	});
	
	// All 'a' link tags that aren't external loads 
	// spinner on the screen 
	$("a[href^='/']").click(function(){
		initSpinner();
		$('.spinnerbg').fadeIn('slow');
	});
	$("a[href^='http']").click(function(){
		initSpinner();
		$('.spinnerbg').fadeIn('slow');
	});
	$("a[href^='?clientspage']").click(function(){
		initSpinner();
		$('.spinnerbg').fadeIn('slow');
	});
	$("a[href^='?hubpage']").click(function(){
		initSpinner();
		$('.spinnerbg').fadeIn('slow');
	});
	
	// Login Actions Links
	$('.newsociallogins').click(function(){
		initSpinner();
		$('.spinnerbg').fadeIn('slow');
	});
	$('#loginform').submit(function(){
		initSpinner();
		$('.spinnerbg').fadeIn('slow');
	});
	$('#signup_form').submit(function(){
		initSpinner();
		$('.spinnerbg').fadeIn('slow');
	});
	$('.um_lostpass_form').submit(function(){
		initSpinner();
		$('.spinnerbg').fadeIn('slow');
	});
});