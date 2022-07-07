<?php

class FindmeElatedSideAreaOpener extends FindmeElatedWidget {
    public function __construct() {
        parent::__construct(
            'eltd_side_area_opener',
	        esc_html__('Elated Side Area Opener', 'findme'),
	        array( 'description' => esc_html__( 'Display a "hamburger" icon that opens the side area', 'findme'))
        );

        $this->setParams();
    }
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'icon_color',
				'title'       => esc_html__('Side Area Opener Color', 'findme'),
				'description' => esc_html__('Define color for side area opener', 'findme')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'icon_hover_color',
				'title'       => esc_html__('Side Area Opener Hover Color', 'findme'),
				'description' => esc_html__('Define hover color for side area opener', 'findme')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'widget_margin',
				'title'       => esc_html__('Side Area Opener Margin', 'findme'),
				'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'findme')
			),
			array(
				'type' => 'textfield',
				'name' => 'widget_title',
				'title' => esc_html__('Side Area Opener Title', 'findme')
			)
		);
	}
	
	public function widget($args, $instance) {
		$holder_styles = array();
		if (!empty($instance['icon_color'])) {
			$holder_styles[] = 'color: ' . $instance['icon_color'].';';
		}
		if (!empty($instance['widget_margin'])) {
			$holder_styles[] = 'margin: ' . $instance['widget_margin'];
		}
		?>
		<a class="eltd-side-menu-button-opener eltd-icon-has-hover" <?php echo findme_elated_get_inline_attr($instance['icon_hover_color'], 'data-hover-color'); ?> href="javascript:void(0)" <?php findme_elated_inline_style($holder_styles); ?>>
			<?php if (!empty($instance['widget_title'])) { ?>
				<h5 class="eltd-side-menu-title"><?php echo esc_html($instance['widget_title']); ?></h5>
			<?php } ?>
			<span class="eltd-side-menu-lines">
        		<span class="eltd-side-menu-line eltd-line-1"></span>
        		<span class="eltd-side-menu-line eltd-line-2"></span>
                <span class="eltd-side-menu-line eltd-line-3"></span>
        	</span>
		</a>
	<?php }
}