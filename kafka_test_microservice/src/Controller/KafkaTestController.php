<?php

namespace App\Service;

use Enqueue\RdKafka\RdKafkaConnectionFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

class KafkaTestConsumer
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function consume()
    {
        $connectionFactory = new RdKafkaConnectionFactory($this->container->getParameter('enqueue'));

        $context = $connectionFactory->createContext();
        $topic = $context->createTopic('test_topic');

        $consumer = $context->createConsumer($topic);

        while (true) {
            $message = $consumer->receive();

            if ($message) {
                echo 'Received message: ' . $message->getBody() . PHP_EOL;
                $consumer->acknowledge($message);
            }
        }
    }
}
