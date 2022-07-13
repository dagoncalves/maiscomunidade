<?php
if(get_the_content() !== ''){?>
	<div class="eltd-ls-content-part-holder clearfix">

		<div class="eltd-ls-content-part">
			<?php echo do_shortcode(get_the_content()); ?>
		</div>

	</div>
<?php }