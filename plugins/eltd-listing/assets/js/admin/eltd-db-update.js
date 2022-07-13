(function($){
    $(document).ready(function() {
        eltdInitDBUpdate();
    });


    function eltdInitDBUpdate() {
        var dbUpdateNotice = $('.eltd-db-update-notice');
        if(dbUpdateNotice.length){
            var button = dbUpdateNotice.find('.eltd-run-db-update'),
                btnUpdatingText = button.data('updating-text'),
                btnUpdatedText = button.data('updated-text');
            var confirmMessage = dbUpdateNotice.data('confirm-message');

            button.on('click', function (e) {
                if (confirm(confirmMessage)) {
                    button.attr("disabled", true);
                    button.text(btnUpdatingText);
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: {
                            action: 'eltd_listing_database_update'
                        },
                        success: function (e) {
                            button.text(btnUpdatedText);
                            setTimeout(function(){
                                alert(e.data);
                                dbUpdateNotice.remove();
                                location.reload();
                            }, 300);
                        }
                    });
                }
                return false;
            });
        }
    }

})(jQuery);