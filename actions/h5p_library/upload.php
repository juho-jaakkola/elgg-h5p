<?php
/**
 * Uploads a new H5P library
 */

$guid = get_input('guid');

$files = _elgg_services()->request->files;

if (!$files->has('file')) {
	register_error(elgg_echo('upload:error:no_file'));
	forward(REFERER);
}

$file = $files->get('file');

if (empty($file)) {
	// A file input was provided but no file uploaded
	register_error(elgg_echo('upload:error:no_tmp_dir'));
	forward(REFERER);
}

if ($file->getError() !== 0) {
	register_error(elgg_get_friendly_upload_error($file->getError()));
	forward(REFERER);
}

$h5p_library = new \H5P\Library();
// Libraries are site-wide so we use site as their owner
$h5p_library->owner_guid = elgg_get_site_entity()->guid;
$h5p_library->title = $file->getClientOriginalName();
$h5p_library->setFilename("h5p/{$file->getClientOriginalName()}");
$h5p_library->open('write');
$h5p_library->write(file_get_contents($file->getPathname()));
$h5p_library->close();
$h5p_library->save();

system_message(elgg_echo('todo3'));

forward($h5p_library->getURL());
