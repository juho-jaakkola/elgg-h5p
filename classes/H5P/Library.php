<?php

namespace H5P;

class Library extends \ElggObject {
	const SUBTYPE = 'h5p_library';

	/**
	 * Set subtype
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = self::SUBTYPE;
	}

}
