<?php
/**
 * Blockquote shortcode template
 */
?>

<blockquote class="eltd-blockquote-shortcode" <?php findme_elated_inline_style($blockquote_style); ?> >

	<p class="eltd-blockquote-text">
		<?php echo esc_attr($text); ?>
	</p>

</blockquote>