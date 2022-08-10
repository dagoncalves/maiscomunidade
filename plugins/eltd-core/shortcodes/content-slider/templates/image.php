<?php if ($image) : ?>
    <div class="eltd-content-slider-image">
        <?php echo wp_get_attachment_image($image, 'full'); ?>
    </div>
<?php endif; ?>