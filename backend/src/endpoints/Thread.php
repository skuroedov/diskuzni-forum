<?php


namespace Forum\endpoints;


use Forum\providers\ThreadProvider;
use Forum\utils\RESPONSES;

class Thread extends Endpoint {
	public function get_(): string {
		$provider = new ThreadProvider();
		try {
			$res = $provider->getAll();
			return (string) RESPONSES::OK($res);
		} catch(\Exception $e) {
			$msg = $e->getMessage();
			return (string) RESPONSES::FORBIDDEN($msg);
		}
	}

	public function post_add($title, $text): string {
		$provider = new ThreadProvider();
		try {
			$res = $provider->createNew($title, $text);
			return (string) RESPONSES::OK($res);
		} catch(\Exception $e) {
			$msg = $e->getMessage();
			return (string) RESPONSES::FORBIDDEN($msg);
		}
	}
}