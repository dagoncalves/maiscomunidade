<article class="eltd-ls-package-item">

    <div class="eltd-ls-package-header">
        <?php if($featured){?>

            <div class="eltd-ls-package-featured">
            <span>
                <?php
                esc_html_e('Popular', 'eltd-listing');
                ?>
            </span>
            </div>

        <?php } ?>
        <h3 class="eltd-ls-package-title">
            <?php
                echo get_the_title($id);
            ?>
        </h3>
    </div>
    
    <?php if($content !== '' && $price !== ''){ ?>
        <div class="eltd-ls-package-content">
            <?php

                if($price !== ''){ ?>

                    <div class="eltd-ls-package-price-holder">
                        <span class="eltd-ls-package-currency">
                            <?php
                                echo esc_attr('$');
                            ?>
                        </span>
                        <span class="eltd-ls-package-price">
                            <?php
                                echo esc_attr($price);
                            ?>
                        </span>
                        <?php
                            if($purchase_note !== ''){?>

                                <span class="eltd-ls-package-price-desc">
                                  <?php
                                    echo wp_kses_post($purchase_note);
                                  ?>
                                </span>

                            <?php }
                        ?>
                    </div>
                <?php }
                echo do_shortcode($content);
            ?>
        </div>
    <?php } ?>
    
    <div class="eltd-ls-package-footer">
	   <?php
	       echo findme_elated_get_button_html($button_params);
	   ?> 
    </div>
    
</article>