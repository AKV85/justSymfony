<?php

use Enqueue\RdKafka\RdKafkaConnectionFactory;

require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../config/rdkafka_config.php';

class KafkaConsumer
{
    public function consume()
    {

        global $config;
        $connectionFactory = new RdKafkaConnectionFactory($config);
        $context = $connectionFactory->createContext();

        $infoQueue = $context->createQueue('information');

        $consumer = $context->createConsumer($infoQueue);

        while (true) {
            $message = $consumer->receive();

            if ($message) {
                #output message
                echo $message->getBody() . PHP_EOL;

                $consumer->acknowledge($message);
            }
        }
    }
}

$consumer = new KafkaConsumer();
$consumer->consume();
