<?php
/**
 * Register classes for subtypes
 */

if (get_subtype_id('object', 'h5p_file')) {
	update_subtype('object', 'h5p_file', '\H5P\File');
} else {
	add_subtype('object', 'h5p_file', '\H5P\File');
}
