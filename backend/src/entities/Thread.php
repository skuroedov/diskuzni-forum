<?php

namespace Forum\entities;
class Thread {
	use Entity;

	public int $id;
	public string $title;
	public $author;
	public string $created;
	public string $edited;
	public int $category;
	public bool $locked;
	public string $text;
}