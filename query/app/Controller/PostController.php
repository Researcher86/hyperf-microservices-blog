<?php

declare(strict_types=1);

namespace Query\Controller;

use Query\Model\Post;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

#[Controller(prefix: "/posts")]
class PostController extends AbstractController
{
    #[RequestMapping(path:"", methods: "get")]
    public function getPosts()
    {
        return $this->response
            ->json(Post::all());
    }
}
