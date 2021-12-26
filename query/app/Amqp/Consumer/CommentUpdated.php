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

#[Consumer(exchange: 'comments', routingKey: 'comment-updated', queue: 'query-comment-updated', name: "CommentUpdated", nums: 1)]
class CommentUpdated extends ConsumerMessage
{
    private LoggerInterface $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        $this->logger = $loggerFactory->get('log');
    }

    public function consumeMessage($data, AMQPMessage $message): string
    {
        $this->logger->debug('Received messsage CommentUpdated.', $data);

        $post = Post::where(['post_id' => $data['post_id']])->first();
        if ($post) {
            $comments = $post->comments;

            foreach ($comments as &$comment) {
                if ($comment['id'] === $data['id']) {
                    $comment['status'] = $data['status'];
                }
            }

            $post->comments = $comments;
            $post->save();
        } else {
            $this->logger->warning(sprintf('Post by id [%d] not found.', $data['post_id']));
        }

        return Result::ACK;
    }
}
