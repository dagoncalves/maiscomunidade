<div class="eltd-page-header page-header clearfix">
    <div class="eltd-theme-name pull-left" >
        <img src="<?php echo esc_url(findme_elated_get_skin_uri() . '/assets/img/logo.png'); ?>" alt="<?php esc_attr_e( 'Logo', 'findme' ); ?>" class="eltd-header-logo pull-left"/>
        <h1 class="pull-left">
            <?php echo esc_html($themeName); ?>
            <small><?php echo esc_html($themeVersion); ?></small>
        </h1>
    </div>
    <div class="eltd-top-section-holder">
        <div class="eltd-top-section-holder-inner">
            <div class="eltd-notification-holder">
                <div class="eltd-input-change"><i class="fa fa-exclamation-circle"></i><?php esc_html_e('You should save your changes', 'findme') ?></div>
                <div class="eltd-changes-saved"><i class="fa fa-check-circle"></i><?php esc_html_e('All your changes are successfully saved', 'findme') ?></div>
            </div>
            <div class="eltd-top-buttons-holder">
                <?php if($showSaveButton) { ?>
                    <input type="button" id="eltd_top_save_button" class="btn btn-info btn-sm" value="<?php esc_html_e('Save Changes', 'findme'); ?>"/>
                <?php } ?>
            </div>
        </div>
    </div>
</div>