<?php
namespace Application;

use Kernel\Registry;
use Kernel\Loader;
use Kernel\View;

require_once __DIR__ . '/../library/Kernel/Registry.php';
require_once __DIR__ . '/../library/Kernel/Loader.php';


class Bootstrap
{
    public function getOptions($section)
    {
        $config = include(__DIR__ . '/configs/application.php');
        return $config[$section];
    }

    protected function _initTimeZone()
    {
        date_default_timezone_set('Europe/Kiev');
    }

    protected function _initLoader()
    {
        Loader::configure($this->getOptions('loader'));
        Loader::register();
    }

    protected function _initDB()
    {
        $options = $this->getOptions('db');
        Registry::set('db', new \PDO($options['dns'], $options['username'], $options['password']));
    }

    protected function _run()
    {
        $options = $this->getOptions('router');
        list($uri) = explode('?', $_SERVER['REQUEST_URI']);
        if (!array_key_exists($uri, $options)) throw new \DomainException('Page not found');
        list($controllerName, $actionName) = $options[$uri];

        $className = 'Application\\Controller\\' . ucfirst($controllerName);
        $controller = new $className(new View(__DIR__ . '/views/scripts'));
        $controller->dispatch($controllerName, $actionName);
    }

    public function run()
    {
        $this->_initTimeZone();
        $this->_initLoader();
        $this->_initDB();
        $this->_run();
    }
}

