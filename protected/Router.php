<?php

require_once ('controllers/TestController.php');
require_once ('controllers/StartController.php');
require_once ('controllers/UserController.php');

function safe_require($path) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/protected/' . $path);
}

class Router
{
    public function initialize(){
        $requestURL = $_SERVER['REQUEST_URI'];

        if ($requestURL === '/') {
            $matches[] = '';
            $matches[] = 'start';
            $matches[] = 'start';
        } else {
            preg_match('/\/([\s\S]+)\/([\w0-9-_]+)([?\s\S]+)*/', $requestURL, $matches, PREG_UNMATCHED_AS_NULL);
            if (count($matches) < 3) {
                $this->return404('паттерн говно');
                return;
            }
        }
        $this->matchRoute($matches[1], $matches[2]);
    }
    private function matchRoute($controllerName, $actionName) {

        switch (strtolower($controllerName)) {
            case 'test':
                $controller = new TestController();
                switch (strtolower($actionName)) {
                    case 'test':
                        $controller->testAction();
                        break;
                    case 'showall':
                        $controller->showALlAction();
                        break;
                    case 'create':
                        $controller->createAction();
                        break;
                    default:
                        $this->return404('метод говно');
                        return;
                }
                break;
            case 'start':
                $controller = new StartController();
                switch (strtolower($actionName)) {
                    case 'start':
                        $controller->startAction();
                        break;
                    default:
                        $this->return404('метод говно');
                        return;
                }
                break;

            default:
                $this->return404('контроллер говно');
                return;
        }

    }
    private function return404($message){
        header('HTTP/1.0 404 Not Found');
        header('Status: 404 Not Found');
        echo $message;
    }
}