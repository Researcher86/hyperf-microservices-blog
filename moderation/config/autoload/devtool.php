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
                'namespace' => 'Moderation\\Amqp\\Consumer',
            ],
            'producer' => [
                'namespace' => 'Moderation\\Amqp\\Producer',
            ],
        ],
        'aspect' => [
            'namespace' => 'Moderation\\Aspect',
        ],
        'command' => [
            'namespace' => 'Moderation\\Command',
        ],
        'controller' => [
            'namespace' => 'Moderation\\Controller',
        ],
        'job' => [
            'namespace' => 'Moderation\\Job',
        ],
        'listener' => [
            'namespace' => 'Moderation\\Listener',
        ],
        'middleware' => [
            'namespace' => 'Moderation\\Middleware',
        ],
        'Process' => [
            'namespace' => 'Moderation\\Processes',
        ],
    ],
];
