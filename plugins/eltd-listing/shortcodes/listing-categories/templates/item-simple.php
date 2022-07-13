<?php
	$this_object = eltd_listing_categories_class_instance();
	$title_style = $this_object->getSimpleTypeTitleStyles();
?>
<article class="eltd-ls-item eltd-ls-gallery-item <?php echo esc_attr($tax['classes']); ?>" >

    <div class="eltd-ls-item-inner" >
	
        <div class="eltd-ls-gallery-item-text">

            <h2 class="eltd-gallery-item-title" <?php echo findme_elated_get_inline_style($title_style);?>>
                <a href="<?php echo esc_url($tax['link']); ?>">
	                <?php echo esc_attr($tax['name']); ?>
                </a>
            </h2>

            <?php if($tax['desc'] !== ''){ ?>
                <div class="eltd-ls-gallery-item-desc">
                    <?php echo wp_kses_post($tax['desc']); ?>
                </div>
            <?php } ?>

        </div>
	
    </div>

</article>