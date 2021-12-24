<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Comment;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

#[Controller(prefix: "/comments")]
class CommentController extends AbstractController
{
    #[RequestMapping(path:"", methods: "get")]
    public function getPosts()
    {
        return $this->response
            ->json(Comment::all());
    }
}
