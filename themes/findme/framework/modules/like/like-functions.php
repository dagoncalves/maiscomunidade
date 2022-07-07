<?php

if ( ! function_exists('findme_elated_like') ) {
	/**
	 * Returns FindmeElatedLike instance
	 *
	 * @return FindmeElatedLike
	 */
	function findme_elated_like() {
		return FindmeElatedLike::get_instance();
	}
}

function findme_elated_get_like() {

	echo wp_kses(findme_elated_like()->add_like(), array(
		'span' => array(
			'class' => true,
			'aria-hidden' => true,
			'style' => true,
			'id' => true
		),
		'i' => array(
			'class' => true,
			'style' => true,
			'id' => true
		),
		'a' => array(
			'href' => true,
			'class' => true,
			'id' => true,
			'title' => true,
			'style' => true
		)
	));
}