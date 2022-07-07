(function ($) {
	"use strict";

	var blog = {};
	eltd.modules.blog = blog;

	blog.eltdOnDocumentReady = eltdOnDocumentReady;
	blog.eltdOnWindowLoad = eltdOnWindowLoad;
	blog.eltdOnWindowResize = eltdOnWindowResize;
	blog.eltdOnWindowScroll = eltdOnWindowScroll;

	$(document).ready(eltdOnDocumentReady);
	$(window).on('load', eltdOnWindowLoad);
	$(window).resize(eltdOnWindowResize);
	$(window).scroll(eltdOnWindowScroll);

	/* 
		All functions to be called on $(document).ready() should be in this function
	*/
	function eltdOnDocumentReady() {
		eltdInitAudioPlayer();
		eltdInitBlogMasonry();
		eltdInitBlogListMasonry();
		eltdInitBlogMasonryGallery();
	}

	/* 
		All functions to be called on $(window).on('load', ) should be in this function
	*/
	function eltdOnWindowLoad() {
		eltdInitBlogPagination().init();
		eltdInitBlogListShortcodePagination().init();
		eltdInitBlogChequered();
		eltdInitBlogMasonryGalleryAppear();
		eltdInitBlogNarrowAppear();
	}

	/* 
		All functions to be called on $(window).resize() should be in this function
	*/
	function eltdOnWindowResize() {
		eltdInitBlogMasonry();
		eltdInitBlogMasonryGallery();
	}

	/* 
		All functions to be called on $(window).scroll() should be in this function
	*/
	function eltdOnWindowScroll() {
		eltdInitBlogPagination().scroll();
		eltdInitBlogListShortcodePagination().scroll();
	}

	/**
	* Init audio player for Blog list and single pages
	*/
	function eltdInitAudioPlayer() {
		var players = $('audio.eltd-blog-audio');

		players.mediaelementplayer({
			audioWidth: '100%'
		});
	}

	/**
	 * Init Resize Blog Items
	 */
	function eltdResizeBlogItems(size, container) {

		if (container.hasClass('eltd-masonry-images-fixed')) {
			var padding = parseInt(container.find('article').css('padding-left')),
				defaultMasonryItem = container.find('.eltd-post-size-default'),
				largeWidthMasonryItem = container.find('.eltd-post-size-large-width'),
				largeHeightMasonryItem = container.find('.eltd-post-size-large-height'),
				largeWidthHeightMasonryItem = container.find('.eltd-post-size-large-width-height');

			if (eltd.windowWidth > 680) {
				defaultMasonryItem.css('height', size - 2 * padding);
				largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthMasonryItem.css('height', size - 2 * padding);
			} else {
				defaultMasonryItem.css('height', size);
				largeHeightMasonryItem.css('height', size);
				largeWidthHeightMasonryItem.css('height', size);
				largeWidthMasonryItem.css('height', Math.round(size / 2));
			}
		}
	}

	/**
	* Init Blog Masonry Layout
	*/
	function eltdInitBlogMasonry() {
		var holder = $('.eltd-blog-holder.eltd-blog-type-masonry');

		if (holder.length) {
			holder.each(function () {
				var thisHolder = $(this),
					masonry = thisHolder.children('.eltd-blog-holder-inner'),
					size = thisHolder.find('.eltd-blog-masonry-grid-sizer').width();

				eltdResizeBlogItems(size, thisHolder);

				masonry.waitForImages(function () {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: 'article',
						percentPosition: true,
						packery: {
							gutter: '.eltd-blog-masonry-grid-gutter',
							columnWidth: '.eltd-blog-masonry-grid-sizer'
						}
					});
					masonry.css('opacity', '1');
				});
			});
		}
	}

	/**
	 *  Init Blog Chequered
	 */
	function eltdInitBlogChequered() {
		var container = $('.eltd-blog-holder.eltd-blog-chequered');
		var masonry = container.children('.eltd-blog-holder-inner');
		var newSize;

		if (container.length) {
			newSize = masonry.find('.eltd-blog-masonry-grid-sizer').outerWidth();
			masonry.children('article').css({ 'height': (newSize) + 'px' });
			masonry.isotope('layout', function () {
				masonry.css('opacity', '1');
			});
		}
	}


	/**
	 *  Init Blog Masonry Gallery
	 *
	 *  Function that sets equal height of articles on blog masonry gallery list
	 */
	function eltdInitBlogMasonryGallery() {
		var blogList = $('.eltd-blog-holder.eltd-blog-masonry-gallery');
		if (blogList.length) {
			blogList.each(function () {

				var container = $(this),
					masonry = container.children('.eltd-blog-holder-inner'),
					article = masonry.find('article'),
					size = masonry.find('.eltd-blog-masonry-grid-sizer').width() * 1.25;

				article.css({ 'height': (size) + 'px' });

				masonry.isotope('layout', function () { });
				eltdInitBlogMasonryGalleryAppear();
			});
		}
	}

	/**
	 *  Animate blog masonry gallery type
	 */
	function eltdInitBlogMasonryGalleryAppear() {
		var blogList = $('.eltd-blog-holder.eltd-blog-masonry-gallery');
		if (blogList.length) {
			blogList.each(function () {
				var thisBlogList = $(this),
					article = thisBlogList.find('article'),
					pagination = thisBlogList.find('.eltd-blog-pagination-holder'),
					animateCycle = 7, // rewind delay
					animateCycleCounter = 0;

				article.each(function () {
					var thisArticle = $(this);
					setTimeout(function () {
						thisArticle.appear(function () {
							animateCycleCounter++;
							if (animateCycleCounter == animateCycle) {
								animateCycleCounter = 0;
							}
							setTimeout(function () {
								thisArticle.addClass('eltd-appeared');
							}, animateCycleCounter * 200);
						}, { accX: 0, accY: 0 });
					}, 150);
				});

				pagination.appear(function () {
					pagination.addClass('eltd-appeared');
				}, { accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount });

			});
		}
	}

	/**
	 *  Animate blog narrow articles on appear
	 */
	function eltdInitBlogNarrowAppear() {
		var blogList = $('.eltd-blog-holder.eltd-blog-narrow');
		if (blogList.length) {
			blogList.each(function () {
				var thisBlogList = $(this),
					article = thisBlogList.find('article'),
					pagination = thisBlogList.find('.eltd-blog-pagination-holder');

				article.each(function () {
					var thisArticle = $(this);
					thisArticle.appear(function () {
						thisArticle.addClass('eltd-appeared');
					}, { accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount });
				});

				pagination.appear(function () {
					pagination.addClass('eltd-appeared');
				}, { accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount });

			});
		}
	}


	/**
	 * Initializes blog pagination functions
	 */
	function eltdInitBlogPagination() {
		var holder = $('.eltd-blog-holder');

		var initLoadMorePagination = function (thisHolder) {
			var loadMoreButton = thisHolder.find('.eltd-blog-pag-load-more a');

			loadMoreButton.on('click', function (e) {
				e.preventDefault();
				e.stopPropagation();

				initMainPagFunctionality(thisHolder);
			});
		};

		var initInifiteScrollPagination = function (thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - eltdGlobalVars.vars.eltdAddForAdminBar;

			if (!thisHolder.hasClass('eltd-blog-pagination-infinite-scroll-started') && eltd.scroll + eltd.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};

		var initMainPagFunctionality = function (thisHolder) {
			var thisHolderInner = thisHolder.children('.eltd-blog-holder-inner'),
				nextPage,
				maxNumPages;

			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}

			if (thisHolder.hasClass('eltd-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('eltd-blog-pagination-infinite-scroll-started');
			}

			var loadMoreDatta = eltd.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.eltd-blog-pag-loading');

			nextPage = loadMoreDatta.nextPage;

			if (nextPage <= maxNumPages) {
				loadingItem.addClass('eltd-showing');

				var ajaxData = eltd.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'findme_elated_blog_load_more');

				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: eltdGlobalVars.vars.eltdAjaxUrl,
					success: function (data) {
						nextPage++;

						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml = response.html;

						thisHolder.waitForImages(function () {
							if (thisHolder.hasClass('eltd-blog-type-masonry')) {
								eltdInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								eltdResizeBlogItems(thisHolderInner.find('.eltd-blog-masonry-grid-sizer').width(), thisHolder);
							} else {
								eltdInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}

							setTimeout(function () {
								eltdInitAudioPlayer();
								eltd.modules.common.eltdOwlSlider();
								eltd.modules.common.eltdFluidVideo();
								eltdInitBlogNarrowAppear();
								eltdInitBlogMasonryGalleryAppear();
								eltdInitBlogChequered();
							}, 400);
						});

						if (thisHolder.hasClass('eltd-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('eltd-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}

			if (nextPage === maxNumPages) {
				thisHolder.find('.eltd-blog-pag-load-more').hide();
			}
		};

		var eltdInitAppendIsotopeNewContent = function (thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({ sortBy: 'original-order' });
			loadingItem.removeClass('eltd-showing');

			setTimeout(function () {
				thisHolderInner.isotope('layout');
			}, 400);
		};

		var eltdInitAppendGalleryNewContent = function (thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltd-showing');
			thisHolderInner.append(responseHtml);
		};

		return {
			init: function () {
				if (holder.length) {
					holder.each(function () {
						var thisHolder = $(this);

						if (thisHolder.hasClass('eltd-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}

						if (thisHolder.hasClass('eltd-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function () {
				if (holder.length) {
					holder.each(function () {
						var thisHolder = $(this);

						if (thisHolder.hasClass('eltd-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

	/**
	 * Init blog list shortcode masonry layout
	 */
	function eltdInitBlogListMasonry() {
		var holder = $('.eltd-blog-list-holder.eltd-bl-masonry');

		if (holder.length) {
			holder.each(function () {
				var thisHolder = $(this),
					masonry = thisHolder.find('.eltd-blog-list');

				masonry.waitForImages(function () {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.eltd-bl-item',
						percentPosition: true,
						packery: {
							gutter: '.eltd-bl-grid-gutter',
							columnWidth: '.eltd-bl-grid-sizer'
						}
					});

					masonry.css('opacity', '1');
				});
			});
		}
	}

	/**
	 * Init blog list shortcode pagination functions
	 */
	function eltdInitBlogListShortcodePagination() {
		var holder = $('.eltd-blog-list-holder');

		var initStandardPagination = function (thisHolder) {
			var standardLink = thisHolder.find('.eltd-bl-standard-pagination li');

			if (standardLink.length) {
				standardLink.each(function () {
					var thisLink = $(this).children('a'),
						pagedLink = 1;

					thisLink.on('click', function (e) {
						e.preventDefault();
						e.stopPropagation();

						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}

						initMainPagFunctionality(thisHolder, pagedLink);
					});
				});
			}
		};

		var initLoadMorePagination = function (thisHolder) {
			var loadMoreButton = thisHolder.find('.eltd-blog-pag-load-more a');

			loadMoreButton.on('click', function (e) {
				e.preventDefault();
				e.stopPropagation();

				initMainPagFunctionality(thisHolder);
			});
		};

		var initInifiteScrollPagination = function (thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - eltdGlobalVars.vars.eltdAddForAdminBar;

			if (!thisHolder.hasClass('eltd-bl-pag-infinite-scroll-started') && eltd.scroll + eltd.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};

		var initMainPagFunctionality = function (thisHolder, pagedLink) {
			var thisHolderInner = thisHolder.find('.eltd-blog-list'),
				nextPage,
				maxNumPages;

			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}

			if (thisHolder.hasClass('eltd-bl-pag-standard-blog-list')) {
				thisHolder.data('next-page', pagedLink);
			}

			if (thisHolder.hasClass('eltd-bl-pag-infinite-scroll')) {
				thisHolder.addClass('eltd-bl-pag-infinite-scroll-started');
			}

			var loadMoreDatta = eltd.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.eltd-blog-pag-loading');

			nextPage = loadMoreDatta.nextPage;

			if (nextPage <= maxNumPages) {
				if (thisHolder.hasClass('eltd-bl-pag-standard-blog-list')) {
					loadingItem.addClass('eltd-showing eltd-standard-pag-trigger');
					thisHolder.addClass('eltd-bl-pag-standard-blog-list-animate');
				} else {
					loadingItem.addClass('eltd-showing');
				}

				var ajaxData = eltd.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'findme_elated_blog_shortcode_load_more');

				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: eltdGlobalVars.vars.eltdAjaxUrl,
					success: function (data) {
						if (!thisHolder.hasClass('eltd-bl-pag-standard-blog-list')) {
							nextPage++;
						}

						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml = response.html;

						if (thisHolder.hasClass('eltd-bl-pag-standard-blog-list')) {
							eltdInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);

							thisHolder.waitForImages(function () {
								if (thisHolder.hasClass('eltd-bl-masonry')) {
									eltdInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								} else {
									eltdInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisHolder.waitForImages(function () {
								if (thisHolder.hasClass('eltd-bl-masonry')) {
									eltdInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								} else {
									eltdInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
								}
							});
						}

						if (thisHolder.hasClass('eltd-bl-pag-infinite-scroll-started')) {
							thisHolder.removeClass('eltd-bl-pag-infinite-scroll-started');
						}
					}
				});
			}

			if (nextPage === maxNumPages) {
				thisHolder.find('.eltd-blog-pag-load-more').hide();
			}
		};

		var eltdInitStandardPaginationLinkChanges = function (thisHolder, maxNumPages, nextPage) {
			var standardPagHolder = thisHolder.find('.eltd-bl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.eltd-bl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.eltd-bl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.eltd-bl-pag-next a');

			standardPagNumericItem.removeClass('eltd-bl-pag-active');
			standardPagNumericItem.eq(nextPage - 1).addClass('eltd-bl-pag-active');

			standardPagPrevItem.data('paged', nextPage - 1);
			standardPagNextItem.data('paged', nextPage + 1);

			if (nextPage > 1) {
				standardPagPrevItem.css({ 'opacity': '1' });
			} else {
				standardPagPrevItem.css({ 'opacity': '0' });
			}

			if (nextPage === maxNumPages) {
				standardPagNextItem.css({ 'opacity': '0' });
			} else {
				standardPagNextItem.css({ 'opacity': '1' });
			}
		};

		var eltdInitHtmlIsotopeNewContent = function (thisHolder, thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({ sortBy: 'original-order' });
			loadingItem.removeClass('eltd-showing eltd-standard-pag-trigger');
			thisHolder.removeClass('eltd-bl-pag-standard-blog-list-animate');

			setTimeout(function () {
				thisHolderInner.isotope('layout');
			}, 400);
		};

		var eltdInitHtmlGalleryNewContent = function (thisHolder, thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltd-showing eltd-standard-pag-trigger');
			thisHolder.removeClass('eltd-bl-pag-standard-blog-list-animate');
			thisHolderInner.html(responseHtml);
		};

		var eltdInitAppendIsotopeNewContent = function (thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({ sortBy: 'original-order' });
			loadingItem.removeClass('eltd-showing');

			setTimeout(function () {
				thisHolderInner.isotope('layout');
			}, 400);
		};

		var eltdInitAppendGalleryNewContent = function (thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltd-showing');
			thisHolderInner.append(responseHtml);
		};

		return {
			init: function () {
				if (holder.length) {
					holder.each(function () {
						var thisHolder = $(this);

						if (thisHolder.hasClass('eltd-bl-pag-standard-blog-list')) {
							initStandardPagination(thisHolder);
						}

						if (thisHolder.hasClass('eltd-bl-pag-load-more')) {
							initLoadMorePagination(thisHolder);
						}

						if (thisHolder.hasClass('eltd-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function () {
				if (holder.length) {
					holder.each(function () {
						var thisHolder = $(this);

						if (thisHolder.hasClass('eltd-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);