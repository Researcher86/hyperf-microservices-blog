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
                'namespace' => 'Query\\Amqp\\Consumer',
            ],
            'producer' => [
                'namespace' => 'Query\\Amqp\\Producer',
            ],
        ],
        'aspect' => [
            'namespace' => 'Query\\Aspect',
        ],
        'command' => [
            'namespace' => 'Query\\Command',
        ],
        'controller' => [
            'namespace' => 'Query\\Controller',
        ],
        'job' => [
            'namespace' => 'Query\\Job',
        ],
        'listener' => [
            'namespace' => 'Query\\Listener',
        ],
        'middleware' => [
            'namespace' => 'Query\\Middleware',
        ],
        'Process' => [
            'namespace' => 'Query\\Processes',
        ],
    ],
];
