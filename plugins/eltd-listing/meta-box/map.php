<?php
if(!function_exists('eltd_listing_map_listing_settings')) {
	function eltd_listing_map_listing_settings() {

		$listing_types = eltd_listing_get_listing_types(true);
		$listing_types_by_key = $listing_types['key_value'];
		$listing_types_objects = $listing_types['obj'];

		$default_value = '';
		if(isset($listing_types_by_key[0])){
			$default_value = $listing_types_by_key[0];
		}

		$enable_multi_listings = job_manager_multi_job_type();
		$enable_categories = eltd_listing_enable_categories();
		
		eltd_listing_add_listing_field(
			array(
				'id' => 'company_website',
				'type' => 'text',
				'label' => esc_html__('Company Website', 'eltd-listing'),
				'required' => false,
				'description' => '',
				'priority' => 4
			)
		);

		eltd_listing_add_listing_field(
			array(
				'id' => 'listing_price',
				'type' => 'text',
				'label' => esc_html__('Price', 'eltd-listing'),
				'required' => false,
				'placeholder' => esc_html__('e.q 7000', 'eltd-listing'),
				'description' => '',
				'priority' => 8
			)
		);
		eltd_listing_add_listing_field(
			array(
				'id' => 'listing_disc_price',
				'type' => 'text',
				'label' => esc_html__('Discount Price', 'eltd-listing'),
				'required' => false,
				'placeholder' => esc_html__('e.q 7000', 'eltd-listing'),
				'description' => '',
				'priority' => 9
			)
		);
		eltd_listing_add_listing_field(
			array(
				'id' => 'listing_gallery_images',
				'type'  => 'file',
				'multiple'  => true,
				'label' => esc_html__('Gallery', 'eltd-listing'),
				'required' => false,
				'placeholder' => esc_html__('Image', 'eltd-listing'),
				'description' => '',
				'priority' => 10
			)
		);
		eltd_listing_add_listing_field(
			array(
				'id' => 'listing_phone',
				'type'  => 'text',
				'label' => esc_html__('Phone', 'eltd-listing'),
				'required' => false,
				'placeholder' => esc_html__('Enter phone number', 'eltd-listing'),
				'description' => '',
				'priority' => 11
			)
		);
		eltd_listing_add_listing_field(
			array(
				'id' => 'listing_mail',
				'type'  => 'text',
				'label' => esc_html__('E-mail', 'eltd-listing'),
				'required' => false,
				'placeholder' => esc_html__('Enter e-mail', 'eltd-listing'),
				'description' => '',
				'priority' => 12
			)
		);
		eltd_listing_add_listing_field(
			array(
				'id' => 'listing_self_hosted_video',
				'type'  => 'text',
				'label' => esc_html__('Self Hosted Video', 'eltd-listing'),
				'required' => false,
				'placeholder' => esc_html__('Enter Video Url', 'eltd-listing'),
				'description' => esc_html__('Note that if Youtube or Vimeo field is set, this video will not be shown', 'eltd-listing'),
				'priority' => 13
			)
		);
		eltd_listing_add_listing_field(
			array(
				'id' => 'listing_video',
				'type'  => 'text',
				'label' => esc_html__('Video Url', 'eltd-listing'),
				'required' => false,
				'placeholder' => esc_html__('Enter Video Url', 'eltd-listing'),
				'description' => esc_html__('Youtube or Vimeo Video Url', 'eltd-listing'),
				'priority' => 14
			)
		);
		eltd_listing_add_listing_field(
			array(
				'id' => 'short_description',
				'type'  => 'text',
				'label' => esc_html__('Short Description', 'eltd-listing'),
				'required' => false,
				'placeholder' => esc_html__('Enter short description', 'eltd-listing'),
				'priority' => 15
			)
		);

		eltd_listing_add_listing_field(
			array(
				'id' => 'open_table_id',
				'type'  => 'text',
				'label' => esc_html__('Open Table Id', 'eltd-listing'),
				'required' => false,
				'placeholder' => esc_html__('Enter Open Table id', 'eltd-listing'),
				'priority' => 17
			)
		);

		eltd_listing_add_listing_field(
			array(
				'id' => 'listing_feature_image',
				'type'  => 'file',
				'multiple'  => false,
				'label' => esc_html__('Featured Image', 'eltd-listing'),
				'required' => false,
				'placeholder' => esc_html__('Image', 'eltd-listing'),
				'description' => '',
				'priority' => 16,
				'front_end_field' => true,
				'back_end_field' => true
			)
		);
		$social_network_array = eltd_listing_get_listing_social_network_array();

		$counter = 15;
		foreach($social_network_array as $network){
			$counter++;
			eltd_listing_add_listing_field(
				array(
					'id' => 'listing_'.$network['id'].'_url',
					'type'  => 'text',
					'label' => esc_html($network['name']),
					'required' => false,
					'placeholder' => esc_html($network['label']),
					'description' => '',
					'priority' => $counter
				)
			);
		}


		$listing_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => array('job_listing'),
				'title' => esc_html__('Listing Meta Box', 'eltd-listing'),
				'name' => 'listing-meta-box'
			)
		);

        $listing_meta_box_title = findme_elated_add_admin_section_title(
            array(
                'parent' => $listing_meta_box,
                'title'  => esc_html__('General Settings','eltd-listing'),
                'name'   => 'listing_type_categories_title'
            )
        );

        findme_elated_create_meta_box_field(
            array(
                'name' => 'eltd_listing_content_bottom_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Enable Content Bottom Area on Single Pages', 'listing_wireframe'),
                'parent'      => $listing_meta_box,
                'options'     => array(
                    '' => esc_html__('Default', 'eltd-listing'),
                    'yes' => esc_html__('Yes', 'eltd-listing'),
                    'no' => esc_html__('No', 'eltd-listing'),
                ),
            )
        );

		findme_elated_create_meta_box_field(
			array(
				'name' => 'eltd_listing_content_bottom_meta',
				'type' => 'select',
				'default_value' => '',
				'label' => esc_html__('Enable Content Bottom Area on Single Pages', 'listing_wireframe'),
				'parent'      => $listing_meta_box,
				'options'     => array(
					'' => esc_html__('Default', 'eltd-listing'),
					'yes' => esc_html__('Yes', 'eltd-listing'),
					'no' => esc_html__('No', 'eltd-listing'),
				),
			)
		);


		$ls_type_hide_array = array();
		$ls_type_show_array = array();
		if(is_array($listing_types_objects) && count($listing_types_objects)){

			foreach($listing_types_objects as $ls_type){

				$ls_type_hide_array[$ls_type->term_id] = '';

				//generate show array for eltd_listing_type field(Listing Type select field)
				//set current listing type container to be visible

				$ls_type_show_array[$ls_type->term_id] = '#eltd_ls_type_custom_fields_'.$ls_type->term_id.'_container,';
				$ls_type_show_array[$ls_type->term_id] .= '#eltd_ls_type_amenities_'.$ls_type->term_id.'_container,';
				$ls_type_show_array[$ls_type->term_id] .= '#eltd_ls_type_categories_'.$ls_type->term_id.'_container,';

				foreach ($listing_types_objects as $type) {

					if ($type->term_id !== $ls_type->term_id) {

						//generate hide array for listing type select field
						//hide listing type container(except current listing type)
						$ls_type_hide_array[$ls_type->term_id] .= '#eltd_ls_type_custom_fields_'.$type->term_id.'_container,';
						$ls_type_hide_array[$ls_type->term_id] .= '#eltd_ls_type_amenities_'.$type->term_id.'_container,';
						$ls_type_hide_array[$ls_type->term_id] .= '#eltd_ls_type_categories_'.$type->term_id.'_container,';

					}

				}

				$ls_type_hide_array[$ls_type->term_id] = rtrim($ls_type_hide_array[$ls_type->term_id], ',');
				$ls_type_show_array[$ls_type->term_id] = rtrim($ls_type_show_array[$ls_type->term_id], ',');

			}
			//if multi job selection is enabled, provide multi select field
			//in other case, provide default select button
			$select_button = '';
			if($enable_multi_listings){
				//dependency and saving in database will be based on this field
				$select_button = 'eltd_listing_item_multi_type';
				findme_elated_create_meta_box_field(
					array(
						'name' => 'eltd_listing_item_multi_type',
						'type' => 'checkboxgroup',
						'default_value' => '',
						'label' => esc_html__('Choose Listing Types', 'listing_wireframe'),
						'parent'      => $listing_meta_box,
						'options'     => $listing_types_by_key,
						'args' => array(
							'dependence' => true,
							'show' => $ls_type_show_array
						)
					)
				);
			}else{
				//dependency and saving in database will be based on this field
				$select_button = 'eltd_listing_item_type';
				findme_elated_create_meta_box_field(
					array(
						'name'        => 'eltd_listing_item_type',
						'type'        => 'select',
						'label'       => esc_html__('Listing Type', 'eltd-listing'),
						'description' => esc_html__('Choose a default type for Single Listings', 'eltd-listing'),
						'default_value' => $default_value,
						'parent'      => $listing_meta_box,
						'options'     => $listing_types_by_key,
						'args' => array(
							'dependence' => true,
							'hide' => $ls_type_hide_array,
							'show' => $ls_type_show_array
						)
					)
				);
			}

			foreach($listing_types_objects as $ls_type){

				$ls_type_hidden_values = array();

				foreach($listing_types_objects as $type){

					if($type->term_id !== $ls_type->term_id){
						$ls_type_hidden_values[] = $type->term_id;
					}

				}

				//get job categories related to Listing Type
				$ls_type_cats  = eltd_listing_get_listing_type_categories($ls_type->term_id);

				if(is_array($ls_type_cats) && count($ls_type_cats) && $enable_categories){

					$listing_type_cats_container = findme_elated_add_admin_container(
						array(
							'parent'          => $listing_meta_box,
							'name'            => 'ls_type_categories_'.$ls_type->term_id.'_container',
							'hidden_property' => $select_button,
							'hidden_value' => '',
							'hidden_values' => $ls_type_hidden_values
						)
					);
					$listing_type_cats_title = findme_elated_add_admin_section_title(
						array(
							'parent' => $listing_type_cats_container,
							'title'  => esc_html__('Listing Type','eltd-listing').' "'.esc_html($ls_type->name).'" '. esc_html__('Categories','eltd-listing'),
							'name'   => 'listing_type_categories_title'
						)
					);
					findme_elated_create_meta_box_field(
						array(
							'name' => 'eltd_listing_type_categories',
							'type' => 'checkboxgroup',
							'default_value' => '',
							'label' => esc_html__('Choose Categories', 'eltd-listing'),
							'parent' => $listing_type_cats_container,
							'options' => $ls_type_cats
						)
					);
				}

				//generate custom fields for Listing Type
				$custom_field_array =  eltd_listing_get_listing_type_custom_fields($ls_type->term_id);
				if(is_array($custom_field_array) && count($custom_field_array)){

					$ls_type_custom_field_container = findme_elated_add_admin_container(
						array(
							'parent' => $listing_meta_box,
							'name' => 'ls_type_custom_fields_'.$ls_type->term_id.'_container',
							'hidden_property' => $select_button,
							'hidden_value' => '',
							'hidden_values' => $ls_type_hidden_values
						)
					);

					$custom_fields_title = findme_elated_add_admin_section_title(
						array(
							'parent' => $ls_type_custom_field_container,
							'title'  => esc_html__('Listing Type','eltd-listing').' "'.esc_html($ls_type->name).'" '. esc_html__('Custom Fields','eltd-listing'),
							'name'	 => 'listing_type_custom_fields_title'
						)
					);

					foreach ($custom_field_array as $custom_field){
						$options = array();
						$field_type = $custom_field['field_type'];
						if($custom_field['field_type'] === 'select'){
							$field_type = 'selectblank';
							$options = eltd_listing_get_listing_type_options_array($custom_field);
						}

						findme_elated_create_meta_box_field(
							array(
								'type'            => $field_type,
								'name'            => $custom_field['meta_key'],
								'default_value'   => '',
								'label'           => $custom_field['title'],
								'options'         => $options,
								'parent'          => $ls_type_custom_field_container
							)
						);

					}
				}

				//generate amenities for Listing Type
				$amenities_array =  eltd_listing_get_listing_type_amenities($ls_type->term_id);
				if(is_array($amenities_array) && count($amenities_array)){
					$listing_type_amenities_container = findme_elated_add_admin_container(
						array(
							'parent' => $listing_meta_box,
							'name' => 'ls_type_amenities_'.$ls_type->term_id .'_container',
							'hidden_property' => $select_button,
							'hidden_value' => '',
							'hidden_values' => $ls_type_hidden_values
						)
					);

					$amenities_title = findme_elated_add_admin_section_title(
						array(
							'parent' => $listing_type_amenities_container,
							'title'  => esc_html__('Listing Type','eltd-listing').' "'.esc_html($ls_type->name).'" '. esc_html__('Amenities','eltd-listing'),
							'name'	 => 'listing_type_amenities_title'
						)
					);

					foreach($amenities_array as $key => $amenity){

						$amenity_field_name = eltd_listing_get_listing_type_amenity_field_name_refactored($ls_type->term_id, $key);
						findme_elated_create_meta_box_field(
							array(
								'type'         => 'checkbox',
								'name'         => $amenity_field_name,
								'default_value'    => '',
								'label'           => $amenity['name'],
								'parent'           => $listing_type_amenities_container
							)
						);

					}
				}
			}


		}

	}
	add_action('findme_elated_meta_boxes_map_on_init_action', 'eltd_listing_map_listing_settings');
}