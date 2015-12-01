<?php
/**
 * H5P
 */

require_once(__DIR__ . '/vendor/autoload.php');

/**
 *
 */
elgg_register_event_handler('init', 'system', function() {
	elgg_register_menu_item('site', array(
		'name' => 'h5p',
		'href' => 'h5p',
		'text' => elgg_echo('h5p'),
	));

	elgg_register_page_handler('h5p', 'h5p_page_handler');

	elgg_register_action('h5p_file/upload', __DIR__ . '/actions/h5p_file/upload.php');
	elgg_register_action('h5p_file/delete', __DIR__ . '/actions/h5p_file/delete.php');

	elgg_register_plugin_hook_handler('register', 'menu:entity', array('H5P\File\EntityMenu', 'register'));

	elgg_register_menu_item('page', array(
		'name' => 'h5p',
		'text' => elgg_echo('admin:h5p'),
		'href' => 'admin/h5p',
		'section' => 'administer',
		'context' => array('admin'),
	));

	/*
	foreach (H5PCore::$scripts as $script) {
		if (strpos($script, 'jquery')) {
			//continue;
		}

		$script = str_replace('js/', '', $script);
		$script = str_replace('.js', '', $script);

		elgg_define_js($script, array(
			'src' => '/mod/h5p/vendor/h5p/h5p-php-library/js/' . $script,
			'exports' => $script,
			'deps' => array('jquery'),
		));
	}
	*/

	foreach (H5PCore::$scripts as $script) {
		elgg_register_js($script, "/mod/h5p/vendor/h5p/h5p-php-library/{$script}");
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
		case 'view':
			echo elgg_view_resource('h5p/view', array(
				'guid' => $page[1],
			));
			break;
		default:
			echo elgg_view_resource('h5p/all');
			break;
	}
}

function h5p_get_core_settings() {
  global $user, $base_url;

  $settings = array(
    'baseUrl' => $base_url,
    //'url' => elgg_get_site_url() . _h5p_get_h5p_path(),
    'postUserStatistics' =>  $user->uid > 0,
    'ajaxPath' => elgg_normalize_url('h5p-ajax') . '/',
    'ajax' => array(
      'contentUserData' => str_replace('%3A', ':', elgg_normalize_url('h5p-ajax/content-user-data/:contentId/:dataType/:subContentId'))
    ),
    //'saveFreq' => variable_get('h5p_save_content_state', 0) ? variable_get('h5p_save_content_frequency', 30) : FALSE,
    'l10n' => array(
      'H5P' => array( // Could core provide this?
        'fullscreen' => elgg_echo('Fullscreen'),
        'disableFullscreen' => elgg_echo('Disable fullscreen'),
        'download' => elgg_echo('Download'),
        'copyrights' => elgg_echo('Rights of use'),
        'embed' => elgg_echo('Embed'),
        'size' => elgg_echo('Size'),
        'showAdvanced' => elgg_echo('Show advanced'),
        'hideAdvanced' => elgg_echo('Hide advanced'),
        'advancedHelp' => elgg_echo('Include this script on your website if you want dynamic sizing of the embedded content:'),
        'copyrightInformation' => elgg_echo('Rights of use'),
        'close' => elgg_echo('Close'),
        'title' => elgg_echo('Title'),
        'author' => elgg_echo('Author'),
        'year' => elgg_echo('Year'),
        'source' => elgg_echo('Source'),
        'license' => elgg_echo('License'),
        'thumbnail' => elgg_echo('Thumbnail'),
        'noCopyrights' => elgg_echo('No copyright information available for this content.'),
        'downloadDescription' => elgg_echo('Download this content as a H5P file.'),
        'copyrightsDescription' => elgg_echo('View copyright information for this content.'),
        'embedDescription' => elgg_echo('View the embed code for this content.'),
        'h5pDescription' => elgg_echo('Visit H5P.org to check out more cool content.'),
        'contentChanged' => elgg_echo('This content has changed since you last used it.'),
        'startingOver' => elgg_echo("You'll be starting over."),
        'by' => elgg_echo('by'),
        'showMore' => elgg_echo('Show more'),
        'showLess' => elgg_echo('Show less'),
        'subLevel' => elgg_echo('Sublevel')
      )
    )
  );

  if ($user->uid) {
    $settings['user'] = array(
      'name' => $user->name,
      'mail' => $user->mail
    );
  }
  else {
    $settings['siteUrl'] = elgg_normalize_url('<front>', array('absolute' => TRUE));
  }

  return $settings;
}

/**
 * Get the path to the h5p files folder.
 *
 * @return string
 *  Path to the h5p files folder
 */
function _h5p_get_h5p_path() {
  $file_path = file_stream_wrapper_get_instance_by_uri('public://')->getDirectoryPath();
  return $file_path . '/' . variable_get('h5p_default_path', 'h5p');
}

/**
 * Get the different instances of the H5P core.
 *
 * @param string $type
 * @return \H5PElgg|\H5PCore|\H5PContentValidator|\H5PExport|\H5PStorage|\H5PValidator
 */
function h5p_get_instance($type) {
	static $interface, $core;

	if ($interface === null) {
		$interface = new \H5P\Elgg();

		$language = get_current_language();

		$path = elgg_get_data_path() . '/h5p';

		$url = elgg_get_site_url() . 'serve-file/';

		$core = new H5PCore($interface, $path, $url, $language);
	}

	switch ($type) {
		case 'validator':
			return new H5PValidator($interface, $core);
		case 'storage':
			return new H5PStorage($interface, $core);
		case 'contentvalidator':
			return new H5PContentValidator($interface, $core);
		case 'export':
			return new H5PExport($interface, $core);
		case 'interface':
			return $interface;
		case 'core':
			return $core;
	}
}
