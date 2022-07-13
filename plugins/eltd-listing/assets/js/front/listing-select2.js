(function ($) {

	var listingsSelect = {};
	eltd.modules.listingsSelect = listingsSelect;
	listingsSelect.eltdOnDocumentReady = eltdOnDocumentReady;
	listingsSelect.eltdOnWindowLoad = eltdOnWindowLoad;
	listingsSelect.eltdOnWindowResize = eltdOnWindowResize;
	listingsSelect.eltdOnWindowScroll = eltdOnWindowScroll;

	$(document).ready(eltdOnDocumentReady);
	$(window).on('load', eltdOnWindowLoad);
	$(window).resize(eltdOnWindowResize);
	$(window).scroll(eltdOnWindowScroll);

	listingsSelect.eltdSelect2Fields = eltdSelect2Fields;
	listingsSelect.eltdInitSelect2Field = eltdInitSelect2Field;


	function eltdOnDocumentReady() {
		eltdSelect2Fields();
	}
	function eltdOnWindowLoad() { }
	function eltdOnWindowResize() { }
	function eltdOnWindowScroll() { }

	function eltdSelect2Fields() {

		var defaultSelectFields = $(
			'.eltd-ls-adv-search-holder select, ' +
			'.eltd-ls-main-search-holder-part select, ' +
			'.eltd-ls-archive-holder select,' +
			'.eltd-ls-single-comments .eltd-ls-single-sort,' +
			'.eltd-ls-field-holder select,' +
			'.eltd-listing-item-booking form select,' +
			'.eltd-rf select'
		);
		if (defaultSelectFields.length) {
			defaultSelectFields.each(function () {
				eltdInitSelect2Field($(this));
			});
		}

	}

	function eltdInitSelect2Field(field) {
		if (eltd.modules.listings.eltdIsValidObject(field)) {
			field.select2();
		}
	}

})(jQuery);