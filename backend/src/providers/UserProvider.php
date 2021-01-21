<?php

namespace Forum\providers;

use Forum\App;
use Forum\entities\User;
use Forum\utils\Arrays;

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
			$user = new User($username, md5($password), $email);
			$array = $user->fullSerialize();
			App::getDb()->insert($this->tableName, $array);
		} catch(\Exception $e) {
			throw $e;
		}
		return 'Uživatel vytvořen.';
	}

	public function getByUsername($username) {
		try {
			$user = App::getDb()->select($this->tableName, '*', ['username' => $username]);
			if(sizeof($user) == 0) {
				throw new \Exception("Uživatel neexistuje", 404);
			}
			$user = Arrays::singleAssocToObj($user[0], User::class);
			return $user;
		} catch(\Exception $e) {
			throw $e;
		}
	}

	public function login($username) {
		try {
			$user = $this->getByUsername($username);
			App::getDb()->update($this->tableName, ['last_login' => date('Y-m-d H:i:s', time())], ['username' => $username]);
		} catch(\Exception $e) {
			throw $e;
		}
	}
}
