<?php
namespace Application\Model\Factory;
use Application\Model\Tweet as Model;

class Tweet
{
    public static function create(array $data)
    {
        $tweet = new Model;
        $tweet->setName($data['name']);
        $tweet->setMessage($data['message']);
        $tweet->setTimeStamp($data['timestamp']);
        if (array_key_exists('tweets', $data)) {
            if (is_string($data['tweets'])) {
                $data['tweets'] = unserialize($data['tweets']);
            }
            foreach ($data['tweets'] as $_data) {
                $tweet->add(self::create($_data));
            }
        }
        return $tweet;
    }
}

