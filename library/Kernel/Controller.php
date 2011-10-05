<?php
namespace Kernel;

class Controller
{
    private $_view = null;

    public function __construct(View $view)
    {
        $this->setView($view);
    }

    public function setView(View $view)
    {
        $this->_view = $view;
    }

    public function getView()
    {
        return $this->_view;
    }

    protected function _getParam($name, $default=null)
    {
        if (array_key_exists($name, $_REQUEST)) return $_REQUEST[$name];
        return $default;
    }

    protected function _getAllParams()
    {
        return $_REQUEST;
    }

    protected function _redirect($uri)
    {
        header('Location: ' .  $uri);
        exit;
    }

    public function dispatch($controllerName, $actionName)
    {
        $this->$actionName();
        $this->getView()->render($controllerName . '/' . $actionName);
    }
}

