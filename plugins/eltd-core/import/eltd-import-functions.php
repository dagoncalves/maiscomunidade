<?php

function eltd_core_import_object(){
	$eltd_core_import_object = new ElatedfCoreImport();
}

add_action('init', 'eltd_core_import_object');

if(!function_exists('eltd_core_data_import')){
	function eltd_core_data_import(){
		$importObject = ElatedfCoreImport::getInstance();

		if ($_POST['import_attachments'] == 1)
			$importObject->attachments = true;
		else
			$importObject->attachments = false;

		$folder = "findme/";
		if (!empty($_POST['example']))
			$folder = $_POST['example']."/";

		$importObject->import_content($folder.$_POST['xml']);

		die();
	}

	add_action('wp_ajax_eltd_core_data_import', 'eltd_core_data_import');
}

if(!function_exists('eltd_core_widgets_import')){
	function eltd_core_widgets_import(){
		$importObject = ElatedfCoreImport::getInstance();

		$folder = "findme/";
		if (!empty($_POST['example']))
			$folder = $_POST['example']."/";

		$importObject->import_widgets($folder.'widgets.txt',$folder.'custom_sidebars.txt');

		die();
	}

	add_action('wp_ajax_eltd_core_widgets_import', 'eltd_core_widgets_import');
}

if(!function_exists('eltd_core_options_import')){
	function eltd_core_options_import(){
		$importObject = ElatedfCoreImport::getInstance();

		$folder = "findme/";
		if (!empty($_POST['example']))
			$folder = $_POST['example']."/";

		$importObject->import_options($folder.'options.txt');

		die();
	}

	add_action('wp_ajax_eltd_core_options_import', 'eltd_core_options_import');
}

if(!function_exists('eltd_core_other_import')){
	function eltd_core_other_import(){
		$importObject = ElatedfCoreImport::getInstance();

		$folder = "findme/";
		if (!empty($_POST['example']))
			$folder = $_POST['example']."/";

		$importObject->import_options($folder.'options.txt');
		$importObject->import_widgets($folder.'widgets.txt',$folder.'custom_sidebars.txt');
		$importObject->import_menus($folder.'menus.txt');
		$importObject->import_settings_pages($folder.'settingpages.txt');

		$importObject->eltd_update_meta_fields_after_import( $folder );
		$importObject->eltd_update_options_after_import( $folder );

		if(eltd_core_is_revolution_slider_installed()){
			$importObject->rev_slider_import($folder);
		}

		die();
	}

	add_action('wp_ajax_eltd_core_other_import', 'eltd_core_other_import');
}
