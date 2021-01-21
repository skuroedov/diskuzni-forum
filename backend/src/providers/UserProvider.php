<?php

namespace Forum\providers;

use Forum\App;
use Forum\entities\User;

class UserProvider extends Provider
{
	protected function setTableName() {
		return 'user';
	}

	protected function setClass() {
		return User::class;
	}

	public function createNew($username, $password, $email) {
		$check = App::getDb()->select($this->tableName, '*', ['OR' => ['username' => $username, 'email' => $email]]);
		if(sizeof($check) > 0) {
			throw new \Exception('Uživatel s tímto e-mailem nebo uživatelským jménem již existuje');
		}

		try {
			$user = new User($username, $password, $email);
			$array = $user->fullSerialize();
			App::getDb()->insert($this->tableName, $array);
		} catch(\Exception $e) {
			throw $e;
		}
		return 'Uživatel vytvořen.';
	}
}
