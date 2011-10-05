<?php
namespace Application\Controller;
use Kernel\Controller;
use Application\Model\Repository;
use Application\Model\Factory;

class Index extends Controller
{
    public function index()
    {
        $repository = new Repository\Tweet();
        $this->getView()->tweets = $repository->findAll();
    }

    public function save()
    {
        try {
            $tweet = Factory\Tweet::create(array(
                'name' => $this->_getParam('name'),
                'message' => $this->_getParam('message'),
                'timestamp' => time(),
            ));
            $repository = new Repository\Tweet();
            $parentTweet = $repository->find($this->_getParam('id'));
            if (!$parentTweet) {
                $repository->save($tweet);
            } else {
                $parentTweet->add($tweet);
                $repository->save($parentTweet);
            }
            $this->getView()->message = 'OK';
        } catch (\InvalidArgumentException $exception) {
            $this->getView()->message = $exception->getMessage();
        }
    }
}

