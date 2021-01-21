<?php

namespace Forum\utils;
class Arrays {
	public static function singleAssocToObj(array $arr, string $class): object {
		$reflection = new \ReflectionClass($class);
		$obj = $reflection->newInstanceWithoutConstructor();
		foreach($arr as $key => $value) {
			$property = $reflection->getProperty($key);
			$property->setAccessible(true);
			$property->setValue($obj, $value);
		}
		return $obj;
	}

	public static function arrayAssocToObj(array $arr, string $class): array {
		$result = [];
		foreach($arr as $key => $item) {
			if(!is_int($key))
				return [Arrays::singleAssocToObj($arr, $class)];
			array_push($result, Arrays::singleAssocToObj($item, $class));
		}
		return $result;
	}
}