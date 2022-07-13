(function($) {
	'use strict';

	var listingSingle = {};
	eltd.modules.listingSingle = listingSingle;

	listingSingle.eltdOnDocumentReady = eltdOnDocumentReady;

	$(document).ready(eltdOnDocumentReady);
	
	
	listingSingle.eltdInitCommentRating = eltdInitCommentRating;
	listingSingle.eltdInitCommentSorting = eltdInitCommentSorting;
	listingSingle.eltdShowHideEnquiryForm = eltdShowHideEnquiryForm;
	listingSingle.eltdSubmitEnquiryForm = eltdSubmitEnquiryForm;

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitCommentRating();
		eltdInitCommentSorting();
		eltdShowHideEnquiryForm();
		eltdSubmitEnquiryForm();
	}
	
	function eltdInitCommentRating() {

		var article = $('.eltd-listing-single-holder .eltd-ls-single-item'),
			ratingInput = article.find('#eltd-rating'),
			ratingValue = ratingInput.val(),
			stars = article.find('.eltd-star-rating');

		var addActive = function() {
			for ( var i = 0; i < stars.length; i++ ) {
				var star = stars[i];
				if ( i < ratingValue ) {
					$(star).addClass('active');
				} else {
					$(star).removeClass('active');
				}
			}
		};

		addActive();

		stars.on('click',function(){
			ratingInput.val( $(this).data('value')).trigger('change');
		});

		ratingInput.change(function(){
			ratingValue = ratingInput.val();
			addActive();
		});

	}

	function eltdInitCommentSorting(){

		var articles = $('.eltd-ls-single-item');

		if(articles.length){
			articles.each(function(){
				var article = $(this),
					postId = article.attr('id'),
					selectButton = article.find('.eltd-ls-single-comments .eltd-ls-single-sort'),
					holder = article.find('.eltd-ls-single-comments .eltd-comment-list');

					selectButton.on('change', function(){
						var value = $(this).val();
						if(eltd.modules.listings.eltdIsValidObject(value)){
							holder.fadeOut(300);
							var result = value.split('-'),
								orderBy = result[0],
								order = result[1],
								ajaxData = {
									action: 'eltd_listing_get_post_reviews_ajax',
									order : order,
									orderBy : orderBy,
									postId : postId
								};

							$.ajax({
								type: "POST",
								url: ElatedListingAjaxUrl,
								data: ajaxData,
								success: function (data) {
									if (data === 'error') {
										//error handler
									}else{
										//set new item in global var
										var response = $.parseJSON(data);
										var responseHtml = response.html;
										holder.fadeIn(300, function(){
											holder.html(responseHtml);
										});
									}
								}
							});
						}
					});

			});
		}
	}

	function eltdShowHideEnquiryForm(){
		var article = $('.eltd-ls-single-item'),
			enquiryHolder = $('.eltd-ls-enquiry-holder'),
			button = article.find('.eltd-ls-single-contact-listing'),
			buttonClose = $('.eltd-ls-enquiry-close');

		button.on('click', function() {
			enquiryHolder.fadeIn(300);
			enquiryHolder.addClass('opened');
		});

		enquiryHolder.add(buttonClose).on('click', function() {
			if(enquiryHolder.hasClass('opened')){
				enquiryHolder.fadeOut(300);
				enquiryHolder.removeClass('opened');
			}
		});

		$(".eltd-ls-enquiry-inner").on('click',function(e) {
			e.stopPropagation();
		});
		// on esc too
		$(window).on('keyup', function(e){
			if ( enquiryHolder.hasClass( 'opened' ) && e.keyCode == 27 ) {
				enquiryHolder.fadeOut(300);
				enquiryHolder.removeClass('opened');
			}
		});

	}

	function eltdSubmitEnquiryForm(){
		var enquiryHolder = $('.eltd-ls-enquiry-holder'),
			enquiryMessageHolder = $('.eltd-listing-enquiry-response'),
			enquiryForm = enquiryHolder.find('.eltd-ls-enquiry-form');


		enquiryForm.on('submit', function(){
			enquiryMessageHolder.empty();
			var enquiryData = {
				name: enquiryForm.find('#enquiry-name').val(),
				email: enquiryForm.find('#enquiry-email').val(),
				message: enquiryForm.find('#enquiry-message').val(),
				itemId: enquiryForm.find('#enquiry-item-id').val(),
				nonce: enquiryForm.find('#eltd_nonce_listing_item_enquiry').val()
			};

			var requestData = {
				action: 'eltd_listing_send_listing_item_enquiry',
				data: enquiryData
			};

			$.ajax({
				type: "POST",
				url: ElatedListingAjaxUrl,
				data: requestData,
				success: function (response) {
					if (data === 'error') {
						enquiryMessageHolder.html(response.data);
						//error handler
					}else{
						enquiryMessageHolder.html(response.data);
						enquiryForm.fadeOut(300);
						setTimeout(function(){
							enquiryForm.remove();
						}, 300);
					}
				}
			});
		});

	}
	

})(jQuery);