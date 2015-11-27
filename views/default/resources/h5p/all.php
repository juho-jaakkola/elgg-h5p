<?php
/**
 *
 */


elgg_register_title_button();

$title = elgg_echo('h5p');

$body = elgg_view_layout('content', array(
	'title' => $title,
	'content' => elgg_list_entities(array(
		'type' => 'object',
		'subtype' => \H5P\File::SUBTYPE,
	)),
));

echo elgg_view_page($title, $body);
