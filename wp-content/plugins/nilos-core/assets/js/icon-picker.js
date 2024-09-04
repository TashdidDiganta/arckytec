(function ($) {
  "use strict";
	
	$(document).ready(function() {
		
		$(document).on('click', 'input.arcicon-picker', function(event){
			event.preventDefault(); 
			$(this).closest('.arc-field-iconfield').find('.arc-iconsholder-wrapper').slideToggle();
		});
		
		
		$(document).on('click', '.arc-iconbox', function(event){	
			$(this).closest('.arc-field-iconfield').find('input.arcicon-picker').val($(this).find('i').attr('class'));
			$(this).closest('.arc-field-iconfield').find('.arc-iconsholder-wrapper').slideToggle();
		});
		
		
		var arcicon = 'icon-success icon-standard-pricing icon-service-architecture icon-spacey-unsplashed icon-service-exterior-design icon-service-concept-design icon-service-design-planning icon-service-interior-decor',
			
		arciconArray = arcicon.split(' '); // creating array

		// This loop will add icons inside BOX
		for (var i = 0; i < arciconArray.length; i++) {
			jQuery(".arc-iconsholder").append('<div class="arc-iconbox"><p class="icon"><i class="' + arciconArray[i] + '"></i></p></div>');
		}

		var timeout;
		$("input.iconsearch").on("keyup", function() {
			if(timeout) {
				clearTimeout(timeout);
			}
			
			var value = this.value.toLowerCase().trim();
			var iconbox = $(this).closest('.arc-field-iconfield').find('.arc-iconbox');
			timeout = setTimeout(function() {
			  $(iconbox).show().filter(function() {
				return $(this).text().toLowerCase().trim().indexOf(value) == -1;
			  }).hide();
			}, 500);
		});

	});

})(jQuery);
