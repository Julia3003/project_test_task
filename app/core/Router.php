<?php

namespace core;

class Router
{
    const DEFAULT_ACTION = 'index';
    const DEFAULT_CONTROLLER = 'Task';
    /**
     * створює обєєкт на основі відповідного контролера та запускає виконання відповідного методу
     * @return void
     */
    static public function init(): void
    {
        $getUri = self::getUri();
        $controllerName = $getUri['controller_name'];
        $action = $getUri['action_name'];

        if (!class_exists($controllerName)) {
            self::notFound();
        }
        $controller = new $controllerName();
        if (!method_exists($controller, $action)) {
            self::notFound();
        }
        $controller->$action();
    }

    /**
     * отримує імєя контролера та назву action з URI
     * @return array
     */
    static public function getUri() :array
    {
        $route = $_SERVER['REDIRECT_URL'] ?? $_SERVER['REQUEST_URI'];
        // Разбиваем строку по символу "/"
        $routeArray = explode('/', $route);
        // Фильтруем пустые элементы массива
        $routeArray = array_filter($routeArray);
        // Преобразуем индексы массива в числа (если нужно)
        $routeArray = array_values($routeArray);
        $controllerName = $routeArray[0] ?? self::DEFAULT_CONTROLLER;
        $controllerName = trim($controllerName);
        $controllerName = strtolower($controllerName);
        $controllerName = ucfirst($controllerName);
        $controllerName = '\controllers\\' . $controllerName . 'Controller';
        $action = $routeArray[1] ?? self::DEFAULT_ACTION;
        $action = trim($action);
        $action = strtolower($action);
        $return['controller_name'] = $controllerName;
        $return['action_name'] = $action;
        return $return;
    }

    /**
     * відображає помилку 404, якщо сторінка не знайдена
     * send status 404
     */
    static public function notFound(): void
    {
        http_response_code(404);
        exit();
    }
}