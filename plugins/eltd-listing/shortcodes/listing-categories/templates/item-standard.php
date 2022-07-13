<?php
	$this_object = eltd_listing_categories_class_instance();
?>
<article class="eltd-ls-item eltd-ls-gallery-item <?php echo esc_attr($tax['classes']); ?>" >

    <div class="eltd-ls-item-inner">

        <?php if($tax['link']){ ?>
	        <a href="<?php echo esc_url($tax['link']); ?>" class="eltd-ls-gallery-item-overlay"></a>
        <?php } ?>

        <div class="eltd-ls-gallery-item-wrapper">

            <?php if($tax['icon'] !== ''){
				echo findme_elated_get_module_part( $tax['icon'] );
            }?>

            <div class="eltd-ls-gallery-item-text">

                <h3 class="eltd-gallery-item-title">
                    <?php echo esc_attr($tax['name']) ?>
                </h3>

                <?php if($tax['desc'] !== ''){ ?>

                    <div class="eltd-ls-gallery-item-desc">
                        <?php echo wp_kses_post($tax['desc']); ?>
                    </div>

                <?php } ?>

            </div>

        </div>
        <div class="eltd-ls-item-bgrnd" <?php echo findme_elated_get_inline_style($tax['image_style']) ?>></div>
	   
    </div>

</article>