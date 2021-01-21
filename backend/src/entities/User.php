<?php

namespace Forum\entities;
class User {
	use Entity;
	public int $id;
	public string $username;
	public string $registration;
	public string $last_login;
	public bool $banned = false;

	private string $password;
	private string $email;

	public function __construct(string $username, string $password, string $email) {
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
	}

	public function getid() {
		return $this->id;
	}

	public function getUsername() {
		return $this->username;
	}

	public function getRegistration() {
		return $this->registration;
	}

	public function getLastLogin() {
		return $this->last_login;
	}

	public function getBanned() {
		return $this->banned;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getEmail() {
		return $this->email;
	}
}
