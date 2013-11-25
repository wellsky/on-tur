	$(window).load(function() {
		$('#slider').nivoSlider({
			//controlNavThumbs:true,
			//controlNavThumbsFromRel:true
		});
		
		$('#logo').mousemove(function(pos) {
			$('#logo').css('background-position',((pos.pageX/10)-100)+'px '+((pos.pageY/10)-100)+'px');
		});

		$('.footermove').mousemove(function(e) {
			var offset = $(this).offset();
			var relativeX = (e.pageX - offset.left);
			$('.footermove').css('background-position',((relativeX/50)-10)+'px 0px');
		});		
		
		$('.footermove1').mousemove(function(e) {
			var offset = $(this).offset();
			var relativeX = (e.pageX - offset.left);
			$('.footermove1').css('background-position',((relativeX/10)-100)+'px 0px');
		});		

		$('.footermove2').mousemove(function(e) {
			var offset = $(this).offset();
			var relativeX = (e.pageX - offset.left);
			$('.footermove2').css('background-position',((relativeX/5)-100)+'px 0px');
		});		

		$('.showcase').mousemove(function(e) {
			var offset = $(this).offset();
			var relativeX = (e.pageX - offset.left);
			var relativeY = (e.pageY - offset.top);			
			
			$(this).css('background-position',((relativeX/10)-30)+'px '+((relativeY/10)-30)+'px');
		});

		
		$('a.online').click(function(e){
				e.preventDefault();
				$.arcticmodal({
					type: 'ajax',
					url: 'ajax_online.php'
				});
		});

		$('a.onlinethis').click(function(e){
				e.preventDefault();
				$.arcticmodal({
					type: 'ajax',
					url: 'ajax_online.php?tour='+$(this).attr("value")
				});
		});
	});