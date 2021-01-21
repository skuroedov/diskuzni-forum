<?php

namespace Forum\utils;

class RESPONSES {
	private static function MY_RESPONSE(int $status, $content, string $msg) {
		return (new RESPONSE($status, $content, $msg));
	}

	public static function OK($content) {
		return RESPONSES::MY_RESPONSE(200, $content, 'OK');
	}

	public static function FORBIDDEN(string $msg) {
		return RESPONSES::MY_RESPONSE(403, '', $msg ?? 'Forbidden');
	}

	public static function NOT_FOUND(string ...$msg) {
		return RESPONSES::MY_RESPONSE(404, '', $msg ?? 'Not found');
	}
}
