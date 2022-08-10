<div class="eltd-social-share-holder eltd-list">
	<?php if(!empty($title)) { ?>
		<p class="eltd-social-title"><?php echo esc_html($title); ?></p>
	<?php } ?>
	<ul>
		<?php foreach ($networks as $net) {
			echo wp_kses($net, array(
				'li'   => array(
					'class' => true
				),
				'a'    => array(
					'itemprop' => true,
					'class'    => true,
					'href'     => true,
					'target'   => true,
					'onclick'  => true
				),
				'img'  => array(
					'itemprop' => true,
					'class'    => true,
					'src'      => true,
					'alt'      => true
				),
				'span' => array(
					'class' => true
				)
			));
		} ?>
	</ul>
</div>