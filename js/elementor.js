( function( $ ) {
    'use strict';

    /* rtl check */
	function rtl_owl(){
    if ($('body').hasClass("rtl")) {
        return true;
    } else {
        return false;
    }};

    function rtl_isotop(){
        if ($('body').hasClass("rtl")) {
            return false;
        } else {
            return true;
    }};

    /* --------------------------------------------------
    * accordions
    * --------------------------------------------------*/
    var customAccordions = function ($scope, $) {
        $scope.find('.xp-accordions').each( function () {
            var selector = $(this),
                content = selector.find('.acc-content'),
                header  = selector.find('.acc-toggle');

            header.off("click");

            header.each(function(){
                if ($(this).data('default') == 'yes') {
                    $(this).next().addClass('active').slideDown(300);
                    $(this).parent().addClass('current');
                }
            });

            header.on('click', function(e){
                e.preventDefault();
                var $this = $(this);

                $this.next().toggleClass('active').slideToggle(300);
                $this.parent().toggleClass('current');
                content.not($this.next()).slideUp(300);
                header.not($this).parent().removeClass('current');
            });
        });
    };

    /* --------------------------------------------------
    * tabs
    * --------------------------------------------------*/
    var customTabs = function ($scope, $) {

        $scope.find('.xp-tabs').each(function() {
            var selector = $(this),
                tabs     = selector.find('.tabs-heading li'),
                content  = selector.find('.tab-content');
            tabs.first().addClass('current');
            content.first().addClass('current');

            tabs.on( 'click', function(){
                var tab_id = $(this).attr('data-tab');
                $(this).siblings().removeClass('current');
                $(this).parents('.xp-tabs').find('.tab-content').removeClass('current');
                $(this).addClass('current');
                $("#"+tab_id).addClass('current');
            });
        });
    };

    /* --------------------------------------------------
     * counter
     * --------------------------------------------------*/
    var iCounter = function () {
        $('.icounter[data-counter]').each( function () {
            var scrollTop   = $(document).scrollTop() + $(window).height();
            var counter     = $(this).find('span.num'),
                countTo     = counter.attr('data-to'),
                during      = parseInt( counter.attr('data-time') );

            if ( scrollTop > counter.offset().top + counter.height() ) {
                $(this).removeAttr('data-counter');
                $({
                    countNum: counter.text()
                }).animate({
                    countNum: countTo
                },
                {
                    duration: during,
                    easing: 'swing',
                    step: function() {
                        counter.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        counter.text(this.countNum);
                    }
                });
            }
        });
    };

    /* --------------------------------------------------
    * coming soon
    * --------------------------------------------------*/
    var countDown = function($scope, $){
        $scope.find('.xp-countdown').each( function(){
            var selector = $(this),
                date     = selector.data('date'),
                zone     = selector.data('zone'),
                day      = selector.data('day'),
                days     = selector.data('days'),
                hour     = selector.data('hour'),
                hours    = selector.data('hours'),
                min      = selector.data('min'),
                mins     = selector.data('mins'),
                second   = selector.data('second'),
                seconds  = selector.data('seconds');
            selector.countdown({
                date: date,
                offset: zone,
                day: day,
                days: days,
                hour: hour,
                hours: hours,
                minute: min,
                minutes: mins,
                second: second,
                seconds: seconds
            }, function () {
                alert('Done!');
            });
        });
    };

    /* --------------------------------------------------
     * client logos
     * --------------------------------------------------*/
    var clientLogos = function ($scope, $) {
        $scope.find('.logos-carousel').each( function () {
            var $this     = $(this),
                $loop     = $this.data('loop'),
                $auto     = $this.data('auto'),
                $time     = $this.data('time'),
                $dots     = $this.data('dots'),
                $nav      = $this.data('arrows'),
                $items    = $this.data('show') ? $this.data('show') : 2,
                $titems   = $this.data('tshow') ? $this.data('tshow') : 2,
                $mitems   = $this.data('mshow') ? $this.data('mshow') : 2,
                $gaps     = $this.data('gaps') !== '' ? $this.data('gaps') : 70,
                $tgaps    = $this.data('tgaps') !== '' ? $this.data('tgaps') : 50,
                $mgaps    = $this.data('mgaps') !== '' ? $this.data('mgaps') : 30,
                $selector = $this.find('.owl-carousel');
            $selector.owlCarousel({
                rtl: rtl_owl(),
                autoplay:$auto,
                autoplayTimeout: $time,
                loop:$loop,
                responsiveClass:true,
                dots:$dots,
                nav:$nav,
                navText:['<i class="xp-flaticon-left-arrow-2"></i>', '<i class="xp-flaticon-trajectory"></i>'],
                responsive : {
                    0 : {
                        margin:$mgaps,
                        items:$mitems,
                    },
                    768 : {
                        margin:$tgaps,
                        items:$titems,
                    },
                    1024 : {
                        margin:$gaps,
                        items:$items,
                    }
                }
            });
        });
    };

    /* --------------------------------------------------
     * testimonials carousel
     * --------------------------------------------------*/
    var testiCarousel = function ($scope, $) {
        $scope.find('.xp-testimonials-carousel').each( function () {
            var $this     = $(this),
                $loop     = $this.data('loop'),
                $auto     = $this.data('auto'),
                $time     = $this.data('time'),
                $dots     = $this.data('dots'),
                $nav      = $this.data('arrows'),
                $items    = $this.data('show') ? $this.data('show') : 3,
                $titems   = $this.data('tshow') ? $this.data('tshow') : 2,
                $mitems   = $this.data('mshow') ? $this.data('mshow') : 1,
                $selector = $this.find('.owl-carousel');
            $selector.owlCarousel({
                rtl: rtl_owl(),
                autoplay:$auto,
                autoplayTimeout: $time,
                loop:$loop,
                responsiveClass:true,
                margin:30,
                dots:$dots,
                nav:$nav,
                navText:['<i class="xp-flaticon-left-arrow-2"></i>', '<i class="xp-flaticon-trajectory"></i>'],
                responsive : {
                    0 : {
                        items:$mitems,
                    },
                    768 : {
                        items:$titems,
                    },
                    1024 : {
                        items:$items,
                    }
                }
            });
        });
    };

    /* --------------------------------------------------
     * testimonials carousel 2
     * --------------------------------------------------*/
    var testiCarousel2 = function ($scope, $) {
        $scope.find('.xp-testimonials-carousel-2').each( function () {
            var $this     = $(this),
                $loop     = $this.data('loop'),
                $auto     = $this.data('auto'),
                $time     = $this.data('time'),
                $dots     = $this.data('dots'),
                $nav      = $this.data('arrows'),
                $selector = $this.find('.owl-carousel');
            $selector.owlCarousel({
                rtl: rtl_owl(),
                autoplay:$auto,
                autoplayTimeout: $time,
                loop:$loop,
                responsiveClass:true,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                margin:30,
                items:1,
                dots:$dots,
                nav:$nav,
                navText:['<i class="xp-flaticon-left-arrow-2"></i>', '<i class="xp-flaticon-trajectory"></i>'],
            });
        });
    };

    /* --------------------------------------------------
     * progress bar
     * --------------------------------------------------*/
    function lineProgress() {
        $('.line-progress:not([data-processed])').each(function() {
            var bar = $(this),
                line = bar.find(".progress-bar"),
                progressEnd = bar.data('percent'),
                percent = bar.find('.percent');
            var scrollTop = $(document).scrollTop() + $(window).height();

            if ( scrollTop >  bar.offset().top +  bar.height() ) {
                bar.attr("data-processed", "true");
                line.css("width", (bar.outerWidth() * (progressEnd / 100)) + "px");

                for (var i = 0; i <= 50; i++) {
                    (function (count) {
                        setTimeout(function () {
                            percent.html(Math.round((progressEnd / 50) * count) + "%");
                        }, 30 * count);
                    })(i);
                }
            }
        });
    };

    /* line progress */
    function lineProgressSize() {
        $('.line-progress[data-processed]').each(function () {
            var bar = $(this);
            var line = bar.find(".progress-bar");
            var progressEnd = parseInt(bar.data('percent'));

            line.css("width", (bar.outerWidth() * (progressEnd / 100)) + "px");
        
        });
    }

    /* circle progress */
    function circleProgress() {
        $('.circle-progress:not([data-processed])').each(function() {
            var circle    = $(this),
                bar_color = circle.data('color'),
                bar_hei   = circle.data('height'),
                bar_size  = circle.data('size');
            var scrollTop = $(document).scrollTop() + $(window).height();
            if ( scrollTop >  circle.offset().top +  circle.height() ) {
                circle.attr("data-processed", "true");
                circle.find('.inner-bar').easyPieChart({
                    barColor: bar_color,
                    trackColor: false,
                    scaleColor: false,
                    lineCap: 'square',
                    lineWidth: bar_hei,
                    size: bar_size,
                    animate: 1000,
                    onStart: $.noop,
                    onStop: $.noop,
                    easing: 'easeOutBounce',
                    onStep: function(from, to, percent) {
                        $(this.el).find('.percent').text(Math.round(percent) + '%');
                    }
                });
            }
        });
    };
    
    var progressBar = function () {
        lineProgress();
        circleProgress();
    };

    /* --------------------------------------------------
	* projects filter isotope
	* --------------------------------------------------*/
         
    var projectsFilter = function () {
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
            });
        }
        $('.projects-grid').each( function(){
            var $container = $(this); 
            $container.imagesLoaded(function(){
                $container.isotope({ 
                    itemSelector : '.project-item', 
                    animationEngine : 'css',
                    masonry: {
                        columnWidth: '.grid-sizer'
                    },
                    isOriginLeft: rtl_isotop(),
                });
            });
    
            var $optionSets  = $(this).closest('.project-filter-wrapper').find('.project_filters'),
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
            /* popup gallery */
            if( $container.hasClass('img-popup') ){
                $('.img-popup').lightGallery({
                    selector: '.projects-thumbnail',
                    share: false,
                    pager: false,
                    thumbnail: false
                });
            }
            /* count filters */
            updateFilter();
        });
    };

    /* --------------------------------------------------
    * projects carousel
    * --------------------------------------------------*/
    var projectsCarousel = function ($scope, $) {
        $scope.find('.project-slider').each( function () {
            var $this     = $(this),
                $loop     = $this.data('loop'),
                $auto     = $this.data('auto'),
                $time     = $this.data('time'),
                $center   = $this.data('center'),
                $dots     = $this.data('dots'),
                $nav      = $this.data('arrows'),
                $items    = $this.data('show') ? $this.data('show') : 2,
                $titems   = $this.data('tshow') ? $this.data('tshow') : 2,
                $mitems   = $this.data('mshow') ? $this.data('mshow') : 2,
                $gaps     = $this.data('gaps') !== '' ? $this.data('gaps') : 60,
                $tgaps    = $this.data('tgaps') !== '' ? $this.data('tgaps') : 40,
                $mgaps    = $this.data('mgaps') !== '' ? $this.data('mgaps') : 20,
                $selector = $this.find('.owl-carousel');
            $selector.owlCarousel({
                rtl: rtl_owl(),
                autoplay:$auto,
                autoplayTimeout: $time,
                center:$center,
                loop:$loop,
                responsiveClass:true,
                dots:$dots,
                nav:$nav,
                navText:['<i class="xp-flaticon-left-arrow-2"></i>', '<i class="xp-flaticon-trajectory"></i>'],
                responsive : {
                    0 : {
                        margin:$mgaps,
                        items:$mitems,
                    },
                    768 : {
                        margin:$tgaps,
                        items:$titems,
                    },
                    1024 : {
                        margin:$gaps,
                        items:$items,
                    }
                }
            });
        });
    };

    /* --------------------------------------------------
    * posts carousel
    * --------------------------------------------------*/
    var postCarousel = function ($scope, $) {
        $scope.find('.post-slider').each( function () {
            var $this     = $(this),
                $loop     = $this.data('loop'),
                $auto     = $this.data('auto'),
                $time     = $this.data('time'),
                $dots     = $this.data('dots'),
                $nav      = $this.data('arrows'),
                $items    = $this.data('show') ? $this.data('show') : 3,
                $titems   = $this.data('tshow') ? $this.data('tshow') : 2,
                $mitems   = $this.data('mshow') ? $this.data('mshow') : 1,
                $gaps     = $this.data('gaps') !== '' ? $this.data('gaps') : 30,
                $tgaps    = $this.data('tgaps') !== '' ? $this.data('tgaps') : 30,
                $mgaps    = $this.data('mgaps') !== '' ? $this.data('mgaps') : 30,
                $selector = $this.find('.owl-carousel');
            $selector.owlCarousel({
                rtl: rtl_owl(),
                autoplay:$auto,
                autoplayTimeout: $time,
                loop:$loop,
                responsiveClass:true,
                dots:$dots,
                nav:$nav,
                navText:['<i class="xp-flaticon-left-arrow-2"></i>', '<i class="xp-flaticon-trajectory"></i>'],
                responsive : {
                    0 : {
                        margin:$mgaps,
                        items:$mitems,
                    },
                    768 : {
                        margin:$tgaps,
                        items:$titems,
                    },
                    1024 : {
                        margin:$gaps,
                        items:$items,
                    }
                }
            });
        });
    };

    /* --------------------------------------------------
    * team carousel
    * --------------------------------------------------*/
    var teamCarousel = function ($scope, $) {
        $scope.find('.xp-team-carousel').each( function () {
            var $this     = $(this),
                $loop     = $this.data('loop'),
                $auto     = $this.data('auto'),
                $time     = $this.data('time'),
                $dots     = $this.data('dots'),
                $nav      = $this.data('arrows'),
                $items    = $this.data('show') ? $this.data('show') : 3,
                $titems   = $this.data('tshow') ? $this.data('tshow') : 2,
                $mitems   = $this.data('mshow') ? $this.data('mshow') : 1,
                $gaps     = $this.data('gaps') !== '' ? $this.data('gaps') : 30,
                $tgaps    = $this.data('tgaps') !== '' ? $this.data('tgaps') : 30,
                $mgaps    = $this.data('mgaps') !== '' ? $this.data('mgaps') : 30,
                $selector = $this.find('.owl-carousel');
            $selector.owlCarousel({
                rtl: rtl_owl(),
                autoplay:$auto,
                autoplayTimeout: $time,
                loop:$loop,
                responsiveClass:true,
                dots:$dots,
                nav:$nav,
                navText:['<i class="xp-flaticon-left-arrow-2"></i>', '<i class="xp-flaticon-trajectory"></i>'],
                responsive : {
                    0 : {
                        margin:$mgaps,
                        items:$mitems,
                    },
                    768 : {
                        margin:$tgaps,
                        items:$titems,
                    },
                    1024 : {
                        margin:$gaps,
                        items:$items,
                    }
                }
            });
        });
    };

    /* --------------------------------------------------
    * image box carousel
    * --------------------------------------------------*/
    var imageboxCarousel = function ($scope, $) {
        $scope.find('.image-box-carousel').each( function () {
            var $this     = $(this),
                $loop     = $this.data('loop'),
                $auto     = $this.data('auto'),
                $time     = $this.data('time'),
                $dots     = $this.data('dots'),
                $nav      = $this.data('arrows'),
                $items    = $this.data('show') ? $this.data('show') : 3,
                $titems   = $this.data('tshow') ? $this.data('tshow') : 2,
                $mitems   = $this.data('mshow') ? $this.data('mshow') : 1,
                $gaps     = $this.data('gaps') !== '' ? $this.data('gaps') : 30,
                $tgaps    = $this.data('tgaps') !== '' ? $this.data('tgaps') : 30,
                $mgaps    = $this.data('mgaps') !== '' ? $this.data('mgaps') : 30,
                $selector = $this.find('.owl-carousel');
            $selector.owlCarousel({
                rtl: rtl_owl(),
                autoplay:$auto,
                autoplayTimeout: $time,
                loop:$loop,
                responsiveClass:true,
                dots:$dots,
                nav:$nav,
                navText:['<i class="xp-flaticon-left-arrow-2"></i>', '<i class="xp-flaticon-trajectory"></i>'],
                responsive : {
                    0 : {
                        margin:$mgaps,
                        items:$mitems,
                    },
                    768 : {
                        margin:$tgaps,
                        items:$titems,
                    },
                    1024 : {
                        margin:$gaps,
                        items:$items,
                    }
                }
            });
        });
    };

    /* --------------------------------------------------
    * social team
    * --------------------------------------------------*/
    var teamSocial = function ( $scope , $ ) {
        $scope.find('.team-social > span').on('click', function(){
            $(this).parent().toggleClass('active');
        });
    };

    /* --------------------------------------------------
    * video button
    * --------------------------------------------------*/
    var videoButton = function($scope, $){
        $scope.find('').each( function(){
                $(this).lightGallery({
                selector: '',
            });
        });
    }

    /* --------------------------------------------------
    * message box
    * --------------------------------------------------*/
    var messageBox = function($scope, $){
        $scope.find('.xp-message-box').each( function(){
            var selector = $(this),
                close = selector.find('>i');
            close.on('click', function() {
                $scope.fadeOut();
            });
        });
    };

    /* --------------------------------------------------
    * background list
    * --------------------------------------------------*/
    
    var featuresService = function($scope, $){
        $scope.find('.features-service-wrapper').each( function(){
            var selector = $(this),
                colHandle = selector.find('.features-service-item'),
                bgHandle = selector.find('.features-service-img');
            
                colHandle.each(function(){
                    if ($(this).data('default') == 'yes') {
                        bgHandle.removeClass('hover');
                        $(this).next().addClass('hover');
                    }
                });
               
                    colHandle.hover(
                        function() {
                            bgHandle.removeClass('hover');
                            $(this).next().addClass('hover');
                        }
                    );
                
                
        });
    };
    
    function fserviceResize(){
        var wraper = $('.features-service-wrapper');
        if(wraper.length){
            wraper.each(function () {
                var item = $(this).find('.features-service-item');
                    item.each(function () {
                        var desc = $(this).find('.features-service-desc'),
                            title = $(this).find('.features-service-title'),
                            width = $(window).width();

                        if (width > 1024){
                            var hdesc = desc.outerHeight(!0);
                            title.css({ transform: "translateY(" + hdesc + "px)" }),
                            $(this)
                                .mouseenter(function () {
                                    title.css({ transform: "translateY(0px)" });
                                })
                                .mouseleave(function () {
                                    title.css({ transform: "translateY(" + hdesc + "px)" });
                                });
                        }
                        else{
                            title.css("transform","");
                            $(this).unbind('mouseenter mouseleave');
                        }
                    });
            });
        }  
        
    }
    function fserviceResize1(){
        var wraper = $('.features-service-wrapper');
        if(wraper.length){
            wraper.each(function () {
                var item = $(this).find('.features-service-item');
                    item.each(function () {
                        var desc = $(this).find('.features-service-desc'),
                            width = $(window).width();

                        if (width > 1024){
                            desc.css("max-height","0"),
                            $(this)
                                .mouseenter(function () {
                                    desc.css( "max-height","100%" );
                                })
                                .mouseleave(function () {
                                    desc.css("max-height","0");
                                });
                        }
                        else{
                            desc.css("max-height","");
                            $(this).unbind('mouseenter mouseleave');
                        }
                    });
            });
        }  
        
    }

    /* --------------------------------------------------
    * handle after scroll/load/resize
    * --------------------------------------------------*/
    $(window).on('scroll', function() {
        lineProgress();
        circleProgress();
        iCounter();
    });

    $(window).on('load', function () {
        lineProgress();
        circleProgress();
        iCounter();
        fserviceResize();
    });

    $(window).on('resize', function () {
        lineProgressSize();
        fserviceResize();
    });

    /**
     * Elementor JS Hooks
     */
    $(window).on("elementor/frontend/init", function () {

        /* accordions*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/iaccordions.default",
            customAccordions
        );

        /* tabs*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/itabs.default",
            customTabs
        );

        /* counter */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/icounter.default",
            iCounter
        );

        /* counter 2 */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/icounter2.default",
            iCounter
        );

        /* logos carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/iclogos.default",
            clientLogos
        );

        /* testimonials carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/itestimonials.default",
            testiCarousel
        );

        /* testimonials carousel 2 */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/itestimonials2.default",
            testiCarousel2
        );

        /* image box carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/iiboxcarousel.default",
            imageboxCarousel
        );

        /* progress bar */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/iprogress.default",
            progressBar
        );
        
        /* projects filter */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ipfilter.default",
            projectsFilter
        );

        /* projects carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ipcarousel.default",
            projectsCarousel
        );

        /* posts carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ipostcarousel.default",
            postCarousel
        );

        /* team carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/iteamcarousel.default",
            teamCarousel
        );

        /*team social*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/imember.default",
            teamSocial
        );

        /*countdown*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/icountdown.default",
            countDown
        );
        
        /* video button */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ivideopopup.default",
            videoButton
        );

        /* message box */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/imessagebox.default",
            messageBox
        );

        /* background list */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ifearuresservice.default",
            featuresService
        );

    });

} )( jQuery );