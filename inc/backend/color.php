<?php 

//Custom Style Frontend
if(!function_exists('restimo_color_scheme')){
    function restimo_color_scheme(){
	  	$color_scheme = '';

	  	//Heading Color
	  	if( restimo_get_option('heading_color') != '#131E30' ){
			$color_scheme = 
			'
			/****Heading Color****/
			a { color: '.restimo_get_option('heading_color').';}
			.icon-box .title-box a,
			.xp-switcher > span,
			.woocommerce table.shop_table,
			.post-box .entry-title a,
			.post-box .entry-meta .btn-details,
			.xp-counter-2 .c-number,
			.panel-btn i,
			.xp-tabs .tab-link,
			.xp-accordions .acc-item .acc-toggle,
			.widget .recent-news h6 a,
			.widget-area .widget ul:not(.recent-news) > li a,
			.xptf-cta-header .toggle_search i,
			.xp-minicart:hover,
			.xp-minicart:visited,
			.xp-minicart:focus,
			.xp-minicart,
			.mmenu-toggle button,
			h1,
			h2,
			h3,
			h4,
			h5,
			h6{ color: '.restimo_get_option('heading_color').';}
				';
		}

		if( !empty($color_scheme) ){
			echo '<style type="text/css">'.$color_scheme.'</style>';
		}

		//Button Hover and Dark Color
	  	if( restimo_get_option('btn_hover_dark') != '#131E30' ){
			$color_scheme = 
			'
			/****Secondary Color****/
			.xptf-btn.xptf-btn-dark,
			.woocommerce button.button:hover,
			.post-box .post-cat a:hover,
			.search-form .search-submit:hover,
			.woocommerce-mini-cart__buttons a.button.checkout.wc-forward,
			.woocommerce #respond input#submit.alt:hover,
			.woocommerce a.button.alt:hover,
			.woocommerce button.button.alt:hover,
			.woocommerce input.button.alt:hover,
			.woocommerce #respond input#submit:hover,
			.woocommerce a.button:hover,
			.woocommerce input.button:hover,
			.woocommerce button.button.alt.disabled:hover,
			.xptf-btn:hover,
			.woocommerce ul.products li.product .add_to_cart_button:hover,
			.woocommerce-page ul.products li.product .add_to_cart_button:hover,
			.xptf-btn:focus{ background: '.restimo_get_option('btn_hover_dark').';}
				';
		}

		if( !empty($color_scheme) ){
			echo '<style type="text/css">'.$color_scheme.'</style>';
		}
			


	  	//Main Color
	  	if( restimo_get_option('main_color') != '#C19977' ){
			$color_scheme = 
			'
		  	/****Main Color****/

			/*Background Color*/
			.bg-primary,
			.elementor-social-icons-wrapper a.elementor-social-icon,
			.xptf-btn.xptf-btn-dark:hover,
			.xptf-btn.xptf-btn-dark:focus,
			.features-service-wrapper .btn-details:hover,
			.xp-heading > span.is_highlight,
			.tab-titles .title-item a.tab-active, .tab-titles .title-item a:hover,
			.list-primary li:before,
			.btn-details:hover,
			.owl-carousel .owl-dots button.owl-dot.active span,
			.owl-carousel .owl-dots button.owl-dot:hover span,
			.owl-carousel .owl-nav button.owl-prev:hover,.owl-carousel .owl-nav button.owl-next:hover,
			.xptf-btn,
			.xptf-btn-dark:hover, .xptf-btn-dark:focus,
			.xptf-btn-light:hover, .xptf-btn-light:focus,
			.xptf-btn.xptf-btn-border:hover, .xptf-btn.xptf-btn-border:focus,
			.main-navigation > ul > li:before,
			.post-box .post-cat a,
			.post-box .btn-play:hover i,
			.page-pagination li span, .page-pagination li a:hover,
			.blog-post .share-post a,
			.post-nav > div .thumb-post:before,
			.post-nav .post-prev.not-thumb a:hover .thumb-post:before,
			.post-nav .post-next.not-thumb a:hover .thumb-post:before,
			.widget-area .widget .widget-title:before,
			.widget-area .widget_categories ul li a:before,.widget-area .widget_product_categories ul li a:before,.widget-area .widget_archive ul li a:before,
			.search-form .search-submit,
			.author-widget_social a:hover,
			.bline-yes .icon-box-1:after,
			.bline-yes .icon-box-2 .content-box:after,
			.box-s2.icon-right .icon-main,
			.xp-image-box:hover .link-box,
			.line-progress .progress-bar,
			.xp-pricing-table.is-featured .inner-table .title-table span,
			.xp-pricing-table.is-featured .xptf-btn,
			.circle-social .team-social a:hover,
			.xp-accordions .acc-item.current .acc-toggle,
			.xp-testimonials .tphoto:after,
			.xp-message-box .icon-main,
			.xp-minicart .count,
			.xp-heading > span.is_line:before,
			.mc4wp-form-fields .subscribe-inner-form .subscribe-btn-icon:hover,
			#back-to-top,
			.error-404 .page-content form button:hover,
			.woocommerce ul.products li.product .added_to_cart, .woocommerce ul.products li.product .product_type_grouped, .woocommerce-page ul.products li.product .added_to_cart, .woocommerce-page ul.products li.product .product_type_grouped,
			.woocommerce #respond input#submit.alt, .woocommerce a.button.alt,.woocommerce button.button.alt, .woocommerce input.button.alt,.woocommerce #respond input#submit, .woocommerce a.button,.woocommerce input.button, .woocommerce button.button.alt.disabled,
			.woocommerce button.button,
			.woocommerce-mini-cart__buttons a.button.wc-forward,
			.woocommerce-mini-cart__buttons a.button.wc-forward:hover{ background: '.restimo_get_option('main_color').'; }
			.tab-titles .title-item a.tab-active,
			.tab-titles .title-item a:hover,
			.slide-rev-subtitle {
				background: '.restimo_get_option('main_color').' !important;
			}
			.post-box .entry-meta .btn-details:hover, 
			.widget .tagcloud a:hover,
			.icon-box-1 .icon-main{background: '.hex2rgba(restimo_get_option('main_color'), 0.1).';}
			.team-3 .team-thumb a:before{background: '.hex2rgba(restimo_get_option('main_color'), 0.8).';}
			.projects-grid .projects-box .portfolio-info,
			.projects-grid.style-3 .projects-thumbnail .overlay{background: '.hex2rgba(restimo_get_option('main_color'), 0.9).';}

			/*Background Image*/
			.author-widget_wrapper:before{ background-image: linear-gradient(230deg, '.restimo_get_option('main_color').' -150%, #fff 80%); }

			/*Border Color*/
			.xptf-btn.xptf-btn-border,
			.features-service-wrapper .btn-details:hover,
			.post-box .entry-meta .btn-details:hover,
			.post-box .btn-play:hover i,
			.page-pagination li span, .page-pagination li a:hover,
			.blog-post .tagcloud a:hover,
			.widget .tagcloud a:hover,
			.xp-heading > span.is_highlight,
			.xp-image-box:hover .link-box,
			.xp-accordions .acc-item.current .acc-toggle,
			.xp-tabs .tab-link.current, .xp-tabs .tab-link:hover,
			.xp-video-button a:hover span,
			.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
			.woocommerce div.product .woocommerce-tabs ul.tabs li.active a{ border-color: '.restimo_get_option('main_color').'; }

			/*Border Top Color*/
			.woocommerce-message,
			.woocommerce-info{ border-top-color: '.restimo_get_option('main_color').'; }

			/*Color*/
			blockquote:before,
			.main-navigation > ul > li.current_page_item > a,
			.main-navigation > ul > li.current-menu-parent > a,
			.food-price-menu .menu-item .content .title_priccce .price,
			.features-service-wrapper .features-service-item:hover .features-service-number,
			blockquote cite,
			.text-primary,
			.link-details,
			.link-details:visited,
			.xptf-btn.xptf-btn-border,
			.xptf-btn.xptf-btn-border:visited,
			a:hover, a:focus, a:active,
			.main-navigation > ul > li:hover > a,
			.main-navigation ul li li a:hover,.main-navigation ul ul.sub-menu li.current-menu-item > a,.main-navigation ul ul.sub-menu li.current-menu-ancestor > a,
			.main-navigation ul > li.menu-item-has-children:hover > a,
			.main-navigation ul > li.menu-item-has-children:hover > a:after,
			.main-navigation ul > li.menu-item-has-children > a:hover:after,
			.header_mobile .mobile_nav .mobile_mainmenu li li a:hover,.header_mobile .mobile_nav .mobile_mainmenu ul > li > ul > li.current-menu-ancestor > a,
			.header_mobile .mobile_nav .mobile_mainmenu > li > a:hover, .header_mobile .mobile_nav .mobile_mainmenu > li.current-menu-item > a,.header_mobile .mobile_nav .mobile_mainmenu > li.current-menu-ancestor > a,
			.post-box .entry-meta a:hover,
			.post-box .entry-meta .btn-details:hover,
			.post-box .entry-title a:hover,
			.post-box .link-box a:hover,
			.post-box .link-box i,
			.post-box .quote-box i,
			.post-box .quote-box .quote-text span,
			.blog-post .tagcloud a:hover,
			.blog-post .author-bio .author-info .author-socials a:hover,
			.comments-area .comment-item .comment-meta .comment-reply-link,
			.comment-respond .comment-reply-title small a:hover,
			.comment-form .logged-in-as a:hover,
			.widget .tagcloud a:hover,
			.widget-area .widget ul:not(.recent-news) > li a:hover,
			.widget-area .widget_categories ul li a:hover + span.posts-count,.widget-area .widget_product_categories ul li a:hover + span.posts-count,.widget-area .widget_archive ul li a:hover + span.posts-count,
			.xp-heading > span,
			.icon-box .icon-main,
			.icon-box-grid .icon-box .icon-main,
			.icon-box-grid .icon-box .content-box .title-box a:hover,
			.icon-box-grid .icon-box:hover .icon-main,
			.xp-image-box .link-box,
			.xp-counter span,
			.xp-counter-2 i,
			.xp-countdown li.seperator,
			.xp-pricing-table .inner-table h2,
			.project_filters li a:before,
			.project_filters li a .filter-count,
			.project_filters li a.selected, .project_filters li a:hover,
			.xp-team .team-info span,
			.xp-testimonials .t-head span,
			.woocommerce ul.products li.product .price .woocommerce-Price-amount, .woocommerce-page ul.products li.product .price .woocommerce-Price-amount,
			.woocommerce table.shop_table td.product-price, .woocommerce table.shop_table td.product-subtotal,
			.woocommerce-message:before,
			.woocommerce-info:before,
			.woocommerce .woocommerce-Price-amount,
			.woocommerce .site ul.product_list_widget li a:not(.remove):hover,
			.woocommerce .woocommerce-widget-layered-nav-list li a:hover,
			.woocommerce .widget_price_filter .price_slider_amount button.button,
			.elementor-widget-icon.elementor-view-framed .elementor-icon,
			.elementor-widget-icon.elementor-view-default .elementor-icon,
			.xp-counter-2.icounter .c-number.font-second span.num + span,
			.woocommerce div.product p.price,.woocommerce div.product span.price{ color: '.restimo_get_option('main_color').'; }

			.main-navigation > ul > li:hover > a,
			.main-navigation ul li li a:hover,.main-navigation ul ul.sub-menu li.current-menu-item > a,.main-navigation ul ul.sub-menu li.current-menu-ancestor > a,
			.main-navigation ul > li.menu-item-has-children:hover > a,
			.main-navigation ul > li.menu-item-has-children:hover > a:after,
			.main-navigation ul > li.menu-item-has-children > a:hover:after{
				color:'.restimo_get_option('main_color').' !important;
			}

			/*Other*/
			.border_clr.elementor-widget-divider.elementor-view-framed .elementor-icon, 
			.border_clr.elementor-widget-divider.elementor-view-default .elementor-icon svg {
			  fill: '.restimo_get_option('main_color').';
			}
			.border_clr.elementor-widget-divider.elementor-view-framed .elementor-icon, 
			.border_clr.elementor-widget-divider.elementor-view-default .elementor-icon {
			  color: '.restimo_get_option('main_color').';
			}
			.border_clr.elementor-widget-divider {
			  --divider-color: '.restimo_get_option('main_color').'; }
			.icon-box .icon-main svg,
			.icon-box-grid .icon-box .icon-main svg,
			.xp-counter-2 svg{ fill: '.restimo_get_option('main_color').'; }
				';
		}


	  	if( !empty($color_scheme) ){
			echo '<style type="text/css">'.$color_scheme.'</style>';
		}

    }
}
add_action('wp_head', 'restimo_color_scheme');

//Custom Second Font
if(!function_exists('restimo_second_font')){
	function restimo_second_font(){
		$second_font = restimo_get_option( 'second_font', [] );
		$data_font = '';

		if ( $second_font['font-family'] != '' && $second_font['font-family'] != 'Merienda' ) {
			$data_font = 
			'h1, h2, h3, h4, h5, h6,
			blockquote,
			.font-second,
			.link-details,
			.slide-rev-subtitle,
			.xptf-btn,
			select,
			.main-navigation ul,
			.page-header,
			.post-box .post-cat a,
			.post-box .entry-meta,
			.post-box .link-box a,
			.post-box .quote-box .quote-text,
			.page-pagination li a, .page-pagination li span,
			.blog-post .tagcloud a,
			.drop-cap,
			.post-nav,
			.comments-area .comment-item .comment-meta .comment-time,
			.comments-area .comment-item .comment-meta .comment-reply-link,
			.comment-form .logged-in-as,
			.widget .tagcloud a,
			.widget table,
			.widget .recent-news .post-on,
			.xp-heading,
			.xp-flip-box .number-title span,
			.xp-counter,
			.xp-counter span,
			.xp-countdown li span,
			.line-progress .percent,
			.project_filters li a,
			.projects-grid .projects-box .portfolio-info .portfolio-cates,
			.project-slider .projects-box .portfolio-info .portfolio-cates,
			.xp-team .team-info span,
			.member-info li span,
			.xp-accordions .acc-item .acc-toggle,
			.xp-tabs .tab-link,
			.xp-testimonials .t-head,
			.features-service-wrapper .features-service-item .features-service-content,
			div.elementor-widget-heading.elementor-widget-heading .elementor-heading-title,
			.elementor-element .elementor-widget-button .elementor-button,
			.elementor-default .elementor-widget-text-editor .elementor-drop-cap,
			.elementor-widget-wp-widget-polylang .lang-item,
			#lang_choice_wp-widget-polylang,
			.mmenu-wrapper .mobile_mainmenu,
			.woocommerce ul.products li.product, .woocommerce-page ul.products li.product,
			.woocommerce ul.products li.product .added_to_cart, .woocommerce ul.products li.product .product_type_grouped, .woocommerce-page ul.products li.product .added_to_cart, .woocommerce-page ul.products li.product .product_type_grouped,
			.woocommerce table.shop_table,
			.woocommerce .quantity .qty,
			.cart_totals h2,
			#add_payment_method .cart-collaterals .cart_totals table td, #add_payment_method .cart-collaterals .cart_totals table th,.woocommerce-cart .cart-collaterals .cart_totals table td, .woocommerce-cart .cart-collaterals .cart_totals table th,.woocommerce-checkout .cart-collaterals .cart_totals table td, .woocommerce-checkout .cart-collaterals .cart_totals table th,
			.woocommerce .site ul.product_list_widget li a:not(.remove),
			.woocommerce .widget_shopping_cart .cart_list .quantity,
			.woocommerce .widget_shopping_cart .total strong,.woocommerce.widget_shopping_cart .total strong,
			.woocommerce .widget_shopping_cart .total .woocommerce-Price-amount,.woocommerce.widget_shopping_cart .total .woocommerce-Price-amount,
			.woocommerce-mini-cart__buttons a.button.wc-forward,
			.woocommerce .woocommerce-widget-layered-nav-list,
			.woocommerce .widget_price_filter .price_slider_amount,
			.woocommerce .widget_price_filter .price_slider_amount button.button,
			.product_meta > span,
			.woocommerce div.product .entry-summary p.price,.woocommerce div.product .entry-summary span.price{ font-family: '.sprintf( $second_font['font-family'] ).';}
		    ';
		}

		if( !empty($data_font) ){
			echo '<style type="text/css">'.$data_font.'</style>';
		}
	}
}
add_action('wp_head', 'restimo_second_font');