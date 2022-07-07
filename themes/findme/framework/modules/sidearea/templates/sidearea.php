<section class="eltd-side-menu">
	<div class="eltd-close-side-menu-holder">
		<a class="eltd-close-side-menu" href="#" target="_self">
			<span class="icon-arrows-remove"></span>
		</a>
	</div>
	<?php if(is_active_sidebar('sidearea')) {
		dynamic_sidebar('sidearea');
	} ?>
</section>