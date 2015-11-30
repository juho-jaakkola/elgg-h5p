<?php

namespace H5P\File;

/**
 *
 */
class EntityMenu {

	/**
	 *
	 */
	static public function register ($hook, $type, $menu, $params) {
		$entity = $params['entity'];

		if (!$entity instanceof \H5P\File) {
			return $menu;
		}
	}
}
