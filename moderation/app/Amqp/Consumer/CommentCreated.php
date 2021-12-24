<?php

declare(strict_types=1);

namespace App\Amqp\Consumer;

use App\Model\Comment;
use Hyperf\Amqp\Producer;
use App\Amqp\Producer\CommentModerated;
use Hyperf\Amqp\Result;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\Str;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;
use Swoole\Coroutine\System;

#[Consumer(exchange: 'comments', routingKey: 'comment-created', queue: 'moderation-comment-created', name: "CommentCreated", nums: 1)]
class CommentCreated extends ConsumerMessage
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
        $this->logger->info('Received message CommentCreated.', $data);

        $commment = Comment::query()->where('comment_id', '=', $data['id'])->first();
        if (!$commment) {
            $commment = Comment::create([
                'post_id' => $data['post_id'],
                'comment_id' => $data['id'],
                'content' => $data['content'],
                'status' => $data['status']]
            );

            if (Str::contains(Comment::STATUS_APPROVED, $data['content'])) {
                $commment->status = Comment::STATUS_APPROVED;
            }

            if (Str::contains(Comment::STATUS_REJECTED, $data['content'])) {
                $commment->status = Comment::STATUS_REJECTED;
            }

            $commment->save();

            if (in_array($commment->status, [Comment::STATUS_APPROVED, Comment::STATUS_REJECTED], true)) {
                $this->logger->debug('Send message CommentModerated.');
                $this->producer->produce(new CommentModerated($commment));
            }

        } else {
            $this->logger->warning(sprintf('Comment by comment_id [%d] already exists.', $data['id']), $data);
        }

        return Result::ACK;
    }
}
