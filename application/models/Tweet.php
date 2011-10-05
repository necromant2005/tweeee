<?php
namespace Application\Model;

class Tweet implements \IteratorAggregate
{
    protected $_name = '';
    protected $_message = '';
    protected $_timeStamp = 0;

    protected $_tweets = array();

    public function setName($name)
    {
        if (empty($name)) throw new \InvalidArgumentException('Empty name');
        $this->_name = $name;
    }

    public function setMessage($message)
    {
        if (empty($message)) throw new \InvalidArgumentException('Empty message');
        if (strlen($message)>160) throw new \InvalidArgumentException('Message lenght more than alowed 160 symbols');
        $this->_message = $message;
    }

    public function setTimeStamp($timeStamp)
    {
        $this->_timeStamp = abs($timeStamp);
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getMessage()
    {
        return $this->_message;
    }

    public function getTimeStamp()
    {
        return $this->_timeStamp;
    }

    public function getId()
    {
        return md5(md5($this->getName()) . md5($this->getMessage()) . md5($this->getTimeStamp()));
    }

    public function getIterator()
    {
        return new \ArrayObject($this->_tweets);
    }

    public function add(Tweet $tweet)
    {
        $this->_tweets[] = $tweet;
    }
}

