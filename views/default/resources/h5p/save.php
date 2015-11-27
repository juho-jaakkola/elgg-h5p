<?php
/**
 * Add/edit H5P content
 */

$guid = elgg_extract('guid', $vars);
$action = elgg_extract('action', $vars);

if ($action == 'add') {
	$container = get_entity($guid);
} else {
	$entity = get_entity($guid);

	if (!$entity instanceof H5P) {
		register_error(elgg_echo('h5p:notfound'));
		forward(REFERER);
	}
}

$title = elgg_echo("h5p:{$action}");

$form = elgg_view_form('h5p/upload', array('enctype' => 'multipart/form-data'));

$body = elgg_view_layout('content', array(
	'title' => $title,
	'filter' => false,
	'content' => $form,
));

echo elgg_view_page($title, $body);
