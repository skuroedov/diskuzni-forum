<?php

namespace Forum\endpoints;
use Forum\App;
use Forum\providers\UserProvider;
use Forum\utils\RESPONSES;

class Auth extends Endpoint {
	public function post_login($username, $password) {

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
}