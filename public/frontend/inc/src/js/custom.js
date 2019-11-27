$(document).ready(function() {
	$('.menu > li:has(div.sub-menu)').addClass('hassub');
	
	var $button = $('.top-search').clone();
  	$('.mob-search').html($button);
	
	$('#home-slider').owlCarousel({
		loop:true,
		margin:0,
		nav:true,
		dots:false,
		items:1,
		animateOut: 'slideOutDown',
    	animateIn: 'flipInX',
		smartSpeed:650,
		autoplay:true,
		autoplayTimeout:10000,
		autoplayHoverPause:true
	});
	$('#pro-slider').owlCarousel({
		loop:true,
		margin:38,
		nav:true,
		dots:false,
		smartSpeed:650,
		autoplay:true,
		autoplayTimeout:10000,
		autoplayHoverPause:true,
		responsive:{
			0:{
				items:1
			},
			768:{
				items:2
			}
		}
	});
	$('#logo-slider').owlCarousel({
		loop:true,
		margin:25,
		nav:true,
		dots:false,
		smartSpeed:650,
		autoplay:true,
		autoplayTimeout:10000,
		autoplayHoverPause:true,
		responsive:{
			0:{
				items:2
			},
			768:{
				items:3
			},
			980:{
				items:5
			},
			1200:{
				items:6
			}
			
		}
	});
	
	$('#pro_scroll').owlCarousel({
		loop:true,
		margin:25,
		nav:true,
		dots:false,
		smartSpeed:650,
		autoplay:true,
		autoplayTimeout:10000,
		autoplayHoverPause:true,
		responsive:{
			0:{
				items:1
			},
			560:{
				items:2
			},
			768:{
				items:3
			},
			1200:{
				items:4
			}
			
		}
	});
	
	$(".mobile-btn").click(function() {
        $("body").toggleClass("menu-open");
    });
	$('.menu > li.hassub > a').click(function() {
		 $(this).parent().addClass("sub-open");
    });
	$(".backmain").click(function() {
        $(this).parents(".hassub").removeClass("sub-open");
    });
	
	$(".fillter-sec > h2").click(function() {
		if($(this).parent().hasClass("active")){
			$(this).parent().removeClass("active");
			$(this).siblings(".fillter-content").slideUp(1000);
		}
		else{
			$(this).parent().addClass("active");
			$(this).siblings(".fillter-content").slideDown(1000);
		}
	});
	
	$(".fltr-btn").click(function() {
        $('body').toggleClass("fillter_open");
    });
	
	$(".bgdark").click(function() {
		$("body").removeClass("menu-open");
        $('body').removeClass("fillter_open");
    });
	
/*	$(".js-range-slider").ionRangeSlider({
        type: "double",
        min: 0,
        max: 10000,
        from: 0,
        to: 10000,
        grid: false
    });
*/	
	var bigimage = $("#big");
	var thumbs = $("#thumbs");
	//var totalslides = 10;
	var syncedSecondary = true;
	
	  bigimage
		.owlCarousel({
		items: 1,
		slideSpeed: 2000,
		nav: false,
		autoplay: false,
		dots: false,
		loop: true,
		responsiveRefreshRate: 200
	  })
		.on("changed.owl.carousel", syncPosition);
	
	  thumbs
		.on("initialized.owl.carousel", function() {
		thumbs
		  .find(".owl-item")
		  .eq(0)
		  .addClass("current");
	  })
		.owlCarousel({
		margin: 8,
		dots: false,
		nav: true,
		smartSpeed: 200,
		slideSpeed: 500,
		responsiveRefreshRate: 100,
		responsive:{
			0:{
				items:4,
				slideBy: 4
			},
			560:{
				items: 5,
				slideBy: 5
			},
			640:{
				items: 6,
				slideBy: 6
			}
		}
	  })
		.on("changed.owl.carousel", syncPosition2);
	
	  function syncPosition(el) {
		//if loop is set to false, then you have to uncomment the next line
		//var current = el.item.index;
	
		//to disable loop, comment this block
		var count = el.item.count - 1;
		var current = Math.round(el.item.index - el.item.count / 2 - 0.5);
	
		if (current < 0) {
		  current = count;
		}
		if (current > count) {
		  current = 0;
		}
		//to this
		thumbs
		  .find(".owl-item")
		  .removeClass("current")
		  .eq(current)
		  .addClass("current");
		var onscreen = thumbs.find(".owl-item.active").length - 1;
		var start = thumbs
		.find(".owl-item.active")
		.first()
		.index();
		var end = thumbs
		.find(".owl-item.active")
		.last()
		.index();
	
		if (current > end) {
		  thumbs.data("owl.carousel").to(current, 100, true);
		}
		if (current < start) {
		  thumbs.data("owl.carousel").to(current - onscreen, 100, true);
		}
	  }
	
	  function syncPosition2(el) {
		if (syncedSecondary) {
		  var number = el.item.index;
		  bigimage.data("owl.carousel").to(number, 100, true);
		}
	  }
	
	  thumbs.on("click", ".owl-item", function(e) {
		e.preventDefault();
		var number = $(this).index();
		bigimage.data("owl.carousel").to(number, 300, true);
	  });	 
	
	$(window).resize(function() {
		if($(window).width() > 991){
			$('.menu > li.hassub').mouseenter(function() {
			   $(".bgdark").show();
			});
			$('.menu > li.hassub').mouseleave(function() {
			   $(".bgdark").hide();
			});	
			$(".pro-right-top").css('min-height', $("#big").outerHeight(true));
		}
		else{
			$('.menu > li.hassub').mouseenter(function() {
			   $(".bgdark").hide();
			});
		}
    }).resize();

	/*$(".email-submit-button").on("click", function () {
		$("#emailsubscriptionform").submit();
	});*/

	$("#emailsubscriptionform").submit(function (e) {
		e.preventDefault();
		$.ajax({
			url:      $(this).attr('action'),
			type:     $(this).attr('method'),
			data:     $(this).serialize(),
			success: function(data) {
				if(data.success == true)
				{
					Swal.fire({
						position: 'middle',
						icon: 'success',
						title: data.message,
						showConfirmButton: false,
						timer: 1500
					});
				}
				else
				{
					Swal.fire({
						position: 'middle',
						icon: 'error',
						title: data.message,
						showConfirmButton: false,
						timer: 1500
					});
				}
				$(".email-submit-input").val("");
			}
		});
	});
	
});


