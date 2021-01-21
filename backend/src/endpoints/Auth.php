<?php

namespace Forum\endpoints;
use Forum\providers\UserProvider;
use Forum\utils\RESPONSES;

class Auth extends Endpoint {
	public function post_login($username, $password): string {
		$provider = new UserProvider();
		try {
			$user = $provider->getByUsername($username);
			if(md5($password) == $user->getPassword()) {
				session_start();
				$_SESSION['loggedIn'] = true;
				$_SESSION['username'] = $username;
				$provider->login($username);
				return (string)RESPONSES::OK('Úspěšně přihlášen');
			}
			else
				return (string) RESPONSES::FORBIDDEN('Špatné heslo');
		} catch(\Exception $e) {
			$msg = $e->getMessage();
			return (string) RESPONSES::FORBIDDEN($msg);
		}
	}

	public function post_register($username, $password, $email): string {
		$provider = new UserProvider();
		try {
			$res = $provider->createNew($username, $password, $email);
			return (string) RESPONSES::OK($res);
		} catch(\Exception $e) {
			$msg = $e->getMessage();
			return (string) RESPONSES::FORBIDDEN($msg);
		}
	}

	public function get_loggedIn(): string {
		session_start();
		return (string) RESPONSES::OK($_SESSION['loggedIn']);
	}

	public function get_logout(): string {
		session_start();
		$_SESSION['loggedIn'] = false;
		$_SESSION['username'] = "";
		return (string) RESPONSES::OK('Odhlášen');
	}
}