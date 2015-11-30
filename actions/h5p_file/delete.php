<?php
/**
 * Deletes a H5P file object and data
 */

$guid = get_input('guid');

$entity = get_entity($guid);

if (!$entity instanceof \H5P\File) {
	register_error(elgg_echo('h5p:todo'));
	forward(REFERER);
}

if (!$entity->canDelete()) {
	register_error(elgg_echo('h5p:todo'));
	forward(REFERER);
}

if ($entity->delete()) {
	system_message(elgg_echo('h5p:todo'));
} else {
	register_error(elgg_echo('h5p:todo'));
}

forward(REFERER);