<div class="eltd-section-title-holder" <?php echo findme_elated_get_inline_style($holder_styles); ?>>
	<?php if(!empty($title)) { ?>
		<<?php echo esc_attr($title_tag); ?> class="eltd-st-title" <?php echo findme_elated_get_inline_style($title_styles); ?>>

            <span class="eltd-section-title-inner-wrapper">

                <?php

                echo esc_html($title);

	            if($title_number !== ''){ ?>
                    <span class="eltd-section-title-number">
                        <?php echo esc_html($title_number); ?>
                    </span>
	            <?php } ?>

            </span>


		</<?php echo esc_attr($title_tag); ?>>
	<?php } ?>

	<?php if(!empty($text)) { ?>
		<p class="eltd-st-text" <?php echo findme_elated_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
	<?php } ?>

</div>
