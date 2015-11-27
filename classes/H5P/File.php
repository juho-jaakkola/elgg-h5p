<?php

namespace H5P;

class File extends \ElggFile {
	const SUBTYPE = 'h5p_file';

	/**
	 * Set subtype
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = self::SUBTYPE;
	}

}
