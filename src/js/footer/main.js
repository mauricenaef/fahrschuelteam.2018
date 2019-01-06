//const test = 'Babel is doing the job. Test';
// Go Back Button
function goBack() { 
	window.history.back(); 
}

$(window).on('load', function () {
	//console.log(test);
});

// jQuery and before image loaded
( function( $ ) {
	$(document).ready(function () {
		
		let isLateralNavAnimating = false;
		let body = $('body');
		
		//open/close lateral navigation
		$('.nav-trigger').on('click', function(event){
			event.preventDefault();
			//body.addClass('loading');
			//stop if nav animation is running 
			if( !isLateralNavAnimating ) {
				if($(this).parents('.csstransitions').length > 0 ) isLateralNavAnimating = true; 
				//body.removeClass('loading');
				body.toggleClass('navigation-is-open');
				$(this).toggleClass('is-active');

				$('.navigation-wrapper').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
					//animation is over
					isLateralNavAnimating = false;
				});
			}
		});
		// Close Menu on ESC
		$(document).keyup(function(e) {
			if (e.keyCode == 27 && body.hasClass('navigation-is-open')) { 
				document.getElementsByClassName('is-active')[0].classList.remove('is-active');
				body.removeClass('navigation-is-open');
			}
		});

		// Carousel
		$('.slider').slick();

		$('.section-slider').owlCarousel({
			items:1,
			//autoHeight: true,
			dots: true,
			//nav: false,
			loop:false,
			mouseDrag: false,
			touchDrag: false,
			center:true,
			margin:0,
			URLhashListener:true,
			startPosition: 'URLHash'
		});

		// Lightbox
		if ($(".gallery, .images").length > 0) {
			$(".gallery, .images").lightGallery({
				selector: "a",
				share: false,
				thumbnail: false,
				download: false,
				controls: true,
				html: true,
				getCaptionFromTitleOrAlt: true,
				hash: false
			});
		}

		if ($(".video-player").length > 0) {
			$('.video-player').lightGallery({
				selector: "a",
				thumbnail: false,
				share: false,
				youtubePlayerParams: {
					modestbranding: 1,
					showinfo: 0,
					rel: 0,
					controls: 1
				},
				vimeoPlayerParams: {
					byline : 0,
					portrait : 0,
					color : 'A90707'
				}
			});
		}
	});
} )( jQuery );
$(window).bind('scroll',function(e){
	parallaxScroll();
});
  
function parallaxScroll(){
	let scrolled = $(window).scrollTop();
	$('#parallax-lvl-0').css('top',(0-(scrolled*.25))+'px');
	$('#parallax-lvl-1').css('top',(0-(scrolled*.5))+'px');
	$('#parallax-lvl-2').css('top',(0-(scrolled*.75))+'px');
	$('#parallax-lvl-3').css('top',(0-(scrolled*.9))+'px');
  }

