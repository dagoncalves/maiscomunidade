<?php ?>
<form action="<?php echo esc_url(home_url('/')); ?>" class="eltd-search-slide-window-top" method="get">
	<?php if ( $search_in_grid ) { ?>
		<div class="eltd-grid">
	<?php } ?>
		<div class="eltd-search-form-inner">
			<span class="eltd-swt-search-icon">
				<?php echo wp_kses($search_icon, array(
					'i' => array('class' => true, 'aria-hidden' => true),
					'span' => array('class' => true, 'aria-hidden' => true)
				)); ?>
			</span>
			<input type="text" placeholder="<?php esc_attr_e('Search', 'findme'); ?>" name="s" class="eltd-swt-search-field" autocomplete="off" />
			<a class="eltd-swt-search-close" href="#">
                <?php echo wp_kses($search_icon_close, array(
                        'i' => array('class' => true, 'aria-hidden' => true),
                        'span' => array('class' => true, 'aria-hidden' => true)
                )); ?>
			</a>
		</div>
	<?php if ( $search_in_grid ) { ?>
		</div>
	<?php } ?>
</form>