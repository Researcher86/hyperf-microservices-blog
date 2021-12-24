<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Post;
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
