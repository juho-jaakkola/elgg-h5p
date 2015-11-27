<?php

$entity = new stdClass;
$entity->lang = 'en';

echo "<p>Testing iFrame:</p>";

echo elgg_view('h5p/embed', array(
	'lang' => $entity->lang,
	'content' => $entity->content,
	'scripts' => $entity->scripts,
	'styles' => $entity->styles,
	'integration' => $entity->integration,
));
