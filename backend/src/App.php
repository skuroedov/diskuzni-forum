<?php

namespace Forum;

use Forum\endpoints\Auth;
use Forum\endpoints\Frontend;
use Medoo\Medoo;
use Noodlehaus\Config;
use ReflectionClass;
use Slim\Factory\AppFactory;

class App {
	private static Config $config;
	private static \Slim\App $slim;
	private static Medoo $db;

	public function __construct() {
		$this->loadConfig();
		$this->loadDb();
		$this->loadSlim();
		$this->loadEndpoints();
		App::$slim->run();
	}

	private function loadConfig(): void {
		App::$config = Config::load(__DIR__.'/config.ini');
	}

	private function loadSlim(): void {
		$slim = AppFactory::create();
		$slim->addRoutingMiddleware();
		//$slim->setBasePath('/');
		$errorMiddleware = $slim->addErrorMiddleware(true, true, true);
		App::$slim = $slim;
	}

	private function loadEndpoints(): void {
		$this->registerEndpoint(Auth::class, '/api/v1/auth');
		$this->registerEndpoint(Frontend::class, '/frontend');
	}

	private function registerEndpoint($class, $pattern): void {
		$reflection = new ReflectionClass($class);
		$reflection->newInstance($pattern);
	}

	private function loadDb(): void {
		$db = new Medoo([
			'database_type' => App::$config->get('Database.driver'),
			'database_name' => App::$config->get('Database.name'),
			'server' => App::$config->get('Database.host'),
			'username' => App::$config->get('Database.user'),
			'password' => App::$config->get('Database.password')
		]);
		App::$db = $db;
	}

	public static function getConfig(): Config {
		return App::$config;
	}

	public static function getSlim(): \Slim\App {
		return App::$slim;
	}

	public static function getDb(): Medoo {
		return App::$db;
	}
}
