<?php

$entity = elgg_extract('entity', $vars);
$entity->lang = 'en';

elgg_dump($entity->getFilenameOnFilestore());
/*
$content = elgg_view('h5p/embed', array(
	'lang' => $entity->lang,
	'content' => $entity->content,
	'scripts' => $entity->scripts,
	'styles' => $entity->styles,
	'integration' => $entity->integration,
));
*/

$html = 'TODO';

/*
h5p_add_files_and_settings($node, $embed);
if ($embed === 'div') {
	$html = '<div class="h5p-content" data-content-id="' .  $content_id . '"></div>';
} else {
	$html = '<div class="h5p-iframe-wrapper"><iframe id="h5p-iframe-' . $content_id . '" class="h5p-iframe" data-content-id="' . $content_id . '" style="height:1px" src="about:blank" frameBorder="0" scrolling="no"></iframe></div>';
}
*/

$metadata = '';
if (!elgg_in_context('widgets')) {
	// only show entity menu outside of widgets
	$metadata = elgg_view_menu('entity', array(
		'entity' => $vars['entity'],
		'handler' => \H5P\File::SUBTYPE,
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz',
	));
}

$params = array(
	'entity' => $entity,
	'metadata' => $metadata,
	'title' => $entity->title,
	'subtitle' => $entity->title,
	'content' => $html,
);
$params = $params + $vars;
$list_body = elgg_view('object/elements/summary', $params);

echo elgg_view_image_block('', $list_body);

