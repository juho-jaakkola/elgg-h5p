<?php

namespace H5P;

class Library extends \ElggObject {
	/**
	 * @var Subtype of the \ElggObject
	 */
	const SUBTYPE = 'h5p_library';

	/**
	 * @var $fields List of database fields
	 */
	public $fields = [
		'machineName',
		'title',
		'majorVersion',
		'minorVersion',
		'patchVersion',
		'runnable',
		'fullscreen',
		'embedTypes',
		'preloadedJs',
		'preloadedCss',
		'dropLibraryCss',
		'semantics',
	];

	/**
	 * Set subtype
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = self::SUBTYPE;
	}
}
