<?php

namespace Forum\entities;
trait Entity {
	public function fullSerialize() {
		$arr = get_object_vars($this);
		return $arr;
	}
}
