<div class="eltd-tabs-navigation-wrapper">
    <ul class="nav nav-tabs">
        <?php
        foreach (findme_elated_options()->adminPages as $key => $page ) {
            $slug = "";
            if (!empty($page->slug)) $slug = "_tab".$page->slug;
            ?>
            <li<?php if ($page->slug == $tab) echo " class=\"active\""; ?>>
                <a href="<?php echo esc_url(get_admin_url().'admin.php?page=findme_elated_theme_menu'.$slug); ?>">
                    <?php if($page->icon !== '') { ?>
                        <i class="<?php echo esc_attr($page->icon); ?> eltd-tooltip eltd-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php echo esc_attr($page->title); ?>"></i>
                    <?php } ?>
                    <span><?php echo esc_html($page->title); ?></span>
                </a>
            </li>
        <?php
        }
        ?>
	    <?php if (findme_elated_core_plugin_installed()) { ?>
			<li <?php if($isBackupOptionsPage) { echo "class='active'"; } ?>><a href="<?php echo esc_url(get_admin_url().'admin.php?page=findme_elated_theme_menu_backup_options'); ?>"><i class="fa fa-download eltd-tooltip eltd-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php esc_attr_e('Backup Options','findme'); ?>"></i><span><?php esc_html_e('Backup Options','findme'); ?></span></a></li>
	        <li <?php if($isImportPage) { echo "class='active'"; } ?>><a href="<?php echo esc_url(get_admin_url().'admin.php?page=findme_elated_theme_menu_tabimport'); ?>"><i class="fa fa-download eltd-tooltip eltd-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php esc_attr_e('Import','findme'); ?>"></i><span><?php esc_html_e('Import','findme'); ?></span></a></li>
	    <?php } ?>
    </ul>
</div>