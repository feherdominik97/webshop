<?php

namespace App;

use Exception;

/**
 *
 */
class Router
{
    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @param $route
     * @param $controller
     * @param $action
     * @param $method
     * @return void
     */
    private function addRoute($route, $controller, $action, $method)
    {
        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    /**
     * @param $route
     * @param $controller
     * @param $action
     * @return void
     */
    public function get($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "GET");
    }

    /**
     * @param $route
     * @param $controller
     * @param $action
     * @return void
     */
    public function post($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "POST");
    }

    /**
     * @param $route
     * @param $controller
     * @param $action
     * @return void
     */
    public function delete($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "DELETE");
    }

    /**
     * @throws Exception
     */
    public function dispatch()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method =  $_SERVER['REQUEST_METHOD'];

        if (array_key_exists($uri, $this->routes[$method])) {
            $controller = $this->routes[$method][$uri]['controller'];
            $action = $this->routes[$method][$uri]['action'];

            $controller = new $controller();
            $controller->$action();
        } else {
            throw new Exception("No route found for URI: $uri");
        }
    }
}