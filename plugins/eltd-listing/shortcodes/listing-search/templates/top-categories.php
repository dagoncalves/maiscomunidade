<?php
$this_object = eltd_listing_main_search_class_instance();
$enable_top_cats = $this_object->getBasicParamByKey('listing_search_top_cats');
$top_cats = $this_object->getBasicParamByKey('top_categories');
$html = '';
if(is_array($top_cats) && $enable_top_cats === 'yes'){ ?>
	<div class="eltd-ls-search-top-cats clearfix eltd-ls-normal-space eltd-column-<?php echo esc_attr__(count($top_cats));?>">
        <div class="eltd-ls-bckg-img-holder"></div>
        <div class="eltd-ls-inner clearfix">
            <?php foreach ( $top_cats as $top_cat ) { ?>

                <div class="eltd-ls-search-top-cat">
                    <a href="<?php echo findme_elated_get_module_part( $top_cat['link'] ); ?>" >
				        <?php
                            echo wp_kses_post($top_cat['icon']);
				        ?>
                        <span class="eltd-ls-search-top-cat-name">
                            <?php
                                echo wp_kses_post($top_cat['name']);
                            ?>
                        </span>
                    </a>
                </div>

	        <?php } ?>
        </div>
	</div>
<?php }