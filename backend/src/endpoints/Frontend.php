<?php


namespace Forum\endpoints;


class Frontend extends Endpoint {
	public function get_() {
		return file_get_contents('../frontend/index.html');
	}
}