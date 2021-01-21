<?php

namespace Forum\providers;

use Forum\App;
use Forum\utils\Arrays;

abstract class Provider
{
	public string $tableName;
	public $class;

	public function __construct() {
		$this->tableName = App::getConfig()->get('Database.prefix').$this->setTableName();
		$this->class = $this->setClass();
	}

	protected abstract function setTableName();

	protected abstract function setClass();

	public function getAll() {
		$res = App::getDb()->select($this->tableName, '*');
		return Arrays::arrayAssocToObj($res, $this->class);
	}
}