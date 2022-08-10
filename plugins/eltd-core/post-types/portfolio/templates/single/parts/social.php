<?php if(findme_elated_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes') { ?>
    <div class="eltd-ps-info-item eltd-ps-social-share">
        <?php echo findme_elated_get_social_share_html() ?>
    </div>
<?php } ?>