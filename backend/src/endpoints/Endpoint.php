<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;

class Endpoint
{
	/**
	 * @var string
	 */
	private $pattern;

	function __construct($app, $pattern) {
		$this->pattern = $pattern;

		$app->group($pattern, function(RouteCollectorProxy $app) {
			$this->loadMethods($app);
		});
	}

	public function get_lolec() {
		return "lulec";
	}

	private function loadMethods($app) {
		$classReflection = new ReflectionClass($this);
		$methods = $classReflection->getMethods(ReflectionMethod::IS_PUBLIC);

		foreach($methods as $method) {
			if($method->name != '__construct') {
				$requestMethods = ['get_', 'post_', 'put_', 'delete_'];
				for($i = 0; $i < sizeof($requestMethods); ++$i) {
					if(substr($method->name, 0, strlen($requestMethods[$i])) === $requestMethods[$i]) {
						$requestMethod = $requestMethods[$i];
						break;
					}
				}

				if(!isset($requestMethod)) break;

				$methodName = substr($method->name, strlen($requestMethod));

				$path = "/{$methodName}";

				$methodReflection = new ReflectionMethod($this, $method->name);
				$params = $methodReflection->getParameters();

				error_log($requestMethod);
				if($requestMethod != 'post_') {
					foreach($params as $param) {
						$path .= "/{{$param->getName()}}";
					}
				}

				$app->{substr($requestMethod, 0, -1)}($path, function(Request $request, Response $response, $args) use ($method, $requestMethod) {
					if($requestMethod == 'post_') $args += $_POST;
					$response->getBody()->write($method->invokeArgs($this, $args));
					return $response;
				});
			}
		}
	}
}