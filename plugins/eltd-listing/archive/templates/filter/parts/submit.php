<?php
$submit_button = array(
	'type' => 'solid',
	'size' => 'small',
	'custom_class' => 'eltd-archive-submit-button',
	'text' => esc_html__('Filter Results', 'eltd-listing'),
	'html_type' => 'button'
);

echo findme_elated_get_button_html($submit_button);