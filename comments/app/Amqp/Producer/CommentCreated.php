<?php

declare(strict_types=1);

namespace Comments\Amqp\Producer;

use Hyperf\Amqp\Annotation\Producer;
use Hyperf\Amqp\Message\ProducerMessage;

#[Producer(exchange: 'comments', routingKey: 'comment-created')]
class CommentCreated extends ProducerMessage
{
    public function __construct($data)
    {
        $this->payload = $data;
    }
}
