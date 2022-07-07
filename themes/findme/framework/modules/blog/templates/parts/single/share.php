<?php
$share_type = isset($share_type) ? $share_type : 'list';
?>
<?php if( findme_elated_core_plugin_installed() && findme_elated_options()->getOptionValue('enable_social_share') === 'yes' && findme_elated_options()->getOptionValue('enable_social_share_on_post') === 'yes') { ?>
    <div class="eltd-blog-share">
        <span><?php esc_html_e('Share','findme')?></span>
        <?php echo findme_elated_get_social_share_html(array('type' => $share_type)); ?>
    </div>
<?php } ?>