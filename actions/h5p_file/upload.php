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

$site = elgg_get_site_entity();

$validator = h5p_get_instance('validator');
$interface = h5p_get_instance('interface');

/*
echo "<pre>";
var_dump($file);
var_dump($file->getPathName());
var_dump(file_exists($file->getPathName()));
var_dump(elgg_get_data_path() . "h5p/{$file->getClientOriginalName()}");
die;
*/

$h5p_dir = elgg_get_data_path() . "h5p/";
if (!file_exists($h5p_dir)) {
	mkdir($h5p_dir);
}

// Move so core can validate the file extension.
//rename($file->getPathName(), $interface->getUploadedH5pPath());
rename($file->getPathName(), "{$h5p_dir}{$file->getClientOriginalName()}");

if ($validator->isValidPackage()) {
	$storage = h5p_get_instance('storage');
	//$storage->savePackage();
	//return $storage->contentId;
}

// Parse and save the libraries included in the package
//$library_parser = new \H5P\Library\LibrarySaver(new \Elgg\Database\EntityTable());
//$library_parser->setPackage($file);

/*
$h5p_file = new \H5P\File();
$h5p_file->owner_guid = $guid;
$h5p_file->title = $file->getClientOriginalName();
$h5p_file->setFilename("h5p/{$file->getClientOriginalName()}");
$h5p_file->open('write');
$h5p_file->write(file_get_contents($file->getPathname()));
$h5p_file->close();
$h5p_file->save();
*/

system_message(elgg_echo('todo3'));

echo "Moikka";

//forward($h5p_file->getURL());
