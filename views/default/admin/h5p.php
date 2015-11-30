<?php
/**
 *
 */

elgg_register_menu_item('title', array(
	'name' => 'h5p_add',
	'href' => 'admin/h5p/add',
	'text' => elgg_echo('add'),
	'link_class' => array('elgg-button elgg-button-action'),
));

echo elgg_list_entities(array(
	'type' => 'object',
	'subtype' => \H5P\Library::SUBTYPE,
	'no_results' => elgg_echo('admin:h5p:libraries:none'),
));
