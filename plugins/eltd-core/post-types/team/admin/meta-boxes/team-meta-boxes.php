<?php

if(!function_exists('eltd_core_map_team_single_meta')) {
    function eltd_core_map_team_single_meta() {

        $meta_box = findme_elated_create_meta_box(array(
            'scope' => 'team-member',
            'title' => esc_html__('Team Member Info', 'eltd-core'),
            'name'  => 'team_meta'
        ));

        $ufs = array();
        $ufs[''] = esc_html__( 'Default', 'findme' );
		$ufs['es']  = esc_html__( 'Espírito Santo', 'findme' );
		$ufs['mg'] = esc_html__( 'Minas Gerais', 'findme' );

        findme_elated_create_meta_box_field(
            array(
                'name' => 'eltd_team_member_uf',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('UF', 'eltd-core'),
                'parent' => $meta_box,
                'options' => $ufs
            )
        );

        findme_elated_create_meta_box_field(array(
            'name'        => 'eltd_team_member_position',
            'type'        => 'text',
            'label'       => esc_html__('Position', 'eltd-core'),
            'description' => esc_html__('The members\'s role within the team', 'eltd-core'),
            'parent'      => $meta_box
        ));

        findme_elated_create_meta_box_field(array(
            'name'        => 'eltd_team_member_birth_date',
            'type'        => 'date',
            'label'       => esc_html__('Birth date', 'eltd-core'),
            'description' => esc_html__('The members\'s birth date', 'eltd-core'),
            'parent'      => $meta_box
        ));

        findme_elated_create_meta_box_field(array(
            'name'        => 'eltd_team_member_email',
            'type'        => 'text',
            'label'       => esc_html__('Email', 'eltd-core'),
            'description' => esc_html__('The members\'s email', 'eltd-core'),
            'parent'      => $meta_box
        ));

        findme_elated_create_meta_box_field(array(
            'name'        => 'eltd_team_member_phone',
            'type'        => 'text',
            'label'       => esc_html__('Phone', 'eltd-core'),
            'description' => esc_html__('The members\'s phone', 'eltd-core'),
            'parent'      => $meta_box
        ));

        findme_elated_create_meta_box_field(array(
            'name'        => 'eltd_team_member_address',
            'type'        => 'text',
            'label'       => esc_html__('Address', 'eltd-core'),
            'description' => esc_html__('The members\'s addres', 'eltd-core'),
            'parent'      => $meta_box
        ));

        findme_elated_create_meta_box_field(array(
            'name'        => 'eltd_team_member_education',
            'type'        => 'text',
            'label'       => esc_html__('Education', 'eltd-core'),
            'description' => esc_html__('The members\'s education', 'eltd-core'),
            'parent'      => $meta_box
        ));

        findme_elated_create_meta_box_field(array(
            'name'        => 'eltd_team_member_resume',
            'type'        => 'file',
            'label'       => esc_html__('Resume', 'eltd-core'),
            'description' => esc_html__('Upload members\'s resume', 'eltd-core'),
            'parent'      => $meta_box
        ));

        for($x = 1; $x < 6; $x++) {

            $social_icon_group = findme_elated_add_admin_group(array(
                'name'   => 'eltd_team_member_social_icon_group'.$x,
                'title'  => esc_html__('Social Link ', 'eltd-core').$x,
                'parent' => $meta_box
            ));

                $social_row1 = findme_elated_add_admin_row(array(
                    'name'   => 'eltd_team_member_social_icon_row1'.$x,
                    'parent' => $social_icon_group
                ));

                    FindmeElatedIconCollections::get_instance()->getSocialIconsMetaBoxOrOption(array(
                        'label' => esc_html__('Icon ', 'eltd-core').$x,
                        'parent' => $social_row1,
                        'name' => 'eltd_team_member_social_icon_pack_'.$x,
                        'defaul_icon_pack' => '',
                        'type' => 'meta-box',
                        'field_type' => 'simple'
                    ));

                $social_row2 = findme_elated_add_admin_row(array(
                    'name'   => 'eltd_team_member_social_icon_row2'.$x,
                    'parent' => $social_icon_group
                ));

                    findme_elated_create_meta_box_field(array(
                        'type'            => 'textsimple',
                        'label'           => esc_html__('Link', 'eltd-core'),
                        'name'            => 'eltd_team_member_social_icon_'.$x.'_link',
                        'hidden_property' => 'eltd_team_member_social_icon_pack_'.$x,
                        'hidden_value'    => '',
                        'parent'          => $social_row2
                    ));
	
			        findme_elated_create_meta_box_field(array(
				        'type'          => 'selectsimple',
				        'label'         => esc_html__('Target', 'eltd-core'),
				        'name'          => 'eltd_team_member_social_icon_'.$x.'_target',
				        'options'       => findme_elated_get_link_target_array(),
				        'hidden_property' => 'eltd_team_member_social_icon_'.$x.'_link',
				        'hidden_value'    => '',
				        'parent'          => $social_row2
			        ));
        }
    }

    add_action('findme_elated_meta_boxes_map', 'eltd_core_map_team_single_meta', 46);
}