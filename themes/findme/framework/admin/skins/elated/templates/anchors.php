<div class="eltd-anchor-holder">
    <?php if(is_array($page->layout) && count($page->layout)) { ?>
        <span><?php esc_html_e('Scroll To:', 'findme') ?></span>
        <select class="nav-select eltd-selectpicker" data-width="315px" data-hide-disabled="true" data-live-search="true" id="eltd-select-anchor">
            <option value="" disabled selected></option>
            <?php foreach ($page->layout as $panel) { ?>
                <option data-anchor="#eltd_<?php echo esc_attr($panel->name); ?>"><?php echo esc_attr($panel->title); ?></option>
            <?php } ?>
        </select>
    <?php } ?>
</div>