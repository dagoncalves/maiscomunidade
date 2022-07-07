<?php
if(!function_exists('findme_elated_design_styles')) {
    /**
     * Generates general custom styles
     */
    function findme_elated_design_styles() {
	    $font_family = findme_elated_options()->getOptionValue('google_fonts');
	    if (!empty($font_family) && findme_elated_is_font_option_valid($font_family)){
		    echo findme_elated_dynamic_css('body', array('font-family' => findme_elated_get_font_option_val($font_family)));
		}

		$first_main_color = findme_elated_options()->getOptionValue('first_color');
        if(!empty($first_main_color)) {
            $color_selector = array(
	            'a:hover',
	            'h1 a:hover',
	            'h2 a:hover',
	            'h3 a:hover',
	            'h4 a:hover',
	            'h5 a:hover',
	            'h6 a:hover',
	            'p a:hover',
	            '.eltd-comment-holder .eltd-comment-text .comment-edit-link:hover',
	            '.eltd-comment-holder .eltd-comment-text .comment-reply-link:hover',
	            '.eltd-comment-holder .eltd-comment-text .replay:hover',
	            '.eltd-comment-holder .eltd-comment-text #cancel-comment-reply-link',
	            '#submit_comment:hover',
	            '.post-password-form input[type=submit]:hover',
	            'input.wpcf7-form-control.wpcf7-submit',
	            '.eltd-newsletter-form .eltd-newsletter-button:after',
	            '.eltd-newsletter-form input.wpcf7-submit',
	            '#eltd-back-to-top:hover',
	            '.eltd-page-footer .eltd-footer-bottom-holder .widget a:hover',
	            '.eltd-side-menu-button-opener.opened',
	            '.eltd-side-menu-button-opener:hover',
	            'nav.eltd-fullscreen-menu ul li ul li.current-menu-ancestor>a',
	            'nav.eltd-fullscreen-menu ul li ul li.current-menu-item>a',
	            'nav.eltd-fullscreen-menu>ul>li.eltd-active-item>a',
	            '.eltd-search-page-holder .eltd-search-page-form .eltd-form-holder .eltd-search-submit:hover',
	            '.eltd-search-page-holder article.sticky .eltd-post-title-area h3 a',
	            '.eltd-search-cover .eltd-search-close a:hover',
	            '.eltd-blog-holder article.sticky .eltd-post-title a',
	            '.eltd-blog-holder.eltd-blog-masonry article .eltd-post-info-bottom a:hover',
	            '.eltd-blog-holder.eltd-blog-masonry article .eltd-post-info-bottom .eltd-post-info-bottom-left i',
	            '.eltd-blog-holder.eltd-blog-masonry article.format-link .eltd-post-text .eltd-post-info-category:before',
	            '.eltd-blog-holder.eltd-blog-masonry article.format-quote .eltd-post-text .eltd-post-info-category:before',
	            '.eltd-blog-holder.eltd-blog-narrow article .eltd-post-info.eltd-section-bottom .eltd-post-info-author a:hover',
	            '.eltd-blog-holder.eltd-blog-narrow article .eltd-post-info.eltd-section-bottom .eltd-blog-like:hover i:first-child',
	            '.eltd-blog-holder.eltd-blog-narrow article .eltd-post-info.eltd-section-bottom .eltd-blog-like:hover span:first-child',
	            '.eltd-blog-holder.eltd-blog-narrow article .eltd-post-info.eltd-section-bottom .eltd-post-info-comments-holder:hover span:first-child',
	            '.eltd-blog-holder.eltd-blog-standard-date-on-side article .eltd-post-date-inner .eltd-post-date-day',
	            '.eltd-blog-holder.eltd-blog-standard-date-on-side article .eltd-post-date-inner .eltd-post-date-month',
	            '.eltd-blog-holder.eltd-blog-standard-date-on-side article .eltd-post-title a:hover',
	            '.eltd-blog-holder.eltd-blog-standard-date-on-side article .eltd-post-info>div a:hover',
	            '.eltd-blog-holder.eltd-blog-standard-date-on-side article.format-quote .eltd-quote-author',
	            '.eltd-blog-holder.eltd-blog-standard article .eltd-blog-list-button',
	            '.eltd-blog-holder.eltd-blog-standard article .eltd-post-info-bottom a:hover',
	            '.eltd-blog-holder.eltd-blog-standard article .eltd-post-info-bottom .eltd-post-info-bottom-left i',
	            '.eltd-blog-holder.eltd-blog-standard article.format-link .eltd-post-text .eltd-post-text-main .eltd-post-title:before',
	            '.eltd-blog-holder.eltd-blog-standard article.format-quote .eltd-post-text .eltd-post-text-main .eltd-post-title:before',
	            '.eltd-author-description .eltd-author-description-text-holder .eltd-author-name a:hover',
	            '.eltd-author-description .eltd-author-description-text-holder .eltd-author-social-icons a:hover',
	            '.eltd-bl-standard-pagination ul li.eltd-bl-pag-active a',
	            '.eltd-blog-pagination ul li a.eltd-pag-active',
	            '.eltd-blog-pagination ul li a:hover',
	            '.eltd-blog-single-navigation .eltd-blog-single-nav-prev.eltd-with-image .eltd-blog-single-nav-label:hover',
	            '.eltd-blog-single-navigation .eltd-blog-single-nav-label:hover',
	            '.eltd-blog-single-navigation .eltd-blog-single-nav-next.eltd-with-image .eltd-blog-single-nav-label:hover',
	            '.eltd-blog-carousel-holder .eltd-blog-carousel-item .eltd-item-text-holder-inner .eltd-post-info-date a:hover',
	            '.eltd-blog-list-holder.eltd-bl-advanced ul.eltd-blog-list .eltd-bl-item .eltd-post-info-category a',
	            '.eltd-blog-list-holder.eltd-bl-advanced ul.eltd-blog-list .eltd-bl-item .eltd-post-title a:hover',
	            '.eltd-blog-list-holder.eltd-bl-masonry .eltd-blog-like *',
	            '.eltd-blog-list-holder.eltd-bl-masonry .eltd-post-info-bottom a:hover',
	            '.eltd-blog-list-holder.eltd-bl-masonry .eltd-post-info-bottom .eltd-post-info-bottom-left i',
	            '.eltd-blog-list-holder.eltd-bl-standard .eltd-blog-like *',
	            '.eltd-blog-list-holder.eltd-bl-standard .eltd-blog-list-button',
	            '.eltd-blog-list-holder.eltd-bl-standard .eltd-blog-list-button:after',
	            '.eltd-blog-list-holder.eltd-bl-standard .eltd-post-info-bottom a:hover',
	            '.eltd-blog-list-holder.eltd-bl-standard .eltd-post-info-bottom .eltd-post-info-bottom-left i',
	            '.eltd-blog-holder.eltd-blog-single.eltd-blog-single-standard article .eltd-post-info-top>div a:hover',
	            '.eltd-blog-holder.eltd-blog-single.eltd-blog-single-standard article .eltd-post-info-top>div i',
	            '.eltd-blog-holder.eltd-blog-single.eltd-blog-single-standard article .eltd-post-info-bottom .eltd-post-info-bottom-left .eltd-tags a:hover',
	            '.eltd-blog-holder.eltd-blog-single.eltd-blog-single-standard article .eltd-blog-share li a:hover',
	            '.eltd-blog-holder.eltd-blog-single.eltd-blog-single-standard article.format-link .eltd-post-text .eltd-post-title:before',
	            '.eltd-blog-holder.eltd-blog-single.eltd-blog-single-standard article.format-quote .eltd-post-text .eltd-post-title:before',
	            'footer .widget ul li a:hover',
	            'footer .widget #wp-calendar tfoot a:hover',
	            'footer .widget.widget_tag_cloud a:hover',
	            '.eltd-side-menu .widget ul li a:hover',
	            '.eltd-side-menu .widget #wp-calendar tfoot a:hover',
	            '.eltd-side-menu .widget.widget_tag_cloud a:hover',
	            '.wpb_widgetised_column .widget ul li a:hover',
	            'aside.eltd-sidebar .widget ul li a:hover',
	            '.wpb_widgetised_column .widget #wp-calendar tfoot a:hover',
	            'aside.eltd-sidebar .widget #wp-calendar tfoot a:hover',
	            '.wpb_widgetised_column .widget.widget_tag_cloud a:hover',
	            'aside.eltd-sidebar .widget.widget_tag_cloud a:hover',
	            '.widget.eltd-blog-list-widget .eltd-blog-list .eltd-bl-item .eltd-post-info-comments-holder a:hover',
	            '.widget.eltd-blog-list-widget .eltd-blog-list .eltd-bl-item .eltd-post-info-date a:hover',
	            '.widget ul li a:hover',
	            '.widget #wp-calendar tfoot a:hover',
	            '.widget.widget_tag_cloud a:hover',
	            '.widget.widget_eltd_twitter_widget .eltd-twitter-widget.eltd-twitter-standard .eltd-twitter-icon',
	            '.widget.widget_eltd_twitter_widget .eltd-twitter-widget.eltd-twitter-slider li .eltd-tweet-text a',
	            '.widget.widget_eltd_twitter_widget .eltd-twitter-widget.eltd-twitter-slider li .eltd-tweet-text span',
	            '.widget.widget_eltd_twitter_widget .eltd-twitter-widget.eltd-twitter-standard li .eltd-tweet-text a:hover',
	            '.widget.widget_eltd_twitter_widget .eltd-twitter-widget.eltd-twitter-slider li .eltd-twitter-icon i',
	            '.eltd-main-menu ul li a:hover',
	            '.eltd-main-menu ul li a i:before',
	            '.eltd-main-menu>ul>li:hover>a',
	            '.eltd-main-menu>ul>li.eltd-active-item>a',
	            '.eltd-drop-down .second .inner ul li.current-menu-ancestor>a',
	            '.eltd-drop-down .second .inner ul li.current-menu-item>a',
	            '.eltd-drop-down .wide .second .inner ul li a:hover',
	            '.eltd-drop-down .wide .second .inner ul li.current_page_item a',
	            '.eltd-header-vertical-closed .eltd-vertical-menu ul li a:hover',
	            '.eltd-header-vertical-closed .eltd-vertical-menu ul li.current-menu-ancestor>a',
	            '.eltd-header-vertical-closed .eltd-vertical-menu ul li.current-menu-item>a',
	            '.eltd-header-vertical-closed .eltd-vertical-menu ul li.current_page_item>a',
	            '.eltd-header-vertical-closed .eltd-vertical-menu ul li.eltd-active-item>a',
	            '.eltd-header-vertical-compact .eltd-vertical-menu .eltd-menu-featured-icon',
	            '.eltd-header-vertical .eltd-vertical-menu ul li a:hover',
	            '.eltd-header-vertical .eltd-vertical-menu ul li.current-menu-ancestor>a',
	            '.eltd-header-vertical .eltd-vertical-menu ul li.current-menu-item>a',
	            '.eltd-header-vertical .eltd-vertical-menu ul li.current_page_item>a',
	            '.eltd-header-vertical .eltd-vertical-menu ul li.eltd-active-item>a',
	            '.eltd-mobile-header .eltd-mobile-nav ul li a:hover',
	            '.eltd-mobile-header .eltd-mobile-nav ul li h5:hover',
	            '.eltd-mobile-header .eltd-mobile-nav ul li h6:hover',
	            '.eltd-mobile-header .eltd-mobile-nav ul ul li.current-menu-ancestor>a',
	            '.eltd-mobile-header .eltd-mobile-nav ul ul li.current-menu-item>a',
	            '.eltd-mobile-header .eltd-mobile-nav .eltd-grid>ul>li.eltd-active-item>a',
	            '.eltd-accordion-holder.eltd-ac-boxed .eltd-title-holder.ui-state-active',
	            '.eltd-accordion-holder.eltd-ac-boxed .eltd-title-holder.ui-state-hover',
	            '.eltd-accordion-holder.eltd-ac-simple .eltd-title-holder.ui-state-active',
	            '.eltd-accordion-holder.eltd-ac-simple .eltd-title-holder.ui-state-hover',
	            'blockquote .eltd-blockquote-text:before',
	            '.eltd-btn.eltd-btn-solid:not(.eltd-btn-custom-hover-bg):hover.eltd-btn-icon .eltd-btn-icon-html',
	            '.eltd-btn.eltd-btn-outline',
	            '.swiper-navigation .eltd-swiper-button-next:hover',
	            '.swiper-navigation .eltd-swiper-button-prev:hover',
	            '.eltd-iwt .eltd-iwt-icon.icon-hover .eltd-icon-shortcode:hover',
	            '.eltd-processes-holder .eltd-process:hover .eltd-process-number',
	            '.eltd-social-share-holder.eltd-dropdown .eltd-social-share-dropdown-opener:hover',
	            '.eltd-tabs.eltd-tabs-boxed .eltd-tabs-nav li.ui-state-active a',
	            '.eltd-tabs.eltd-tabs-boxed .eltd-tabs-nav li.ui-state-hover a',
	            '.eltd-tabs.eltd-tabs-simple .eltd-tabs-nav li.ui-state-active a',
	            '.eltd-tabs.eltd-tabs-simple .eltd-tabs-nav li.ui-state-hover a',
	            '.eltd-pl-filter-holder ul li.eltd-pl-current span',
	            '.eltd-pl-filter-holder ul li:hover span',
	            '.eltd-pl-standard-pagination ul li.eltd-pl-pag-active a',
	            '.eltd-portfolio-list-holder.eltd-pl-gallery-overlay article .eltd-pli-text .eltd-pli-category-holder a:hover',
	            '.eltd-testimonials-holder.eltd-testimonials-boxed .eltd-testimonial-content .eltd-testimonial-text-holder .eltd-testimonial-title',
	            '.eltd-testimonials-holder.eltd-testimonials-standard .eltd-testimonial-text-holder .eltd-testimonial-title:before',
	            '.eltd-ls-archive-items-inner article .eltd-listing-rating-holder .eltd-average-rating>span',
	            '.eltd-listing-archive-filter-holder .eltd-ls-archive-filter-item .eltd-archive-filter-icon',
	            '.eltd-listing-places-dist-holder .eltd-listing-places-range',
	            '.page-template-user-dashboard .eltd-membership-dashboard-content-holder .job-manager-form .eltd-ls-field-holder .fieldset-listing_facebook_url .field:before',
	            '.page-template-user-dashboard .eltd-membership-dashboard-content-holder .job-manager-form .eltd-ls-field-holder .fieldset-listing_instagram_url .field:before',
	            '.page-template-user-dashboard .eltd-membership-dashboard-content-holder .job-manager-form .eltd-ls-field-holder .fieldset-listing_pinterest_url .field:before',
	            '.page-template-user-dashboard .eltd-membership-dashboard-content-holder .job-manager-form .eltd-ls-field-holder .fieldset-listing_skype_url .field:before',
	            '.page-template-user-dashboard .eltd-membership-dashboard-content-holder .job-manager-form .eltd-ls-field-holder .fieldset-listing_soundcloud_url .field:before',
	            '.page-template-user-dashboard .eltd-membership-dashboard-content-holder .job-manager-form .eltd-ls-field-holder .fieldset-listing_twitter_url .field:before',
	            '.page-template-user-dashboard .eltd-membership-dashboard-content-holder .job-manager-form .eltd-ls-field-holder .fieldset-listing_vimeo_url .field:before',
	            '.page-template-user-dashboard .eltd-membership-dashboard-content-holder .job-manager-form .eltd-ls-field-holder .fieldset-listing_youtube_url .field:before',
	            '.eltd-login-register-content .eltd-social-login-holder-inner .eltd-lost-pass-remember-holder .eltd-login-action-btn:hover',
	            '.eltd-register-terms-holder>span>a',
	            '.widget.eltd-login-register-widget .eltd-logged-in-user .icon_profile',
	            '.widget.eltd-login-register-widget .eltd-login-holder .icon_profile',
	            '.widget.eltd-login-register-widget .eltd-login-dropdown li:hover>a',
	            '.widget.eltd-login-register-widget .eltd-login-dropdown li:hover>span',
	            '.page-template-user-dashboard .eltd-membership-dashboard-content-holder #job-manager-job-dashboard .job-manager-pagination ul li .current:hover',
	            '.page-template-user-dashboard .eltd-membership-dashboard-content-holder #job-manager-job-dashboard .job-manager-pagination ul li a:hover',
	            '.page-template-user-dashboard .eltd-membership-dashboard-content-holder #job-manager-job-dashboard .job-manager-pagination ul li .current',
	            '.page-template-user-dashboard .eltd-membership-dashboard-nav-holder .eltd-membership-dashboard-nav li.eltd-active-dash .eltd-dash-icon',
	            '.page-template-user-dashboard .eltd-membership-dashboard-nav-holder .eltd-membership-dashboard-nav li.eltd-active-dash h5',
	            '.page-template-user-dashboard .eltd-membership-dashboard-nav-holder .eltd-membership-dashboard-nav li:hover h5',
	            '.page-template-user-dashboard .eltd-membership-dashboard-nav-holder .eltd-membership-dashboard-nav li:hover span',
	            '.eltd-ls-archive-filter-item .eltd-listing-type-amenity-field input[type=checkbox]+label .eltd-label-view:after',
	            '.ui-autocomplete.ui-widget-content li:hover',
	            '.eltd-map-marker-holder .eltd-info-window-inner>a:hover~.eltd-info-window-details h5',
	            '.eltd-listing-rating-holder .eltd-average-rating>span',
	            '.eltd-listing-rating-holder .eltd-listing-rating-stars-holder span',
	            '.eltd-ls-adv-search-holder .eltd-ls-adv-search-items-holder .eltd-ls-item .eltd-ls-item-inner .eltd-listing-rating-holder .eltd-average-rating>span',
	            '.eltd-ls-list-holder .eltd-ls-list-items-holder .eltd-ls-item .eltd-ls-item-inner .eltd-listing-rating-holder .eltd-average-rating>span',
	            '.eltd-ls-main-search-holder .eltd-ls-main-search-holder-part.type3 .eltd-ls-main-search-holder-inner .eltd-ls-input-icon:before',
	            '.eltd-ls-main-search-holder .eltd-ls-main-search-holder-part.type3 .eltd-ls-main-search-holder-inner .select2-selection:before',
	            '.eltd-ls-main-search-holder .eltd-ls-main-search-holder-part .eltd-ls-slider-wrapper .eltd-price-slider-response',
	            '.eltd-ls-slider-holder .eltd-ls-slider-items-holder .eltd-ls-item .eltd-ls-item-inner .eltd-listing-rating-holder .eltd-average-rating>span',
	            '.eltd-ratings-holder .eltd-ratings-stars-holder .eltd-ratings-stars-inner>span.eltd-active-rating-star',
	            '.eltd-ratings-holder .eltd-ratings-stars-holder .eltd-ratings-stars-inner>span.eltd-hover-rating-star',
	            '.eltd-ls-single-comments .eltd-comments-title i',
	            '.eltd-ls-single-comments .eltd-comments .eltd-review-rating .rating-inner',
	            '.eltd-ls-single-comments .eltd-comments .eltd-comment-text .eltd-average-rating>span',
	            '.eltd-ls-single-comments .eltd-comments .eltd-review-title',
	            '.eltd-comment-rating-box .eltd-star-rating.active',
	            '.eltd-listing-single-holder article .eltd-ls-contact-info .eltd-ls-contact-info-inner.left',
	            '.eltd-listing-single-holder article .eltd-ls-contact-info .eltd-ls-contact-info-inner.right a:hover',
	            '.eltd-listing-single-holder article .eltd-ls-content-part.left i',
	            '.eltd-listing-single-holder article .eltd-ls-single-section-inner .eltd-listing-single-amenities .eltd-listing-single-field .eltd-listing-single-field-inner i:before',
	            '.eltd-listing-single-holder article .eltd-ls-single-section-inner .eltd-listing-single-amenities .eltd-listing-single-field .eltd-listing-single-field-inner span:before',
	            '.eltd-listing-single-holder .eltd-ls-address-info a:hover',
	            '.eltd-listing-single-holder article .eltd-ls-single-social-network-holder .eltd-ls-social-icon:hover',
	            '.eltd-listing-single-holder article .eltd-ls-tags-wrapper a:hover',
	            '.eltd-listing-single-holder article .eltd-ls-user-listing-holder .eltd-ls-user-listing-header .eltd-ls-user-listing-link',
	            '.eltd-listing-single-holder article .eltd-ls-single-related-posts-holder i',
	            '.eltd-listing-single-holder article .eltd-ls-single-related-posts-holder .eltd-related-post-holder .eltd-owl-slider .owl-nav .owl-next:hover span',
	            '.eltd-listing-single-holder article .eltd-ls-single-related-posts-holder .eltd-related-post-holder .eltd-owl-slider .owl-nav .owl-prev:hover span',
	            '.eltd-listing-single-holder article .eltd-ls-single-related-posts-holder .eltd-ls-related-item .eltd-ls-item-inner .eltd-listing-rating-holder .eltd-average-rating>span',
	            '.eltd-ls-enquiry-inner .eltd-ls-enquiry-form label:after',
	            '.eltd-listing-single-holder article .eltd-ls-single-header .eltd-ls-social-share .eltd-list a:hover .eltd-social-network-icon',
	            '.eltd-listing-single-holder article .eltd-ls-single-header .eltd-ls-header-info .eltd-like:hover',
	            '.eltd-listing-single-holder article .eltd-ls-single-header .eltd-ls-header-info .eltd-like.liked i',
            );

            $woo_color_selector = array();
            if(findme_elated_is_woocommerce_installed()) {
                $woo_color_selector = array(
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector);

	        $color_important_selector = array(
		        '.eltd-fullscreen-menu-opener.eltd-fm-opened',
		        '.eltd-fullscreen-menu-opener:hover',
		        '.eltd-blog-slider-holder .eltd-blog-slider-item .eltd-section-button-holder a:hover',
		        '.eltd-btn.eltd-btn-solid:not(.eltd-btn-custom-hover-color):hover',
		        '.eltd-light-header:not(.eltd-fixed-header-appear):not(.eltd-sticky-header-appear) .widget.eltd-login-register-widget ul.eltd-login-dropdown li:hover>a',
		        '.eltd-light-header:not(.eltd-fixed-header-appear):not(.eltd-sticky-header-appear) .widget.eltd-login-register-widget ul.eltd-login-dropdown li:hover>span i',
	        );

            $background_color_selector = array(
	            '.eltd-st-loader .pulse',
	            '.eltd-st-loader .double_pulse .double-bounce1',
	            '.eltd-st-loader .double_pulse .double-bounce2',
	            '.eltd-st-loader .cube',
	            '.eltd-st-loader .rotating_cubes .cube1',
	            '.eltd-st-loader .rotating_cubes .cube2',
	            '.eltd-st-loader .stripes>div',
	            '.eltd-st-loader .wave>div',
	            '.eltd-st-loader .two_rotating_circles .dot1',
	            '.eltd-st-loader .two_rotating_circles .dot2',
	            '.eltd-st-loader .five_rotating_circles .container1>div',
	            '.eltd-st-loader .five_rotating_circles .container2>div',
	            '.eltd-st-loader .five_rotating_circles .container3>div',
	            '.eltd-st-loader .lines .line1',
	            '.eltd-st-loader .lines .line2',
	            '.eltd-st-loader .lines .line3',
	            '.eltd-st-loader .lines .line4',
	            '.eltd-comment-holder .eltd-comment-image:after',
	            '#submit_comment',
	            '.post-password-form input[type=submit]',
	            'input.wpcf7-form-control.wpcf7-submit:hover',
	            '#eltd-back-to-top',
	            '.eltd-blog-holder article.format-audio .eltd-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-current',
	            '.eltd-blog-holder article.format-audio .eltd-blog-audio-holder .mejs-container .mejs-controls>a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
	            '.eltd-blog-holder.eltd-blog-masonry article .eltd-post-info-category>a',
	            '.eltd-blog-holder.eltd-blog-standard article .eltd-post-info-category',
	            '.eltd-blog-list-holder.eltd-bl-masonry .eltd-post-info-category>a',
	            '.eltd-blog-list-holder.eltd-bl-standard .eltd-post-info-category',
	            'aside.eltd-sidebar .widget.widget_search .input_holder button:hover',
	            '.eltd-header-vertical-closed .eltd-vertical-menu-area .eltd-vertical-area-opener .eltd-vertical-area-opener-line',
	            '.eltd-header-vertical-closed .eltd-vertical-menu-area .eltd-vertical-area-opener .eltd-vertical-area-opener-line:before',
	            '.eltd-header-vertical-closed .eltd-vertical-menu-area .eltd-vertical-area-opener .eltd-vertical-area-opener-line:after',
	            '.eltd-btn.eltd-btn-solid',
	            '.eltd-iwt.eltd-iwt-icon-top .eltd-iwt-link',
	            '.eltd-iwt.eltd-iwt-icon-top-hover .eltd-iwt-link',
	            '.eltd-icon-shortcode.eltd-circle',
	            '.eltd-icon-shortcode.eltd-dropcaps.eltd-circle',
	            '.eltd-icon-shortcode.eltd-square',
	            '.eltd-tabs.eltd-tabs-standard .eltd-tabs-nav li.ui-state-active a',
	            '.eltd-tabs.eltd-tabs-standard .eltd-tabs-nav li.ui-state-hover a',
	            '.eltd-testimonials-holder.eltd-testimonials-boxed .eltd-testimonial-content .eltd-testimonials-author-holder .eltd-testimonial-image .fa-quote-right',
	            '.eltd-testimonials-holder.eltd-testimonials-standard .eltd-testimonials.eltd-owl-slider .owl-dots .owl-dot.active span',
	            '.eltd-testimonials-holder.eltd-testimonials-standard .eltd-testimonials.eltd-owl-slider .owl-dots .owl-dot:hover span',
	            '.eltd-testimonials-holder .eltd-owl-slider .owl-dots .owl-dot span',
	            '.eltd-ls-archive-items-inner article .eltd-ls-cat-icon.eltd-regular-icon',
	            '.eltd-listing-places-dist-holder .rangeslider__fill',
	            '.eltd-listing-places-dist-holder .rangeslider__handle',
	            '.widget.eltd-login-register-widget .eltd-logged-in-user .icon_profile:hover',
	            '.widget.eltd-login-register-widget .eltd-login-holder .icon_profile:hover',
	            '.eltd-ls-adv-search-holder .eltd-ls-adv-search-field input[type=checkbox]+label .eltd-label-view:after',
	            '.eltd-ls-archive-filter-item .eltd-listing-type-amenity-field input[type=checkbox]+label .eltd-label-view:after',
	            '.eltd-ls-checkbox-field input[type=checkbox]+label .eltd-label-view:after',
	            '.eltd-ls-adv-search-holder .eltd-ls-adv-search-items-holder .eltd-ls-item .eltd-listing-cat-wrapper .eltd-ls-cat-icon.eltd-regular-icon',
	            '.eltd-ls-categories-holder .eltd-ls-gallery-item.eltd-ls-gallery-standard .eltd-ls-cat-icon.eltd-regular-icon',
	            '.eltd-ls-list-holder .eltd-ls-list-items-holder .eltd-ls-item .eltd-listing-cat-wrapper .eltd-ls-cat-icon.eltd-regular-icon',
	            '.eltd-ls-package-holder article .eltd-ls-package-featured',
	            '.eltd-ls-main-search-holder .eltd-ls-main-search-holder-part .eltd-ls-slider-wrapper .rangeslider--horizontal .rangeslider__fill',
	            '.eltd-ls-main-search-holder .eltd-ls-main-search-holder-part .eltd-ls-slider-wrapper .rangeslider__handle',
	            '.eltd-ls-slider-holder .eltd-ls-slider-items-holder .eltd-ls-item .eltd-listing-cat-wrapper>a',
	            '.eltd-listing-single-holder article .eltd-ls-single-related-posts-holder .eltd-ls-related-item .eltd-listing-cat-wrapper .eltd-ls-cat-icon.eltd-regular-icon',
            );

            $woo_background_color_selector = array();
            if(findme_elated_is_woocommerce_installed()) {
                $woo_background_color_selector = array(
                );
            }

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);

            $border_color_selector = array(
	            '.eltd-st-loader .pulse_circles .ball',
	            '#submit_comment',
	            '.post-password-form input[type=submit]',
	            '#submit_comment:hover',
	            '.post-password-form input[type=submit]:hover',
	            'input.wpcf7-form-control.wpcf7-submit:hover',
	            '#eltd-back-to-top',
	            '.eltd-blog-pagination ul li a.eltd-pag-active',
	            '.eltd-blog-pagination ul li a:hover',
	            '.eltd-blog-holder.eltd-blog-single.eltd-blog-single-standard article .eltd-post-info-bottom .eltd-post-info-bottom-left .eltd-tags a:hover',
	            '.eltd-btn.eltd-btn-solid',
	            '.eltd-btn.eltd-btn-solid:not(.eltd-btn-custom-hover-bg):hover',
	            '.eltd-btn.eltd-btn-outline',
	            '.eltd-tabs.eltd-tabs-standard .eltd-tabs-nav li.ui-state-active a',
	            '.eltd-tabs.eltd-tabs-standard .eltd-tabs-nav li.ui-state-hover a',
	            '.eltd-tabs.eltd-tabs-boxed .eltd-tabs-nav li.ui-state-active a',
	            '.eltd-tabs.eltd-tabs-boxed .eltd-tabs-nav li.ui-state-hover a',
	            '.eltd-ls-archive-items-inner article .eltd-listing-rating-holder .eltd-average-rating>span',
	            '.eltd-login-register-content .eltd-login-form-social-login button.eltd-btn:hover',
	            '.widget.eltd-login-register-widget .eltd-logged-in-user .icon_profile',
	            '.widget.eltd-login-register-widget .eltd-login-holder .icon_profile',
	            '.eltd-light-header:not(.eltd-fixed-header-appear):not(.eltd-sticky-header-appear) .widget.eltd-login-register-widget .icon_profile:hover',
	            '.page-template-user-dashboard .eltd-membership-dashboard-content-holder #job-manager-job-dashboard .job-manager-pagination ul li .current:hover',
	            '.page-template-user-dashboard .eltd-membership-dashboard-content-holder #job-manager-job-dashboard .job-manager-pagination ul li a:hover',
	            '.page-template-user-dashboard .eltd-membership-dashboard-content-holder #job-manager-job-dashboard .job-manager-pagination ul li .current',
	            '.eltd-ls-archive-filter-item .eltd-listing-type-amenity-field input[type=checkbox]:checked~label .eltd-label-view',
	            '.eltd-listing-rating-holder .eltd-average-rating>span',
	            '.eltd-ls-adv-search-holder .eltd-ls-adv-search-items-holder .eltd-ls-item .eltd-ls-item-inner .eltd-listing-rating-holder .eltd-average-rating>span',
	            '.eltd-ls-list-holder .eltd-ls-list-items-holder .eltd-ls-item .eltd-ls-item-inner .eltd-listing-rating-holder .eltd-average-rating>span',
	            '.eltd-ls-main-search-holder .eltd-ls-main-search-holder-part .eltd-ls-slider-wrapper .rangeslider__handle',
	            '.eltd-ls-slider-holder .eltd-ls-slider-items-holder .eltd-ls-item .eltd-ls-item-inner .eltd-listing-rating-holder .eltd-average-rating>span',
	            '.eltd-ls-single-comments .eltd-comments .eltd-comment-text .eltd-average-rating>span',
	            '.eltd-listing-single-holder article .eltd-ls-tags-wrapper a:hover',
	            '.eltd-listing-single-holder article .eltd-ls-single-related-posts-holder .eltd-ls-related-item .eltd-ls-item-inner .eltd-listing-rating-holder .eltd-average-rating>span',
	            '.eltd-ls-package-holder article .eltd-ls-package-featured',
	            '.eltd-tabs.eltd-tabs-simple .eltd-tabs-nav li.ui-state-active a,.eltd-tabs.eltd-tabs-simple .eltd-tabs-nav li.ui-state-hover a '
            );

            echo findme_elated_dynamic_css($color_selector, array('color' => $first_main_color));
	        echo findme_elated_dynamic_css($color_important_selector, array('color' => $first_main_color.'!important'));
	        echo findme_elated_dynamic_css($background_color_selector, array('background-color' => $first_main_color));
	        echo findme_elated_dynamic_css($border_color_selector, array('border-color' => $first_main_color));
        }

        $page_background_color = findme_elated_options()->getOptionValue('page_background_color');
		if (!empty($page_background_color)) {
			$background_color_selector = array(
				'.eltd-wrapper-inner',
				'.eltd-content'
			);
			echo findme_elated_dynamic_css($background_color_selector, array('background-color' => $page_background_color));
		}

		$selection_color = findme_elated_options()->getOptionValue('selection_color');
		if (!empty($selection_color)) {
			echo findme_elated_dynamic_css('::selection', array('background' => $selection_color));
			echo findme_elated_dynamic_css('::-moz-selection', array('background' => $selection_color));
		}

		$boxed_background_style = array();
	    $boxed_page_background_color = findme_elated_options()->getOptionValue('page_background_color_in_box');
		if (!empty($boxed_page_background_color)) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
	
	    $boxed_page_background_image = findme_elated_options()->getOptionValue('boxed_background_image');
		if (!empty($boxed_page_background_image)) {
			$boxed_background_style['background-image'] = 'url('.esc_url($boxed_page_background_image).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}
	
	    $boxed_page_background_pattern_image = findme_elated_options()->getOptionValue('boxed_pattern_background_image');
		if (!empty($boxed_page_background_pattern_image)) {
			$boxed_background_style['background-image'] = 'url('.esc_url($boxed_page_background_pattern_image).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}
	
	    $boxed_page_background_attachment = findme_elated_options()->getOptionValue('boxed_background_image_attachment');
		if (!empty($boxed_page_background_attachment)) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}

		echo findme_elated_dynamic_css('.eltd-boxed .eltd-wrapper', $boxed_background_style);

        $paspartu_style = array();
	    $paspartu_color = findme_elated_options()->getOptionValue('paspartu_color');
        if (!empty($paspartu_color)) {
            $paspartu_style['background-color'] = $paspartu_color;
        }
	
	    $paspartu_width = findme_elated_options()->getOptionValue('paspartu_width');
        if ($paspartu_width !== '') {
            $paspartu_style['padding'] = $paspartu_width.'%';
        }

        echo findme_elated_dynamic_css('.eltd-paspartu-enabled .eltd-wrapper', $paspartu_style);
    }

    add_action('findme_elated_style_dynamic', 'findme_elated_design_styles');
}

if(!function_exists('findme_elated_content_styles')) {
    /**
     * Generates content custom styles
     */
    function findme_elated_content_styles() {
        $content_style = array();
	    
	    $padding_top = findme_elated_options()->getOptionValue('content_top_padding');
	    if ($padding_top !== '') {
            $content_style['padding-top'] = findme_elated_filter_px($padding_top).'px';
        }

        $content_selector = array(
            '.eltd-content .eltd-content-inner > .eltd-full-width > .eltd-full-width-inner',
        );

        echo findme_elated_dynamic_css($content_selector, $content_style);

        $content_style_in_grid = array();
	    
	    $padding_top_in_grid = findme_elated_options()->getOptionValue('content_top_padding_in_grid');
	    if ($padding_top_in_grid !== '') {
            $content_style_in_grid['padding-top'] = findme_elated_filter_px($padding_top_in_grid).'px';
        }

        $content_selector_in_grid = array(
            '.eltd-content .eltd-content-inner > .eltd-container > .eltd-container-inner',
        );

        echo findme_elated_dynamic_css($content_selector_in_grid, $content_style_in_grid);
    }

    add_action('findme_elated_style_dynamic', 'findme_elated_content_styles');
}

if (!function_exists('findme_elated_h1_styles')) {

    function findme_elated_h1_styles() {
	    $margin_top = findme_elated_options()->getOptionValue('h1_margin_top');
	    $margin_bottom = findme_elated_options()->getOptionValue('h1_margin_bottom');
	    
	    $item_styles = findme_elated_get_typography_styles('h1');
	    
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = findme_elated_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = findme_elated_filter_px($margin_bottom).'px';
	    }
	    
	    $item_selector = array(
		    'h1'
	    );
	
	    echo findme_elated_dynamic_css($item_selector, $item_styles);
    }

    add_action('findme_elated_style_dynamic', 'findme_elated_h1_styles');
}

if (!function_exists('findme_elated_h2_styles')) {

    function findme_elated_h2_styles() {
	    $margin_top = findme_elated_options()->getOptionValue('h2_margin_top');
	    $margin_bottom = findme_elated_options()->getOptionValue('h2_margin_bottom');
	
	    $item_styles = findme_elated_get_typography_styles('h2');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = findme_elated_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = findme_elated_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h2'
	    );
	
	    echo findme_elated_dynamic_css($item_selector, $item_styles);
    }

    add_action('findme_elated_style_dynamic', 'findme_elated_h2_styles');
}

if (!function_exists('findme_elated_h3_styles')) {

    function findme_elated_h3_styles() {
	    $margin_top = findme_elated_options()->getOptionValue('h3_margin_top');
	    $margin_bottom = findme_elated_options()->getOptionValue('h3_margin_bottom');
	
	    $item_styles = findme_elated_get_typography_styles('h3');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = findme_elated_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = findme_elated_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h3'
	    );
	
	    echo findme_elated_dynamic_css($item_selector, $item_styles);
    }

    add_action('findme_elated_style_dynamic', 'findme_elated_h3_styles');
}

if (!function_exists('findme_elated_h4_styles')) {

    function findme_elated_h4_styles() {
	    $margin_top = findme_elated_options()->getOptionValue('h4_margin_top');
	    $margin_bottom = findme_elated_options()->getOptionValue('h4_margin_bottom');
	
	    $item_styles = findme_elated_get_typography_styles('h4');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = findme_elated_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = findme_elated_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h4'
	    );
	
	    echo findme_elated_dynamic_css($item_selector, $item_styles);
    }

    add_action('findme_elated_style_dynamic', 'findme_elated_h4_styles');
}

if (!function_exists('findme_elated_h5_styles')) {

    function findme_elated_h5_styles() {
	    $margin_top = findme_elated_options()->getOptionValue('h5_margin_top');
	    $margin_bottom = findme_elated_options()->getOptionValue('h5_margin_bottom');
	
	    $item_styles = findme_elated_get_typography_styles('h5');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = findme_elated_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = findme_elated_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h5'
	    );
	
	    echo findme_elated_dynamic_css($item_selector, $item_styles);
    }

    add_action('findme_elated_style_dynamic', 'findme_elated_h5_styles');
}

if (!function_exists('findme_elated_h6_styles')) {

    function findme_elated_h6_styles() {
	    $margin_top = findme_elated_options()->getOptionValue('h6_margin_top');
	    $margin_bottom = findme_elated_options()->getOptionValue('h6_margin_bottom');
	
	    $item_styles = findme_elated_get_typography_styles('h6');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = findme_elated_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = findme_elated_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h6'
	    );
	
	    echo findme_elated_dynamic_css($item_selector, $item_styles);
    }

    add_action('findme_elated_style_dynamic', 'findme_elated_h6_styles');
}

if (!function_exists('findme_elated_text_styles')) {

    function findme_elated_text_styles() {
	    $item_styles = findme_elated_get_typography_styles('text');
	
	    $item_selector = array(
		    'p'
	    );
	
	    echo findme_elated_dynamic_css($item_selector, $item_styles);
    }

    add_action('findme_elated_style_dynamic', 'findme_elated_text_styles');
}

if (!function_exists('findme_elated_link_styles')) {

    function findme_elated_link_styles() {
        $link_styles = array();

        if(findme_elated_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = findme_elated_options()->getOptionValue('link_color');
        }
        if(findme_elated_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = findme_elated_options()->getOptionValue('link_fontstyle');
        }
        if(findme_elated_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = findme_elated_options()->getOptionValue('link_fontweight');
        }
        if(findme_elated_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = findme_elated_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo findme_elated_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('findme_elated_style_dynamic', 'findme_elated_link_styles');
}

if (!function_exists('findme_elated_link_hover_styles')) {

    function findme_elated_link_hover_styles() {
        $link_hover_styles = array();

        if(findme_elated_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = findme_elated_options()->getOptionValue('link_hovercolor');
        }
        if(findme_elated_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = findme_elated_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo findme_elated_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(findme_elated_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = findme_elated_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo findme_elated_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('findme_elated_style_dynamic', 'findme_elated_link_hover_styles');
}

if (!function_exists('findme_elated_smooth_page_transition_styles')) {

    function findme_elated_smooth_page_transition_styles($style) {
        $id = findme_elated_get_page_id();
    	$loader_style = array();
		$current_style = '';

        if(findme_elated_get_meta_field_intersect('smooth_pt_bgnd_color',$id) !== '') {
            $loader_style['background-color'] = findme_elated_get_meta_field_intersect('smooth_pt_bgnd_color',$id);
        }

        $loader_selector = array('.eltd-smooth-transition-loader');

        if (!empty($loader_style)) {
			$current_style .= findme_elated_dynamic_css($loader_selector, $loader_style);
        }

        $spinner_style = array();

        if(findme_elated_get_meta_field_intersect('smooth_pt_spinner_color',$id) !== '') {
            $spinner_style['background-color'] = findme_elated_get_meta_field_intersect('smooth_pt_spinner_color',$id);
        }

        $spinner_selectors = array(
            '.eltd-st-loader .eltd-rotate-circles > div',
            '.eltd-st-loader .pulse',
            '.eltd-st-loader .double_pulse .double-bounce1',
            '.eltd-st-loader .double_pulse .double-bounce2',
            '.eltd-st-loader .cube',
            '.eltd-st-loader .rotating_cubes .cube1',
            '.eltd-st-loader .rotating_cubes .cube2',
            '.eltd-st-loader .stripes > div',
            '.eltd-st-loader .wave > div',
            '.eltd-st-loader .two_rotating_circles .dot1',
            '.eltd-st-loader .two_rotating_circles .dot2',
            '.eltd-st-loader .five_rotating_circles .container1 > div',
            '.eltd-st-loader .five_rotating_circles .container2 > div',
            '.eltd-st-loader .five_rotating_circles .container3 > div',
            '.eltd-st-loader .atom .ball-1:before',
            '.eltd-st-loader .atom .ball-2:before',
            '.eltd-st-loader .atom .ball-3:before',
            '.eltd-st-loader .atom .ball-4:before',
            '.eltd-st-loader .clock .ball:before',
            '.eltd-st-loader .mitosis .ball',
            '.eltd-st-loader .lines .line1',
            '.eltd-st-loader .lines .line2',
            '.eltd-st-loader .lines .line3',
            '.eltd-st-loader .lines .line4',
            '.eltd-st-loader .fussion .ball',
            '.eltd-st-loader .fussion .ball-1',
            '.eltd-st-loader .fussion .ball-2',
            '.eltd-st-loader .fussion .ball-3',
            '.eltd-st-loader .fussion .ball-4',
            '.eltd-st-loader .wave_circles .ball',
            '.eltd-st-loader .pulse_circles .ball'
        );

        if (!empty($spinner_style)) {
			$current_style .= findme_elated_dynamic_css($spinner_selectors, $spinner_style);
        }

		$current_style = $current_style . $style;

		return $current_style;
    }

    add_filter('findme_elated_add_page_custom_style', 'findme_elated_smooth_page_transition_styles');
}