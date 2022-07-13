<?php

if( !function_exists('eltd_listing_database_update')) {
    function eltd_listing_database_update() {
        $eltd_listing_db_version = get_option('eltd_listing_db_version');
        if(!isset($eltd_listing_db_version) || (float) $eltd_listing_db_version < 1.1) {
            eltd_listing_amenities_update();
            eltd_listing_custom_fields_update();
            update_option('eltd_listing_db_version', 1.1);

            $responseMessage = esc_html__('Database successfully updated to version 1.1', 'eltd-listing');
            wp_send_json_success( $responseMessage );
        } else {
            $responseMessage = esc_html__('You already have latest database version', 'eltd-listing');
            wp_send_json_success( $responseMessage );
        }
    }

    add_action( 'wp_ajax_eltd_listing_database_update', 'eltd_listing_database_update' );
}

if( !function_exists('eltd_listing_print_admin_update_notice')) {
    function eltd_listing_print_admin_update_notice() {
        wp_enqueue_style('eltd-listing-admin-notice-style', ELATED_LISTING_URL_PATH.'assets/css/admin/eltd-notice.css');
        wp_enqueue_script('eltd-listing-admin-notice-script', ELATED_LISTING_URL_PATH.'assets/js/admin/eltd-db-update.js');
        echo eltd_listing_get_listing_module_template_part('helpers', 'admin-db-update-notice');
    }
    $eltd_listing_db_version = get_option('eltd_listing_db_version');
    if(!isset($eltd_listing_db_version) || (float) $eltd_listing_db_version < 1.1) {
        add_action('admin_print_styles', 'eltd_listing_print_admin_update_notice');
    }
}

if( !function_exists('eltd_listing_amenities_update')) {
    function eltd_listing_amenities_update() {
        global $wpdb;
        $listing_types_with_amenities = eltd_listing_get_types_with_amenities();
        if(is_array($listing_types_with_amenities) && !empty($listing_types_with_amenities)) {
           foreach($listing_types_with_amenities as $ltwa) {
               $type_id = $ltwa;
               $type_amenities = get_term_meta($type_id, 'listing_type_amenities', true);
               $new_amenities_array = array();
               foreach($type_amenities as $key => $values) {
                   $unique_id = uniqid();
                   $old_post_meta_key = eltd_listing_get_listing_type_amenity_field_name($type_id, $values);
                   $new_post_meta_key = eltd_listing_get_listing_type_amenity_field_name_refactored($type_id, $unique_id);

                   $query =  "UPDATE wp_postmeta
                              SET meta_key = '$new_post_meta_key'
                              WHERE meta_key = '$old_post_meta_key'";
                   $result = $wpdb->query($query);

                   $values['unique_id'] = $unique_id;

                   $new_amenities_array[$unique_id] = $values;
               }
               update_term_meta($type_id, 'listing_type_amenities', $new_amenities_array, $type_amenities);
           }
        }
    }
}

if( !function_exists('eltd_listing_get_types_with_amenities')) {
    function eltd_listing_get_types_with_amenities() {
        $term_args = array(
            'taxonomy' => 'job_listing_type',
            'hide_empty' => false
        );

        $listing_types = get_terms($term_args);

        $listing_type_ids = array();

        if(isset($listing_types) && is_array($listing_types)) {
            foreach ($listing_types as $listing_type) {
                $amenities = get_term_meta($listing_type->term_id, 'listing_type_amenities', true);
                if(isset($amenities) && is_array($amenities)) {
                    $listing_type_ids[] = $listing_type->term_id;
                }
            }
        }

        return $listing_type_ids;
    }
}

if( !function_exists('eltd_listing_custom_fields_update')) {
    function eltd_listing_custom_fields_update() {
        global $wpdb;
        $listing_types_with_custom_fields = eltd_listing_get_types_with_custom_fields();
        if(is_array($listing_types_with_custom_fields) && !empty($listing_types_with_custom_fields)) {
            foreach($listing_types_with_custom_fields as $ltwcf) {
                $type_id = $ltwcf;
                $type_custom_fields = get_term_meta($type_id, 'listing_type_custom_fields', true);
                $new_custom_fields_array = array();
                foreach($type_custom_fields as $key => $values) {
                    $old_post_meta_key = $values['meta_key'];
                    $new_post_meta_key = 'eltd-ls-type-' . $type_id . '-' .$values['unique_id'];

                    $query =  "UPDATE wp_postmeta
                              SET meta_key = '$new_post_meta_key'
                              WHERE meta_key = '$old_post_meta_key'";
                    $result = $wpdb->query($query);

                    $values['meta_key'] = $new_post_meta_key;

                    $new_custom_fields_array[$key] = $values;
                }
                update_term_meta($type_id, 'listing_type_custom_fields', $new_custom_fields_array, $type_custom_fields);
            }
        }
    }
}

if( !function_exists('eltd_listing_get_types_with_custom_fields')) {
    function eltd_listing_get_types_with_custom_fields() {
        $term_args = array(
            'taxonomy' => 'job_listing_type',
            'hide_empty' => false
        );

        $listing_types = get_terms($term_args);

        $listing_type_ids = array();

        if(isset($listing_types) && is_array($listing_types)) {
            foreach ($listing_types as $listing_type) {
                $custom_fields = get_term_meta($listing_type->term_id, 'listing_type_custom_fields', true);
                if(isset($custom_fields) && is_array($custom_fields)) {
                    $listing_type_ids[] = $listing_type->term_id;
                }
            }
        }

        return $listing_type_ids;
    }
}