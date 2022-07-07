<?php

class FindmeElatedIconWidget extends FindmeElatedWidget {
    public function __construct() {
        parent::__construct(
            'eltd_icon_widget',
            esc_html__('Elated Icon Widget', 'findme'),
            array( 'description' => esc_html__( 'Add icons to widget areas', 'findme'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
	protected function setParams() {
		$this->params = array_merge(
            findme_elated_icon_collections()->getIconWidgetParamsArray(),
			array(
				array(
					'type'  => 'textfield',
					'name'  => 'icon_text',
					'title' => wp_kses_post( 'Icon Text', 'findme' )
				),
                array(
                    'type'  => 'textfield',
                    'name'  => 'additional_text',
                    'title' => wp_kses_post( 'Additional Text', 'findme' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'link',
                    'title' => esc_html__( 'Icon Link', 'findme' )
                ),
				array(
					'type'  => 'textfield',
					'name'  => 'icon_size',
					'title' => esc_html__( 'Icon Size (px)', 'findme' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'icon_color',
					'title' => esc_html__( 'Icon Color', 'findme' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'icon_hover_color',
					'title' => esc_html__( 'Icon Hover Color', 'findme' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'icon_margin',
					'title'       => esc_html__( 'Icon Margin', 'findme' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'findme' )
				)
			)
		);
	}

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
	    $holder_classes = array( 'widget eltd-icon-widget-holder' );
	    if ( ! empty( $instance['icon_hover_color'] ) ) {
		    $holder_classes[] = 'eltd-icon-has-hover';
	    }
	
	    $data   = array();
	    $data[] = ! empty( $instance['icon_hover_color'] ) ? findme_elated_get_inline_attr( $instance['icon_hover_color'], 'data-hover-color' ) : '';
	    $data   = implode( ' ', $data );
	
	    $holder_styles = array();
	    if ( ! empty( $instance['icon_color'] ) ) {
		    $holder_styles[] = 'color: ' . $instance['icon_color'];
	    }
	
	    if ( ! empty( $instance['icon_size'] ) ) {
		    $holder_styles[] = 'font-size: ' . findme_elated_filter_px( $instance['icon_size'] ) . 'px';
	    }
	
	    if ( $instance['icon_margin'] !== '' ) {
		    $holder_styles[] = 'margin: ' . $instance['icon_margin'];
	    }

	    $icon_holder_html = '';
	    if ( ! empty( $instance['icon_pack'] ) ) {
		    $icon_class   = array( 'eltd-icon-widget' );
		    $icon_class[] = ! empty( $instance['fa_icon'] ) && $instance['icon_pack'] === 'font_awesome' ? 'fa ' . $instance['fa_icon'] : '';
		    $icon_class[] = ! empty( $instance['fe_icon'] ) && $instance['icon_pack'] === 'font_elegant' ? $instance['fe_icon'] : '';
		    $icon_class[] = ! empty( $instance['ion_icon'] ) && $instance['icon_pack'] === 'ion_icons' ? $instance['ion_icon'] : '';
		    $icon_class[] = ! empty( $instance['linea_icon'] ) && $instance['icon_pack'] === 'linea_icons' ? $instance['linea_icon'] : '';
		    $icon_class[] = ! empty( $instance['simple_line_icon'] ) && $instance['icon_pack'] === 'simple_line_icons' ? $instance['simple_line_icon'] : '';

		    $icon_class = implode( ' ', $icon_class );

		    $icon_holder_html = '<span class="' . $icon_class . '"></span>';
	    }

	    $icon_text_html = '';
	    if ( ! empty( $instance['icon_text'] ) ) {
		    $icon_text_html = '<span class="eltd-icon-text">' . esc_html( $instance['icon_text'] ) . '</span>';
	    }

        $additional_text_html = '';
        if ( ! empty( $instance['icon_text'] ) ) {
            $additional_text_html = '<span class="eltd-additional-text">' . esc_html( $instance['additional_text'] ) . '</span>';
        }
        ?>

        <?php if ( ! empty( $instance['link'] ) ) { ?>
            <a href="<?php echo esc_url($instance['link']);?>">
        <?php } ?>
        <div <?php findme_elated_class_attribute($holder_classes); ?> <?php echo wp_kses_post($data); ?> <?php echo findme_elated_get_inline_style($holder_styles); ?>>

                <?php echo wp_kses($icon_holder_html, array(
                    'span' => array(
                        'class' => true
                    )
                )); ?>
                <?php echo wp_kses($icon_text_html, array(
                    'span' => array(
                        'class' => true
                    )
                )); ?>
                <?php echo wp_kses($additional_text_html, array(
                    'span' => array(
                        'class' => true
                    )
                )); ?>
        </div>
        <?php if ( ! empty( $instance['link'] ) ) { ?>
            </a>
        <?php }?>
    <?php
    }
}