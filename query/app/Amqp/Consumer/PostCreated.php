<?php

declare(strict_types=1);

namespace App\Amqp\Consumer;

use App\Model\Post;
use Hyperf\Amqp\Result;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Logger\LoggerFactory;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;

#[Consumer(exchange: 'events', routingKey: 'posts', queue: 'posts', name: "PostCreated", nums: 1)]
class PostCreated extends ConsumerMessage
{
    private LoggerInterface $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        $this->logger = $loggerFactory->get('log');
    }

    public function consumeMessage($data, AMQPMessage $message): string
    {
        $this->logger->info('Received message PostCreated.', $data);

        $post = Post::query()->where('post_id', '=', $data['id'])->first();
        if (!$post) {
            $post = Post::create(['post_id' => $data['id'], 'title' => $data['title']]);
            $post->save();
            $this->logger->info('Created new Post', (array) $post);
        }

        return Result::ACK;
    }
}
