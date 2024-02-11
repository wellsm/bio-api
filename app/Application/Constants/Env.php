<?php

declare(strict_types=1);

namespace Application\Constants;

use function Hyperf\Support\env;

class Env
{
    public const LOCAL      = 'local';
    public const PRODUCTION = 'production';

    public static function isLocal()
    {
        return env('APP_ENV') == self::LOCAL;
    }

    public static function isProduction()
    {
        return env('APP_ENV') == self::PRODUCTION;
    }

    public static function ifLocal(mixed $ifTrue, mixed $ifFalse): mixed
    {
        return self::isLocal() ? $ifTrue : $ifFalse;
    }

    public static function ifProduction(mixed $ifTrue, mixed $ifFalse): mixed
    {
        return self::isProduction() ? $ifTrue : $ifFalse;
    }
}
