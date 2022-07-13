(function($){
	$(document).ready(function() {
		eltdCreateCustomField();
		eltdOptionRepeater();
		eltdOptionRepeaterDeleteRow();
		eltdToggleRow();
		eltdDeleteRow();
		eltdAmenityRepeater();
		eltdAmenityRepeaterDeleteRow();
		eltdInitAmenityIconSelectDependency();
	});
	function eltdCreateCustomField(){

		var customField = $('.eltd-add-custom-field');
		if(customField.length){
			customField.on('click',function(){
				var thisField = $(this);
				var parent = thisField.parents('.term-description-wrap');
				var data = {
					type: thisField.data('type'),
					action: 'eltd_listing_get_custom_field_html'
				};
				$.ajax({
					type: "POST",
					url: ElatedAdminAjaxUrl,
					data: data,
					success: function (data) {
						if (data === 'error') {
							//error handler
						}else{
							response = $.parseJSON(data);
							parent.after(response.html);
							eltdOptionRepeater();
							eltdOptionRepeaterDeleteRow();
							eltdToggleRow();
							eltdDeleteRow();
						}
					}
				});
				return false;
			});
		}
	}

	function eltdOptionRepeater(){
		var button = $('.eltd-option-repeater-button');
		var counter = 0;
		if(button.length){
			button.each(function(){
				var currentButton = $(this);
				currentButton.on('click', function(){
					counter ++;
					var thisButton = $(this);
					var parent = thisButton.siblings('.eltd-custom-select-field-option-wrapper');
					var selectFieldId = '';
					var customFieldWrapper = parent.parents('.eltd-custom-field-wrapper');
					if(customFieldWrapper.hasClass('eltd-custom-select-field')){
						selectFieldId = customFieldWrapper.data('select-field-id');
					}

					var data = {
						action: 'eltd_listing_get_option_field_html',
						parentId: selectFieldId
					};
					if(counter === 1){
						$.ajax({
							type: "POST",
							url: ElatedAdminAjaxUrl,
							data: data,
							success: function (data) {
								response = $.parseJSON(data);
								if (response === 'error') {
									//error handler
								}else{
									parent.append(response.html);
									eltdOptionRepeater();
									eltdOptionRepeaterDeleteRow();
									eltdToggleRow();
									eltdDeleteRow();
								}
							}
						});
					}
				});
			});
		}

	}
	function eltdAmenityRepeater(){
		var button = $('.eltd-custom-amenity-add-button');
		var counter = 0;
		if(button.length){
			button.each(function(){
				var currentButton = $(this);
				currentButton.on('click', function(){
					counter ++;
					var thisButton = $(this);
					var parent = thisButton.siblings('.eltd-taxonomy-amenities-holder');
					var data = {
						action: 'eltd_listing_get_amenity_field_html'
					};
					if(counter === 1){
						$.ajax({
							type: "POST",
							url: ElatedAdminAjaxUrl,
							data: data,
							success: function (data) {
								response = $.parseJSON(data);
								if (response === 'error') {
									//error handler
								}else{
									parent.append(response.html);
									eltdAmenityRepeater();
									eltdAmenityRepeaterDeleteRow();
									eltdInitAmenityIconSelectDependency();
								}
							}
						});
					}
				});
			});
		}

	}
	function eltdOptionRepeaterDeleteRow(){
		var deleteButton = $('.eltd-option-repeater-close-button');
		deleteButton.on('click', function(){
			var thisCloseButton = $(this);
			var parent = thisCloseButton.parents('.eltd-option-repeater-field-row');
			parent.remove();
		});
	}
	function eltdAmenityRepeaterDeleteRow(){
		var deleteButton = $('.eltd-custom-amenity-close-button');
		deleteButton.on('click', function(){
			var thisCloseButton = $(this);
			var parent = thisCloseButton.parents('.eltd-amenity-repeater-row');
			parent.remove();
		});
	}
	function eltdToggleRow(){

		var toggleRowTrigger = $('.eltd-custom-row-expand-button');

		toggleRowTrigger.on('click', function(e){
			e.stopImmediatePropagation();

			var thisCloseButton = $(this);
			var content = thisCloseButton.siblings('.eltd-custom-field-inner');
            var textContent = thisCloseButton.find('.eltd-custom-row-opener');

			content.slideToggle();

            if(textContent.text() === '-'){
                textContent.text('+');
            }
            else{
                textContent.text('-');
            }

		});
	}

	function eltdDeleteRow(){

		var deleteButton = $('.eltd-custom-row-close-button');
		deleteButton.on('click', function(){
			var thisCloseButton = $(this),
				parent = thisCloseButton.parents('.form-field.custom-term-row');

			parent.remove();

		});

	}

	function eltdInitAmenityIconSelectDependency() {

		var container = $('.eltd-amenity-repeater-row');
		if(container.length){
			container.each(function() {

				var thisContainer = $(this),
					iconPack = thisContainer.find('#eltd_amenity_icon_pack'),
					iconHolders = thisContainer.find('.icon-collection');

				var checkDependency = function() {
					iconHolders.each(function(){
						var value = iconPack.val(),
							holder = $(this);
						if ( holder.hasClass( value ) ) {
							holder.fadeIn(300);
						} else {
							holder.fadeOut(300);
						}
					});
				};
				checkDependency();

				iconPack.change( function() {
					checkDependency();
				});

			});
		}
	}

})(jQuery);