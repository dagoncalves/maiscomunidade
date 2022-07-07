<?php

class FindmeElatedRawHTMLWidget extends FindmeElatedWidget {
	/**
	 * Set basic widget options and call parent class construct
	 */
	public function __construct() {
		parent::__construct(
			'eltd_raw_html_widget',
			esc_html__( 'Elated Raw HTML Widget', 'findme' ),
			array( 'description' => esc_html__( 'Add raw HTML holder to widget areas', 'findme' ) )
		);
		
		$this->setParams();
	}
	
	/**
	 * Sets widget options
	 */
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'extra_class',
				'title' => esc_html__( 'Extra Class Name', 'findme' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'findme' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'widget_grid',
				'title'   => esc_html__('Widget Grid', 'findme'),
				'options' => array(
					''     => esc_html__('Full Width', 'findme'),
					'auto' => esc_html__('Auto', 'findme')
				)
			),
			array(
				'type'  => 'textarea',
				'name'  => 'content',
				'title' => esc_html__( 'Content', 'findme' )
			)
		);
	}
	
	/**
	 * Generates widget's HTML
	 *
	 * @param array $args args from widget area
	 * @param array $instance widget's options
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		
		$extra_class   = array();
		$extra_class[] = !empty( $instance['extra_class'] ) ? $instance['extra_class'] : '';
		$extra_class[] = !empty( $instance['widget_grid'] ) && $instance['widget_grid'] === 'auto' ? 'eltd-grid-auto-width' : '';
		?>
		
		<div class="widget eltd-raw-html-widget <?php echo esc_attr( implode( $extra_class ) ); ?>">
			<?php
                if (!empty($instance['widget_title'])) {
	                echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
                }
                if ( ! empty( $instance['content'] ) ) {
                    echo wp_kses_post( $instance['content'] );
                }
			?>
		</div>
		<?php
	}
}