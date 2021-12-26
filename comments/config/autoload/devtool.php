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
                'namespace' => 'Comments\\Amqp\\Consumer',
            ],
            'producer' => [
                'namespace' => 'Comments\\Amqp\\Producer',
            ],
        ],
        'aspect' => [
            'namespace' => 'Comments\\Aspect',
        ],
        'command' => [
            'namespace' => 'Comments\\Command',
        ],
        'controller' => [
            'namespace' => 'Comments\\Controller',
        ],
        'job' => [
            'namespace' => 'Comments\\Job',
        ],
        'listener' => [
            'namespace' => 'Comments\\Listener',
        ],
        'middleware' => [
            'namespace' => 'Comments\\Middleware',
        ],
        'Process' => [
            'namespace' => 'Comments\\Processes',
        ],
    ],
];
