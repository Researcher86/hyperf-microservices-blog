<?php

declare(strict_types=1);

namespace App\Amqp\Consumer;

use App\Amqp\Producer\CommentUpdated;
use App\Model\Comment;
use Hyperf\Amqp\Producer;
use Hyperf\Amqp\Result;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Logger\LoggerFactory;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;

#[Consumer(exchange: 'comments', routingKey: 'comment-moderated', queue: 'comment-comment-moderated', name: "CommentModerated", nums: 1)]
class CommentModerated extends ConsumerMessage
{
    private LoggerInterface $logger;
    private Producer $producer;

    public function __construct(LoggerFactory $loggerFactory, Producer $producer)
    {
        $this->logger = $loggerFactory->get('log');
        $this->producer = $producer;
    }

    public function consumeMessage($data, AMQPMessage $message): string
    {
        $this->logger->warning('Received message CommentModerated.', $data);

        $comment = Comment::find($data['comment_id']);
        if ($comment) {
            $comment->status = $data['status'];
            $comment->save();

            $this->producer->produce(new CommentUpdated($comment));
        } else {
            $this->logger->warning(sprintf('Comment by id [%d] not found.', $data['comment_id']));
        }

        return Result::ACK;
    }
}
