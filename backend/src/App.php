<?php

namespace Forum;

use Medoo\Medoo;
use ReflectionClass;
use Slim\Factory\AppFactory;

class App {
	public static $slim;
	public static $db;

	public function __construct() {
		$this->loadSlim();
		$this->loadEndpoints();
		App::$slim->run();
		$this->loadDb();
	}

	private function loadSlim() {
		$slim = AppFactory::create();
		$slim->addRoutingMiddleware();
		$slim->setBasePath('/api/v1');
		$errorMiddleware = $slim->addErrorMiddleware(true, true, true);
		App::$slim = $slim;
	}

	private function loadEndpoints(): void {

	}

	private function registerEndpoint($class, $pattern): void {
		$reflection = new ReflectionClass($class);
		$reflection->newInstance($pattern);
	}

	private function loadDb(): void {
		$db = new Medoo([
			'database_type' => DB_DRIVER,
			'database_name' => DB_DBNAME,
			'server' => DB_HOST,
			'username' => DB_USER,
			'password' => DB_PASSWORD
		]);
		App::$db = $db;
	}
}
