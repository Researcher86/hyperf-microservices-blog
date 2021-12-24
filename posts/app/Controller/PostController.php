<?php

declare(strict_types=1);

namespace App\Controller;

use App\Amqp\Producer\PostCreated;
use App\Model\Post;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

#[Controller(prefix: "/posts")]
class PostController extends AbstractController
{
    #[RequestMapping(path:"", methods: "get,post")]
    public function posts()
    {
        if ($this->request->getMethod() === 'POST') {
            return $this->addPost();
        }

        return $this->getPosts();
    }

    private function getPosts()
    {
        return $this->response
            ->json(Post::all());
    }

    private function addPost()
    {
        $data = json_decode($this->request->getBody()->getContents(), true);
        $post = Post::create($data);
        $post->save();

        $this->producer->produce(new PostCreated($post));

        return $this->response
            ->json($post)
            ->withStatus(201);
    }
}
