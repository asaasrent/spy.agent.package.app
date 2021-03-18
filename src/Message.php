<?php

namespace SpyAgent;


use Kreait\Firebase\Factory;


class Message
{
    public function display()
    {
        $factory = (new Factory)->withServiceAccount('/path/to/firebase_credentials.json');
        $firestore = $factory->createFirestore();
        echo 'hello from message class';
    }


}
