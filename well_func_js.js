    var well_preview=false;

	$(window).on("mercury:ready",function(){
		  Mercury.on('mode', function(event, options) {
			if (options.mode === 'preview') {
				if (well_preview==false) {
					$('.well_link').hide();
					well_preview=true;
				} else {
					$('.well_link').show();
					well_preview=false;
				}
			}
		  });
	});