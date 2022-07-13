<?php
$this_object = eltd_listing_adv_search_class_instance();

$keyword_flag = $this_object->getBasicParamByKey('keyword_search') === 'yes' ? true : false ;

if($keyword_flag){ ?>

    <div class="eltd-ls-adv-search-keyword-holder">

        <div class="eltd-ls-adv-search-keyword-holder-inner">
            <div class="eltd-ls-adv-search-keyword-field">

                <div class="eltd-ls-search-icon">
                    <?php echo findme_elated_icon_collections()->renderIcon( 'icon_search', 'font_elegant' ); ?>
                </div>
                <input type="text" class="eltd-ls-adv-search-keyword" name="eltd-ls-adv-search-keyword" placeholder="<?php esc_html_e('Type in your keyword', 'eltd-listing'); ?>">

            </div>
            <div class="eltd-ls-adv-search-submit-button">
                <?php echo findme_elated_get_button_html(array(
                    'text' => esc_html__('Find Listings', 'eltd-listing'),
                    'html_type' => 'button',
                    'custom_class' => 'eltd-ls-adv-search-keyword-button',
                    'type' => 'solid',
                    'size'  => 'large',
                    'hover_color'            => findme_elated_get_first_main_color(),
                    'hover_background_color' => 'transparent',
                    'hover_border_color'     => findme_elated_get_first_main_color(),
                    'icon_pack' => 'font_elegant',
                    'fe_icon'   => 'arrow_carrot-right'
                )); ?>	
            </div>
        </div>
    </div>

<?php }