<div class="eltd-stacked-images-holder eltd-si-position-right">
    <div class="eltd-si-clicke-here"></div>
	<div class="eltd-si-images">
		<div class="eltd-si-fake-image">
			<?php if (!empty($item_image)) : ?>
				<?php echo wp_get_attachment_image($item_image, 'full', false); ?>
			<?php endif; ?>
		</div>
		<div class="eltd-si-switch-images">
			<?php if (!empty($item_image)) : ?>
				<?php echo wp_get_attachment_image($item_image, 'full', false, array('class' => 'eltd-si-first-image')); ?>
			<?php endif; ?>
			<?php if (!empty($item_stack_image)): ?>
				<?php echo wp_get_attachment_image($item_stack_image, 'full', false, array('class' => 'eltd-si-stack-image')); ?>
			<?php endif; ?>
		</div>
	</div>
</div>