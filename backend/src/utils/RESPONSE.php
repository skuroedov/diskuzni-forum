<?php

namespace Forum\utils;
class RESPONSE {
	public int $status;
	public $content;
	public string $msg;

	public function __construct(int $status, $content, string $msg) {
		$this->status = $status;
		$this->content = $content;
		$this->msg = $msg;
	}

	public function __toString(): string {
		return json_encode($this, true);
	}
}
