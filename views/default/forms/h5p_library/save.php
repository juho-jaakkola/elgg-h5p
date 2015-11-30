<?php
/**
 * Save a H5P library
 */

echo elgg_view_input('file', array(
	'name' => 'file',
));

echo elgg_view_input('submit', array(
	'value' => elgg_echo('upload'),
));
