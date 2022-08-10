<?php
namespace ElatedCore\CPT\Shortcodes\ImageWithIcon;

use ElatedCore\Lib;

class ImageWithIcon implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltd_image_with_icon';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Elated Image With Icon', 'eltd-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by ELATED', 'eltd-core' ),
					'icon'                      => 'icon-wpb-image-with-icon extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
                        array(
                            array(
                                'type'        => 'attach_image',
                                'param_name'  => 'image',
                                'heading'     => esc_html__( 'Image', 'eltd-core' ),
                                'description' => esc_html__( 'Select image from media library', 'eltd-core' )
                            ),
                            array(
                                'type'        => 'textfield',
                                'param_name'  => 'image_size',
                                'heading'     => esc_html__( 'Image Size', 'eltd-core' ),
                                'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'eltd-core' )
                            ),
                            array(
                                'type'       => 'attach_image',
                                'param_name' => 'custom_icon',
                                'heading'    => esc_html__( 'Custom Icon', 'eltd-core' )
                            ),
                        ),
                        \FindmeElatedIconCollections::get_instance()->getVCParamsArray()
					)
				)
			);
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'image'			  => '',
			'image_size'	  => 'medium',
            'custom_icon'     => ''
		);

        $args = array_merge($args, findme_elated_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);
        $iconPackName = findme_elated_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		
		$params['image']           = $this->getImage($params);
        $params['icon']            = $params[$iconPackName];
        $params['icon_params']     = array();
		$params['image_size']      = $this->getImageSize($params['image_size']);

		$html = eltd_core_get_shortcode_module_template_part('templates/image-with-icon', 'image-with-icon', '', $params);

		return $html;
	}

	/**
	 * Return image for shortcode
	 *
	 * @param $params
	 * @return array
	 */
	private function getImage($params) {
        $image = array();

        if (!empty($params['image'])) {
            $id = $params['image'];

            $image['image_id'] = $id;
            $image_original = wp_get_attachment_image_src($id, 'full');
	        $image['alt'] = get_post_meta($id, '_wp_attachment_image_alt', true);
        }

		return $image;
	}

	/**
	 * Return image size or custom image size array
	 *
	 * @param $image_size
	 * @return array
	 */
	private function getImageSize($image_size) {
		$image_size = trim($image_size);
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if(in_array( $image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) {
			return $image_size;
		} elseif(!empty($matches[0])) {
			return array(
					$matches[0][0],
					$matches[0][1]
			);
		} else {
			return 'thumbnail';
		}
	}
}