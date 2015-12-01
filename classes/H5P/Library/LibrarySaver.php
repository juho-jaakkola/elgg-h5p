<?php

namespace H5P\Library;

use Elgg\Database;

class LibrarySaver {
	/**
	 * @var $entities \Elgg\Database\EntityTable
	 */
	private $entities;

	/**
	 * @var
	 */
	private $package;

	/**
	 *
	 *
	 * @param EntityTable $entities
	 */
	public function __construct(EntityTable $entities) {
		$this->entities = $entities;
	}

	/**
	 *
	 *
	 * @param $package
	 */
	public function setPackage($package) {
		$this->package = $package;
	}

	/**
	 * Get an existing library by name
	 *
	 * @param string $name
	 * @return H5PLibrary|false
	 */
	public function getFromName($name) {
		$result = $this->entities->get(array(
			'type' => 'object',
			'subtype' => H5PLibrary::SUBTYPE,
			'wheres' => "e.title = $name",
		));

		if (isset($result[0])) {
			return $result[0];
		}

		return false;
	}

	/**
	 *
	 */
	public function save($libraries) {

	}
}
