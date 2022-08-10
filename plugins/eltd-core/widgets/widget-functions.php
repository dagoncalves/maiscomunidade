<?php
//add bakcground image field in widgets
if(!function_exists('findme_elated_add_fields_in_widget_form')){
	function findme_elated_add_fields_in_widget_form($widget_obj,$return,$instance){

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'bck_image' => '') );
		if ( !isset($instance['bck_image']) ){
			$instance['bck_image'] = '';
		}
		?>
		<p>
			<label for="<?php echo esc_attr($widget_obj->get_field_id('bck_image')); ?>">
				<?php _e('Background Image Url', 'findme'); ?>
			</label>
			<input
				id="<?php echo esc_attr($widget_obj->get_field_id('bck_image')); ?>"
				name="<?php echo esc_attr($widget_obj->get_field_name('bck_image')); ?>"
				type="text" value="<?php echo esc_attr($instance['bck_image']);?>"
				style="display: block;width: 100%"; />
		</p>

		<?php return array($widget_obj,$return,$instance);
	}
	add_action('in_widget_form', 'findme_elated_add_fields_in_widget_form',5,3);
}

if(!function_exists('findme_elated_save_fields_in_widget_form')){

	function findme_elated_save_fields_in_widget_form($instance, $new_instance, $old_instance){
		$instance['bck_image'] = strip_tags($new_instance['bck_image']);
		return $instance;
	}

	add_filter('widget_update_callback', 'findme_elated_save_fields_in_widget_form',5,3);
}

if(!function_exists('findme_elated_render_sidebar_params_in_widget_form')){

	function findme_elated_render_sidebar_params_in_widget_form($params){

		global $wp_registered_widgets;
		$widget_id = $params[0]['widget_id'];
		$widget_obj = $wp_registered_widgets[$widget_id];
		$widget_opt = get_option($widget_obj['callback'][0]->option_name);
		$widget_num = $widget_obj['params'][0]['number'];

		if (isset($widget_opt[$widget_num]['bck_image']) && $widget_opt[$widget_num]['bck_image']  !== ''){
			$image_url = $widget_opt[$widget_num]['bck_image'];
			$style = 'background-image: url('.esc_url($image_url).')';
			$params[0]['before_widget'] .= '<div class="eltd-widget-bck-holder" '.findme_elated_get_inline_style($style).'></div>';
		}
		return $params;

	}
	add_filter('dynamic_sidebar_params', 'findme_elated_render_sidebar_params_in_widget_form');

}