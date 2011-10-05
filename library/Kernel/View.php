<?php
namespace Kernel;

class View
{
    const EXTENSION = '.phtml';

    protected $_path = '';

    protected $_varibales = array();

    public function __construct($path)
    {
        $this->setPath($path);
    }

    public function __get($name)
    {
        if (!$this->__isset($name)) return null;
        return $this->_varibales[$name];
    }

    public function __set($name, $value)
    {
        $this->_varibales[$name] = $value;
    }

    public function __isset($name)
    {
        return array_key_exists($name, $this->_varibales);
    }

    public function setPath($path)
    {
        $this->_path = $path;
    }

    public function getPath()
    {
        return $this->_path;
    }

    public function render($file)
    {
        include($this->getPath() . '/' . $file . self::EXTENSION);
    }
}

