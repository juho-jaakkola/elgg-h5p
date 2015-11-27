<?php
/**
 * H5P
 */

require_once(__DIR__ . '/vendor/autoload.php');

/**
 *
 */
elgg_register_event_handler('init', 'system', function() {
	$h5p = new \H5P\Framework;

	elgg_register_menu_item('site', array(
		'name' => 'h5p',
		'href' => 'h5p',
		'text' => elgg_echo('h5p'),
	));

	elgg_register_page_handler('h5p', 'h5p_page_handler');

	elgg_register_action('h5p/upload', __DIR__ . '/actions/h5p/upload.php');

	foreach (H5PCore::$scripts as $script) {
		$script = str_replace('js/', '', $script);

		elgg_define_js($script, array(
			'src' => '/mod/h5p/vendor/h5p/h5p-php-library/js/' . $script,
			'exports' => $script,
		));
	}
});

/**
 *
 */
function h5p_page_handler($page) {
	switch ($page[0]) {
		case 'add':
			echo elgg_view_resource('h5p/save', array(
				'guid' => $page[1],
				'action' => $page[0],
			));
			break;
		default:
			echo elgg_view_resource('h5p/all');
			break;
	}
}