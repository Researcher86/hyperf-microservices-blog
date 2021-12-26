<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'generator' => [
        'amqp' => [
            'consumer' => [
                'namespace' => 'Posts\\Amqp\\Consumer',
            ],
            'producer' => [
                'namespace' => 'Posts\\Amqp\\Producer',
            ],
        ],
        'aspect' => [
            'namespace' => 'Posts\\Aspect',
        ],
        'command' => [
            'namespace' => 'Posts\\Command',
        ],
        'controller' => [
            'namespace' => 'Posts\\Controller',
        ],
        'job' => [
            'namespace' => 'Posts\\Job',
        ],
        'listener' => [
            'namespace' => 'Posts\\Listener',
        ],
        'middleware' => [
            'namespace' => 'Posts\\Middleware',
        ],
        'Process' => [
            'namespace' => 'Posts\\Processes',
        ],
    ],
];
