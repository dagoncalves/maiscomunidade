<?php
$desc = $article_obj->getPostMeta('_short_description');
if($desc !== ''){ ?>

	<div class="eltd-ls-single-desc">
		<span>
			<?php
				echo esc_attr($desc);
			?>
		</span>
	</div>

<?php }