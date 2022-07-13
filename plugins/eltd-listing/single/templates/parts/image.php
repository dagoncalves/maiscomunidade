<?php if(has_post_thumbnail()) {
	$image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
	$image_style = 'background-image: url('.esc_url($image_url).')';
	?>
	<div class="eltd-ls-item-image" <?php echo findme_elated_get_inline_style($image_style); ?>>
	</div>
<?php }