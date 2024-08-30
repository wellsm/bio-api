<?php

declare(strict_types=1);

use Hyperf\Cache\Driver\FileSystemDriver;
use Hyperf\Codec\Packer\PhpSerializerPacker;

/*
 * This file is part of Hyperf.
 *
 * @see     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'default' => [
        'driver' => FileSystemDriver::class,
        'packer' => PhpSerializerPacker::class,
        'prefix' => 'c:',
    ],
];
