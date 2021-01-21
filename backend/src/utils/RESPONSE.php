<?php

namespace Forum\utils;
class RESPONSE {
	public int $status;
	public string $content;
	public string $msg;

	public function __construct(int $status, string $content, string $msg) {
		$this->status = $status;
		$this->content = $content;
		$this->msg = $msg;
	}

	public function __toString(): string {
		return json_encode($this, true);
	}
}
