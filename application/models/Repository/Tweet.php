<?php
namespace Application\Model\Repository;
use Application\Model\Factory\Tweet as Factory;
use Application\Model as Model;

class Tweet
{
    public function find($id)
    {
        $statement = \Kernel\Registry::get('db')->prepare('SELECT * FROM tweets WHERE id=:id');
        $statement->bindParam('id', $id, \PDO::PARAM_STR, 32);
        $statement->execute();
        $response = $statement->fetch(\PDO::FETCH_ASSOC);
        if (!$response) return null;
        return Factory::create($response);
    }

    public function findAll()
    {
        $response = array();
        $statement = \Kernel\Registry::get('db')->prepare('SELECT * FROM tweets');
        $statement->execute();
        foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $item) {
            $response[] = \Application\Model\Factory\Tweet::create($item);
        }
        return $response;
    }

    public function save(Model\Tweet $tweet)
    {
        $tweets = array();
        foreach($tweet as $item) {
            $tweets[] = array(
                'name' => $item->getName(),
                'message' => $item->getMessage(),
                'timestamp' => $item->getTimeStamp(),
            );
        }
        if ($this->find($tweet->getId())) {
            $sql = 'UPDATE tweets SET tweets=:tweets WHERE id=:id';
            $statement = \Kernel\Registry::get('db')->prepare($sql);
            @$statement->bindParam('id', $tweet->getId(), \PDO::PARAM_STR, 32);
            @$statement->bindParam('tweets', serialize($tweets), \PDO::PARAM_STR);
            return $statement->execute();
        }
        $sql = 'INSERT INTO tweets(id, name, message, timestamp, tweets) VALUES(:id, :name, :message, :timestamp, :tweets)';
        $statement = \Kernel\Registry::get('db')->prepare($sql);
        @$statement->bindParam('id', $tweet->getId(), \PDO::PARAM_STR, 32);
        @$statement->bindParam('name', $tweet->getName(), \PDO::PARAM_STR, 32);
        @$statement->bindParam('message', $tweet->getMessage(), \PDO::PARAM_STR, 160);
        @$statement->bindParam('timestamp', $tweet->getTimeStamp(), \PDO::PARAM_INT);
        @$statement->bindParam('tweets', serialize($tweets), \PDO::PARAM_STR);
        return $statement->execute();
    }
}

