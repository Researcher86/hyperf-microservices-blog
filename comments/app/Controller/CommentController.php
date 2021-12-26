<?php

declare(strict_types=1);

namespace Comments\Controller;

use Comments\Amqp\Producer\CommentCreated;
use Comments\Model\Comment;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

#[Controller(prefix: "/posts/{postId:\d+}")]
class CommentController extends AbstractController
{
    #[RequestMapping(path: "comments", methods: "get,post")]
    public function comments(int $postId)
    {
        if ($this->request->getMethod() === 'POST') {
            return $this->addComment($postId);
        }

        return $this->getComments($postId);
    }

    private function addComment(int $postId)
    {
        $data = json_decode($this->request->getBody()->getContents(), true);
        $data['post_id'] = $postId;
        $data['status'] = Comment::STATUS_PENDING;
        $comment = Comment::create($data);

        $this->producer->produce(new CommentCreated($comment));

        $comments = Comment::query()->where('post_id', '=', $postId)->get();

        return $this->response->json($comments)->withStatus(201);
    }

    private function getComments(int $postId)
    {
        $comments = Comment::query()->where('post_id', '=', $postId)->get();

        return $this->response->json($comments);
    }
}
