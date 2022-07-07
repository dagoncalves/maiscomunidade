(function($) {

	$(document).ready(function() {
		eltdSaveCheckBoxesValue();
		eltdCheckBoxMultiSelectInitState();
		eltdInitCheckBoxMultiSelectChange();
	});

	function eltdSaveCheckBoxesValue(){
		var checkboxes = $('.eltd-single-checkbox-field');
		checkboxes.change(function(){
			eltdDisableHidden($(this));
		});
		checkboxes.each(function(){
			eltdDisableHidden($(this));
		});
		function eltdDisableHidden(thisBox){
			if(thisBox.is(':checked')){
				thisBox.siblings('.eltd-single-checkbox-field-hidden').prop('disabled', true);
			}else{
				thisBox.siblings('.eltd-single-checkbox-field-hidden').prop('disabled', false);
			}
		}
	}

	function eltdCheckBoxMultiSelectInitState(){
		var element = $('input[type="checkbox"].dependence.multiselect');
		if(element.length){
			element.each(function() {
				var thisItem = $(this);
				eltdInitCheckBox(thisItem);
			});
		}
	}

	function eltdInitCheckBoxMultiSelectChange() {
		var element = $('input[type="checkbox"].dependence.multiselect');
		element.on('change', function(){
			var thisItem = $(this);
			eltdInitCheckBox(thisItem);
		});
	}

	function eltdInitCheckBox(checkBox){

		var thisItem = checkBox;
		var checked = thisItem.attr('checked');
		var dataShow = thisItem.data('show');

		if(checked === 'checked'){
			if(typeof(dataShow)!== 'undefined' && dataShow !== '') {
				var elementsToShow = dataShow.split(',');

				$.each(elementsToShow, function(index, value) {
					$(value).fadeIn();
				});
			}
		}
		else{
			if(typeof(dataShow)!== 'undefined' && dataShow !== '') {
				var elementsToShow = dataShow.split(',');

				$.each(elementsToShow, function(index, value) {
					$(value).fadeOut();
				});
			}
		}

	}

})(jQuery);
