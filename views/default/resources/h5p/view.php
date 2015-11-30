<?php
/**
 * View H5P content
 */

$guid = elgg_extract('guid', $vars);

$entity = get_entity($guid);

if (!$entity instanceof \H5P\File) {
	register_error(elgg_echo('h5p:notfound'));
	forward(REFERER);
}

$content = elgg_view_entity($entity);

$body = elgg_view_layout('content', array(
	'title' => $entity->title,
	'filter' => false,
	'content' => $content,
));

echo elgg_view_page($entity->title, $body);
