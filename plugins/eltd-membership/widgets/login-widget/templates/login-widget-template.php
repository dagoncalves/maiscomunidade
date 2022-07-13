<?php
$current_user    = wp_get_current_user();
$name            = $current_user->display_name;
$current_user_id = $current_user->ID;
?>
<div class="eltd-logged-in-user">
        <?php
        if(eltd_membership_theme_installed()) {
            echo findme_elated_icon_collections()->renderIcon('icon_profile', 'font_elegant');
        }
        ?>
</div>
<ul class="eltd-login-dropdown">
    <?php
    $nav_items = eltd_membership_get_dashboard_navigation_items();
    foreach($nav_items as $nav_item) { ?>
        <li>
            <span><?php echo findme_elated_get_module_part( $nav_item['icon'] ); ?></span>
            <a href="<?php echo findme_elated_get_module_part( $nav_item['url'] ); ?>">
                <?php echo findme_elated_get_module_part( $nav_item['text'] ); ?>
            </a>
                
        </li>
    <?php } ?>
    <li>
        <span>
            <?php echo findme_elated_icon_collections()->renderIcon('lnr-pointer-right', 'linear_icons'); ?>
        </span>
        <a href="<?php echo wp_logout_url(home_url('/')); ?>">
            <?php esc_html_e('Log out', 'eltd-membership'); ?>
        </a>
    </li>
</ul>