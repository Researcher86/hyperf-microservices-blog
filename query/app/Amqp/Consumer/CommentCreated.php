<?php

declare(strict_types=1);

namespace Query\Amqp\Consumer;

use Query\Model\Post;
use Hyperf\Amqp\Result;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Logger\LoggerFactory;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;

#[Consumer(exchange: 'comments', routingKey: 'comment-created', queue: 'query-comment-created', name: "CommentCreated", nums: 1)]
class CommentCreated extends ConsumerMessage
{
    private LoggerInterface $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        $this->logger = $loggerFactory->get('log');
    }

    public function consumeMessage($data, AMQPMessage $message): string
    {
        $this->logger->info('Received message CommentCreated.', $data);

        $post = Post::query()->where('post_id', '=', $data['post_id'])->first();
        if ($post) {
            $comments = $post->comments;
            $comments[] = [
                'id' => $data['id'],
                'content' => $data['content'],
                'status' => $data['status']
            ];
            $post->comments = $comments;

            $post->save();
        } else {
            $this->logger->warning(sprintf('Post by post_id [%d] not found.', $data['post_id']), $data);
        }

        return Result::ACK;
    }
}
