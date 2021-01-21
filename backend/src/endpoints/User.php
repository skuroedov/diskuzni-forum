<?php


namespace Forum\endpoints;

use Forum\providers\UserProvider;
use Forum\utils\RESPONSES;

class User extends Endpoint {
	public function get_get($username) {
		try {
			$provider = new UserProvider();
			$res = $provider->getByUsername($username);
			return (string) RESPONSES::OK($res);
		} catch(\Exception $e) {
			if($e->getCode() == 404) {
				return (string) RESPONSES::NOT_FOUND($e->getMessage());
			} else {
				return (string)RESPONSES::FORBIDDEN($e->getMessage());
			}
		}
	}
}