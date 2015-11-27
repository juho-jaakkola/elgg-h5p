<?php
/**
 *
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

$h5p_file = new \H5P\File();
$h5p_file->owner_guid = $guid;
$h5p_file->setFilename("h5p/{$file->getClientOriginalName()}.jpg");
$h5p_file->open('write');
$h5p_file->write(file_get_contents($file->getPathname()));
$h5p_file->close();
$h5p_file->save();

system_message(elgg_echo('todo3'));
