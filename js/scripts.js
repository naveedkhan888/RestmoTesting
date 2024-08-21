( function( $ ) {
	'use strict';
	
	/* rtl check */
	function rtl_owl(){
	if ($('body').hasClass("rtl")) {
		return true;
	} else {
		return false;
	}};

	/* Check rtl isotop*/
    function rtl_isotop() {
        if ( $( 'body' ).hasClass( 'rtl' ) ) {
           return false;
        } else {
           return true;
        }
    };

	/* --------------------------------------------------
    * preloader
    * --------------------------------------------------*/
	if ( $('#royal_preloader').length ) {
		var $selector       = $('#royal_preloader'),
			$width          = $selector.data('width'),
			$height         = $selector.data('height'),
			$color          = $selector.data('color'),
			$bgcolor        = $selector.data('bgcolor'),
			$logourl        = $selector.data('url');
		
		Royal_Preloader.config({
			mode           : 'logo',
			logo           : $logourl,
			logo_size      : [$width, $height],
			showProgress   : true,
			showPercentage : true,
			text_colour: $color,
			background:  $bgcolor,
		});        
	};

    /* --------------------------------------------------
    * sticky header
    * --------------------------------------------------*/
	$('.header-static .is-fixed').parent().append('<div class="header-clone"></div>');
	$('.header-clone').height($('#site-header .is-fixed').outerHeight());
	$('.header-static .header-clone').hide();	
	$(window).on("scroll", function(){
		var site_header = $('#site-header').outerHeight() + 1;	
			
		if ($(window).scrollTop() >= site_header) {	    	
			$('.site-header .is-fixed').addClass('is-stuck');	
			$('.header-static .header-clone').show();	
		}else {
			$('.site-header .is-fixed').removeClass('is-stuck');		              
			$('.header-static .header-clone').hide();
		}
	});

    /* --------------------------------------------------
    * mobile menu
    * --------------------------------------------------*/
    $('.mmenu_wrapper li:has(ul)').prepend('<span class="arrow"><i class="xp-flaticon-signs-1"></i></span>');
    $(".mmenu_wrapper .mobile_mainmenu > li span.arrow").on('click',function() {
        $(this).parent().find("> ul").stop(true, true).slideToggle()
        $(this).toggleClass( "active" ); 
    });
	
	$( "#mmenu_toggle" ).on('click', function() {
		$(this).toggleClass( "active" );
		$(this).parents('.header_mobile').toggleClass( "open" );
		if ($(this).hasClass( "active" )) {
			$('.mobile_nav').stop(true, true).slideDown(100);
		}else{
			$('.mobile_nav').stop(true, true).slideUp(100);
		}		
	});

	/* --------------------------------------------------
    * gallery post
    * --------------------------------------------------*/
	$('.gallery-post').each( function () {
		var selector = $(this);
		selector.owlCarousel({
			rtl: rtl_owl(),
			autoplay:true,
			autoplayTimeout: 6000,
			loop:true,
			margin:0,
			responsiveClass:true,
			items:1,
			dots:true,
			nav:false,
			navText:['<i class="xp-flaticon-left-arrow-2"></i>', '<i class="xp-flaticon-arrowsoutline"></i>']
		});
	});

	/* --------------------------------------------------
    * popup video
    * --------------------------------------------------*/
  	var video_popup = $('.video-popup');
   	if (video_popup.length > 0 ) {
	   	video_popup.each( function(){
		   	$(this).lightGallery({
			   selector: '.btn-play',
		   	});
	   	});
	};

	/* --------------------------------------------------
    * filter projects
    * --------------------------------------------------*/
	function updateFilter() {
		$('.project_filters a').each(function() {
			var data_filter = this.getAttribute('data-filter');
			var num = $(this)
				.closest('.project-filter-wrapper')
				.find('.project-item')
				.filter(data_filter).length;
			$(this)
				.find('.filter-count')
				.text( num );
			if ( num != 0 && $(this).hasClass('empty') ) {
				$(this).removeClass('empty');
			}
		});
	}
	$('.project-filter-wrapper').each( function(){
		var $container = $(this).find('.projects-grid'); 
		$container.isotope({ 
			itemSelector : '.project-item', 
			animationEngine : 'css',
			masonry: {
				columnWidth: '.grid-sizer'
			},
		});

		var $optionSets  = $(this).find('.project_filters'),
			$optionLinks = $optionSets.find('a');

		$optionLinks.on('click', function(){
			var $this = $(this);

			if ( $this.hasClass('selected') ) {
				return false;
			}
			var $optionSet = $this.parents('.project_filters');
				$optionSet.find('.selected').removeClass('selected');
				$this.addClass('selected');

			var selector = $(this).attr('data-filter');
				$container.isotope({ 
					filter: selector 
				});
			return false;
		});
		/* count filters */
		updateFilter();
	});

	/* load more button */    
	$('#btn-loadmore').on('click',function(){
		var btn		= $(this),
			grid    = $(this).parents('.project-filter-wrapper').find('.projects-grid'),
			offset  = grid.find('.project-item').length,
			more    = grid.data('load'),
			loaded  = $(this).data('loaded'),
			loading = $(this).data('loading'),
			cat 	= $(this).data('category'),
			count   = grid.data('count');
		$.ajax({
			url : restimo_loadmore_params.ajaxurl, // AJAX handler
			data : {
				'action': 'loadmore', // the parameter for admin-ajax.php
				'ppp'	: more,
				'cat'	: cat,
				'offset': offset,
			},
			type : 'POST',
			beforeSend : function ( xhr ) {
				btn.text(loading).append('<i class="xp-flaticon-refresh fas fa-spin"></i>'); // some type of preloader
			},
			success : function( data ){
				if( data ) {
					var items = $(data);
					btn.text(loaded);
					grid.append(items).isotope('appended', items); // insert new posts
					updateFilter();
				} else {
					btn.hide(); // if no data, HIDE the button as well
				}
			}
		});
		offset += more;
		if( count <= offset ){
			btn.fadeOut(1000);
		}
		return false;
	});

	/* --------------------------------------------------
    * related projects
    * --------------------------------------------------*/
	$('.portfolio-related-posts').each( function () {
		var selector = $(this).find('.owl-carousel');
		selector.owlCarousel({
			rtl: rtl_owl(),
			autoplay:false,
			responsiveClass:true,
			dots:true,
			nav:false,
			navText:['<i class="xp-flaticon-left-arrow-2"></i>', '<i class="xp-flaticon-arrowsoutline"></i>'],
			responsive : {
				0 : {
					margin:0,
					items:1,
				},
				600 : {
					margin:15,
					items:2,
				},
				768 : {
					margin:30,
					items:2,
				},
				1024 : {
					margin:30,
					items:3,
				}
			}
		});
	});

	/* --------------------------------------------------
	* switcher
	* --------------------------------------------------*/
	var swt = $('.xp-switcher').find('.switch input');
	$('.restimo_block_hidden').hide();
	swt.on( 'change', function() {
		var parent = $(this).parents('.e-parent');
		if(this.checked) {
			parent.find('.r-switch').addClass('active');
			parent.find('.l-switch').removeClass('active');
			parent.find('.restimo_block_show').hide();
			parent.find('.restimo_block_hidden').show();
		}else{
			parent.find('.l-switch').addClass('active');
			parent.find('.r-switch').removeClass('active');
			parent.find('.restimo_block_hidden').hide();
			parent.find('.restimo_block_show').show();
		}
	});

	/* --------------------------------------------------
    * big tabs
    * --------------------------------------------------*/
	$('.tab-titles .title-item a').on( 'click', function(){
		$('.tab-active').removeClass('tab-active');
		$(this).addClass('tab-active');
		$('.content-tab').hide();
		$($(this).attr('href')).show();

		return false;
	});
	$('.tab-titles .title-item:first a').trigger('click');

	/* --------------------------------------------------
    * Post Grid Isotop
    * --------------------------------------------------*/
    $(window).load( function () {
        if( $('.blog-grid').length > 0 ){
            var container = $('.blog-grid'); 
            container.isotope({ 
                itemSelector : '.masonry-post-item',
                isOriginLeft: rtl_isotop(),
                percentPosition: true,
            });
        };
    });

    /* --------------------------------------------------
    * back to top
    * --------------------------------------------------*/
    if ($('#back-to-top').length) {
	    var scrollTrigger = 500, // px
	        backToTop = function () {
	            var scrollTop = $(window).scrollTop();
	            if (scrollTop > scrollTrigger) {
	                $('#back-to-top').addClass('show');
	            } else {
	                $('#back-to-top').removeClass('show');
	            }
	        };
	    backToTop();
	    $(window).on('scroll', function () {
	        backToTop();
	    });
	    $('#back-to-top').on('click', function (e) {
	        e.preventDefault();
	        $('html,body').animate({
	            scrollTop: 0
	        }, 700);
	    });	
	}

	/*
	* Footer fixed
	*/
	var bumpIt = function () {
        if ($(window).width() > 1024) {
            $(".footer-fixed .site-content").css("margin-bottom", parseInt($(".footer-fixed .site-footer").height()));
        } else {
            $(".footer-fixed .site-content").css("margin-bottom", 0);
        }
    },
    didResize = false;
    setInterval(function () {
        bumpIt();
    }, 250);
    $(window).resize(function () {
        didResize = true;
    });
    setInterval(function () {
        if (didResize) {
            didResize = false;
            bumpIt();
        }
    }, 250);

} )( jQuery );
