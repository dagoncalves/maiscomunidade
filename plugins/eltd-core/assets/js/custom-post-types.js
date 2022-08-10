(function ($) {
    'use strict';

    var portfolio = {};
    eltd.modules.portfolio = portfolio;

    portfolio.eltdOnDocumentReady = eltdOnDocumentReady;
    portfolio.eltdOnWindowLoad = eltdOnWindowLoad;
    portfolio.eltdOnWindowResize = eltdOnWindowResize;
    portfolio.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).on('load', eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdOnDocumentReady() {
    }

    /*
     All functions to be called on $(window).on('load', ) should be in this function
     */
    function eltdOnWindowLoad() {
        eltdInitPortfolioMasonry();
        eltdInitPortfolioFilter();
        initPortfolioSingleMasonry();
        eltdInitPortfolioListAnimation();
        eltdInitPortfolioPagination().init();
        eltdPortfolioSingleFollow().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function eltdOnWindowResize() {
        eltdInitPortfolioMasonry();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function eltdOnWindowScroll() {
        eltdInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function eltdInitPortfolioListAnimation() {
        var portList = $('.eltd-portfolio-list-holder.eltd-pl-has-animation');

        if (portList.length) {
            portList.each(function () {
                var thisPortList = $(this).children('.eltd-pl-inner');

                thisPortList.children('article').each(function (l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function () {
                        thisArticle.addClass('eltd-item-show');

                        setTimeout(function () {
                            thisArticle.addClass('eltd-item-shown');
                        }, 1000);
                    }, { accX: 0, accY: 0 });
                });
            });
        }
    }

    /**
     * Initializes portfolio list
     */
    function eltdInitPortfolioMasonry() {
        var portList = $('.eltd-portfolio-list-holder.eltd-pl-masonry');

        if (portList.length) {
            portList.each(function () {
                var thisPortList = $(this),
                    masonry = thisPortList.children('.eltd-pl-inner'),
                    size = thisPortList.find('.eltd-pl-grid-sizer').width();

                eltdResizePortfolioItems(size, thisPortList);

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.eltd-pl-grid-gutter',
                        columnWidth: '.eltd-pl-grid-sizer'
                    }
                });

                setTimeout(function () {
                    eltd.modules.parallax.eltdInitParallax();
                });

                masonry.css('opacity', '1');
            });
        }
    }

    /**
     * Init Resize Blog Items
     */
    function eltdResizePortfolioItems(size, container) {
        if (container.hasClass('eltd-pl-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.eltd-pl-masonry-default'),
                largeWidthMasonryItem = container.find('.eltd-pl-masonry-large-width'),
                largeHeightMasonryItem = container.find('.eltd-pl-masonry-large-height'),
                largeWidthHeightMasonryItem = container.find('.eltd-pl-masonry-large-width-height');

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
     * Initializes portfolio masonry filter
     */
    function eltdInitPortfolioFilter() {
        var filterHolder = $('.eltd-portfolio-list-holder .eltd-pl-filter-holder');

        if (filterHolder.length) {
            filterHolder.each(function () {
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.eltd-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.eltd-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('eltd-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.eltd-pl-filter:first').addClass('eltd-pl-current');

                if (thisPortListHolder.hasClass('eltd-pl-gallery')) {
                    thisPortListInner.isotope();
                }

                thisFilterHolder.find('.eltd-pl-filter').on('click', function () {
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
                        portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.eltd-pl-filter').removeClass('eltd-pl-current');
                    thisFilter.addClass('eltd-pl-current');

                    if (portListHasLoadMore && !portListHasArtciles) {
                        eltdInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
                    } else {
                        thisFilterHolder.parent().children('.eltd-pl-inner').isotope({ filter: filterValue });
                        eltd.modules.parallax.eltdInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function eltdInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {
        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.eltd-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var loadMoreDatta = eltd.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
            ajaxData = eltd.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'eltd_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.eltd-pl-loading');

        if (nextPage <= maxNumPages) {
            loadingItem.addClass('eltd-showing eltd-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: eltdGlobalVars.vars.eltdAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({ sortBy: 'original-order' });
                        var portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                        if (portListHasArtciles) {
                            setTimeout(function () {
                                eltdResizePortfolioItems(thisPortListInner.find('.eltd-pl-grid-sizer').width(), thisPortList);
                                thisPortListInner.isotope('layout').isotope({ filter: filterValue });
                                loadingItem.removeClass('eltd-showing eltd-filter-trigger');

                                setTimeout(function () {
                                    thisPortListInner.css('opacity', '1');
                                    eltd.modules.parallax.eltdInitParallax();
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('eltd-showing eltd-filter-trigger');
                            eltdInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }

    /**
     * Initializes portfolio pagination functions
     */
    function eltdInitPortfolioPagination() {
        var portList = $('.eltd-portfolio-list-holder');

        var initStandardPagination = function (thisPortList) {
            var standardLink = thisPortList.find('.eltd-pl-standard-pagination li');

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

                        initMainPagFunctionality(thisPortList, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function (thisPortList) {
            var loadMoreButton = thisPortList.find('.eltd-pl-load-more a');

            loadMoreButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisPortList);
            });
        };

        var initInifiteScrollPagination = function (thisPortList) {
            var portListHeight = thisPortList.outerHeight(),
                portListTopOffest = thisPortList.offset().top,
                portListPosition = portListHeight + portListTopOffest - eltdGlobalVars.vars.eltdAddForAdminBar;

            if (!thisPortList.hasClass('eltd-pl-infinite-scroll-started') && eltd.scroll + eltd.windowHeight > portListPosition) {
                initMainPagFunctionality(thisPortList);
            }
        };

        var initMainPagFunctionality = function (thisPortList, pagedLink) {
            var thisPortListInner = thisPortList.find('.eltd-pl-inner'),
                nextPage,
                maxNumPages;

            if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
                maxNumPages = thisPortList.data('max-num-pages');
            }

            if (thisPortList.hasClass('eltd-pl-pag-standard')) {
                thisPortList.data('next-page', pagedLink);
            }

            if (thisPortList.hasClass('eltd-pl-pag-infinite-scroll')) {
                thisPortList.addClass('eltd-pl-infinite-scroll-started');
            }

            var loadMoreDatta = eltd.modules.common.getLoadMoreData(thisPortList),
                loadingItem = thisPortList.find('.eltd-pl-loading');

            nextPage = loadMoreDatta.nextPage;

            if (nextPage <= maxNumPages) {
                if (thisPortList.hasClass('eltd-pl-pag-standard')) {
                    loadingItem.addClass('eltd-showing eltd-standard-pag-trigger');
                    thisPortList.addClass('eltd-pl-pag-standard-animate');
                } else {
                    loadingItem.addClass('eltd-showing');
                }

                var ajaxData = eltd.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'eltd_core_portfolio_ajax_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: eltdGlobalVars.vars.eltdAjaxUrl,
                    success: function (data) {
                        if (!thisPortList.hasClass('eltd-pl-pag-standard')) {
                            nextPage++;
                        }

                        thisPortList.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml = response.html;

                        if (thisPortList.hasClass('eltd-pl-pag-standard')) {
                            eltdInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);

                            thisPortList.waitForImages(function () {
                                if (thisPortList.hasClass('eltd-pl-masonry')) {
                                    eltdResizePortfolioItems(thisPortListInner.find('.eltd-blog-masonry-grid-sizer').width(), thisPortList);
                                    eltdInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                } else if (thisPortList.hasClass('eltd-pl-gallery') && thisPortList.hasClass('eltd-pl-has-filter')) {
                                    eltdInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                } else {
                                    eltdInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                }
                            });
                        } else {
                            thisPortList.waitForImages(function () {
                                if (thisPortList.hasClass('eltd-pl-masonry')) {
                                    eltdInitAppendIsotopeNewContent(thisPortListInner, loadingItem, responseHtml);
                                } else if (thisPortList.hasClass('eltd-pl-gallery') && thisPortList.hasClass('eltd-pl-has-filter')) {
                                    eltdInitAppendIsotopeNewContent(thisPortListInner, loadingItem, responseHtml);
                                } else {
                                    eltdInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
                                }
                            });
                        }

                        if (thisPortList.hasClass('eltd-pl-infinite-scroll-started')) {
                            thisPortList.removeClass('eltd-pl-infinite-scroll-started');
                        }
                    }
                });
            }

            if (nextPage === maxNumPages) {
                thisPortList.find('.eltd-pl-load-more-holder').hide();
            }
        };

        var eltdInitStandardPaginationLinkChanges = function (thisPortList, maxNumPages, nextPage) {
            var standardPagHolder = thisPortList.find('.eltd-pl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.eltd-pl-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.eltd-pl-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.eltd-pl-pag-next a');

            standardPagNumericItem.removeClass('eltd-pl-pag-active');
            standardPagNumericItem.eq(nextPage - 1).addClass('eltd-pl-pag-active');

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

        var eltdInitHtmlIsotopeNewContent = function (thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.html(responseHtml).isotope('reloadItems').isotope({ sortBy: 'original-order' });
            loadingItem.removeClass('eltd-showing eltd-standard-pag-trigger');
            thisPortList.removeClass('eltd-pl-pag-standard-animate');

            setTimeout(function () {
                thisPortListInner.isotope('layout');
                eltdInitPortfolioListAnimation();
                eltd.modules.parallax.eltdInitParallax();
            }, 400);
        };

        var eltdInitHtmlGalleryNewContent = function (thisPortList, thisPortListInner, loadingItem, responseHtml) {
            loadingItem.removeClass('eltd-showing eltd-standard-pag-trigger');
            thisPortList.removeClass('eltd-pl-pag-standard-animate');
            thisPortListInner.html(responseHtml);
            eltdInitPortfolioListAnimation();
            eltd.modules.parallax.eltdInitParallax();
        };

        var eltdInitAppendIsotopeNewContent = function (thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({ sortBy: 'original-order' });
            loadingItem.removeClass('eltd-showing');

            setTimeout(function () {
                thisPortListInner.isotope('layout');
                eltdInitPortfolioListAnimation();
                eltd.modules.parallax.eltdInitParallax();
            }, 400);
        };

        var eltdInitAppendGalleryNewContent = function (thisPortListInner, loadingItem, responseHtml) {
            loadingItem.removeClass('eltd-showing');
            thisPortListInner.append(responseHtml);
            eltdInitPortfolioListAnimation();
            eltd.modules.parallax.eltdInitParallax();
        };

        return {
            init: function () {
                if (portList.length) {
                    portList.each(function () {
                        var thisPortList = $(this);

                        if (thisPortList.hasClass('eltd-pl-pag-standard')) {
                            initStandardPagination(thisPortList);
                        }

                        if (thisPortList.hasClass('eltd-pl-pag-load-more')) {
                            initLoadMorePagination(thisPortList);
                        }

                        if (thisPortList.hasClass('eltd-pl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisPortList);
                        }
                    });
                }
            },
            scroll: function () {
                if (portList.length) {
                    portList.each(function () {
                        var thisPortList = $(this);

                        if (thisPortList.hasClass('eltd-pl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisPortList);
                        }
                    });
                }
            }
        };
    }

    var eltdPortfolioSingleFollow = function () {

        var info = $('.eltd-follow-portfolio-info .eltd-portfolio-single-holder .eltd-ps-info-sticky-holder');

        if (info.length) {
            var infoHolderOffset = info.offset().top,
                infoHolderHeight = info.height(),
                mediaHolder = $('.eltd-ps-image-holder'),
                mediaHolderHeight = mediaHolder.height(),
                header = $('.header-appear, .eltd-fixed-wrapper'),
                headerHeight = (header.length) ? header.height() : 0;
        }

        var infoHolderPosition = function () {

            if (info.length) {

                if (mediaHolderHeight > infoHolderHeight) {
                    if (eltd.scroll > infoHolderOffset) {
                        var marginTop = eltd.scroll + headerHeight + eltdGlobalVars.vars.eltdAddForAdminBar - infoHolderOffset;
                        // if scroll is initially positioned below mediaHolderHeight
                        if (marginTop + infoHolderHeight > mediaHolderHeight) {
                            marginTop = mediaHolderHeight - infoHolderHeight;
                        }
                        info.animate({
                            marginTop: marginTop
                        });
                    }
                }
            }
        };

        var recalculateInfoHolderPosition = function () {

            if (info.length) {
                if (mediaHolderHeight > infoHolderHeight) {
                    if (eltd.scroll > infoHolderOffset) {

                        if (eltd.scroll + headerHeight + infoHolderHeight < mediaHolderHeight) {
                            //Calculate header height if header appears
                            if ($('.header-appear, .eltd-fixed-wrapper').length) {
                                headerHeight = $('.header-appear, .eltd-fixed-wrapper').height();
                            }
                            info.stop().animate({
                                marginTop: (eltd.scroll + headerHeight + eltdGlobalVars.vars.eltdAddForAdminBar - infoHolderOffset)
                            });
                            //Reset header height
                            headerHeight = 0;
                        } else {
                            info.stop().animate({
                                marginTop: mediaHolderHeight - infoHolderHeight
                            });
                        }
                    } else {
                        info.stop().animate({
                            marginTop: 0
                        });
                    }
                }
            }
        };

        return {
            init: function () {
                infoHolderPosition();
                $(window).scroll(function () {
                    recalculateInfoHolderPosition();
                });
            }
        };
    };

    function initPortfolioSingleMasonry() {
        var masonryHolder = $('.eltd-portfolio-single-holder .eltd-ps-masonry-images'),
            masonry = masonryHolder.children();

        if (masonry.length) {
            masonry.isotope({
                layoutMode: 'packery',
                itemSelector: '.eltd-ps-image',
                percentPosition: true,
                packery: {
                    gutter: '.eltd-ps-grid-gutter',
                    columnWidth: '.eltd-ps-grid-sizer'
                }
            });

            masonry.css('opacity', '1');
        }
    }

})(jQuery);
(function($) {
	'use strict';

	var masonryGallery = {};
	eltd.modules.masonryGallery = masonryGallery;

	masonryGallery.eltdInitMasonryGallery = eltdInitMasonryGallery;


	masonryGallery.eltdOnDocumentReady = eltdOnDocumentReady;

	$(document).ready(eltdOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitMasonryGallery();
	}

	/**
	 * Masonry gallery, init masonry and resize pictures in grid
	 */
	function eltdInitMasonryGallery(){
		var galleryHolder = $('.eltd-masonry-gallery-holder'),
			gallery = galleryHolder.children('.eltd-mg-inner'),
			gallerySizer = gallery.children('.eltd-mg-grid-sizer');

		resizeMasonryGallery(gallerySizer.outerWidth(), gallery);

		if(galleryHolder.length){
			galleryHolder.each(function(){
				var holder = $(this),
					holderGallery = holder.children('.eltd-mg-inner');

				holderGallery.waitForImages(function(){
					holderGallery.animate({opacity:1});

					holderGallery.isotope({
						layoutMode: 'packery',
						itemSelector: '.eltd-mg-item',
						percentPosition: true,
						packery: {
							gutter: '.eltd-mg-grid-gutter',
							columnWidth: '.eltd-mg-grid-sizer'
						}
					});
				});
			});

			$(window).resize(function(){
				resizeMasonryGallery(gallerySizer.outerWidth(), gallery);

				gallery.isotope('reloadItems');
			});
		}
	}

	function resizeMasonryGallery(size, holder){
		var rectangle_portrait = holder.find('.eltd-mg-rectangle-portrait'),
			rectangle_landscape = holder.find('.eltd-mg-rectangle-landscape'),
			square_big = holder.find('.eltd-mg-square-big'),
			square_small = holder.find('.eltd-mg-square-small');

		rectangle_portrait.css('height', 2*size);

		if (window.innerWidth <= 680) {
			rectangle_landscape.css('height', size/2);
		} else {
			rectangle_landscape.css('height', size);
		}

		square_big.css('height', 2*size);

		if (window.innerWidth <= 680) {
			square_big.css('height', square_big.width());
		}

		square_small.css('height', size);
	}

})(jQuery);