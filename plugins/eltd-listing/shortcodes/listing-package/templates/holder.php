<?php
use ElatedListing\Lib\Core;
$this_object = eltd_listing_package_class_instance();
$packages = $this_object->getPackages();

if(is_array($packages) && count($packages)){ ?>
    <div class="eltd-ls-package-holder eltd-ls-package-normal-space eltd-ls-package-three-columns">
        <div class="eltd-ls-package-inner">
            <?php foreach ($packages as $package){

                $id = $package->ID;
                $article = new Core\ListingArticle($package->ID);
	            $first_color = findme_elated_get_first_main_color();

                $params = array(
                    'price' => $article->getPostMeta('_price'),
                    'featured' => $article->getPostMeta('_job_listing_featured') === 'yes' ? true : false,
                    'purchase_note' => $article->getPostMeta('_purchase_note'),
                    'content' => $package->post_content,
                    'package' => $package,
                    'id'	   => $id,
                    'button_params' => array(
                        'text' => esc_html__('Purchase', 'themenameted'),
                        'icon_pack' => 'font_elegant',
                        'fe_icon'   => 'arrow_carrot-right',
                        'icon_bck_color'         => 'transparent',
                        'icon_bck_hover_color'   => 'transparent',
                        'color'	                 => $first_color,
                        'hover_color'            => '#fff',
                        'background_color'       => 'transparent',
                        'hover_background_color' => $first_color,
                        'border_color'           => $first_color,
                        'link'                   => get_permalink($id)
                    )
                );

                echo eltd_listing_get_shortcode_module_template_part('templates/package', 'listing-package', '', $params);

            }?>
        </div>
    </div>
<?php }