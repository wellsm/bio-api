<?php

declare(strict_types=1);

namespace Core\Helper;

class Util
{
    private const LOCALE_PT_BR = 'pt_BR';
    private const LOCALE_EN_US = 'en';
    
    public const DEFAULT_LOCALE = self::LOCALE_PT_BR;
    public const PER_PAGE = 10;

    public static function otp(int $digits = 7): string
    {
        $generator = implode(range(0, 9));
        $result    = '';

        for ($i = 1; $i <= $digits; ++$i) {
            $result .= substr($generator, rand() % strlen($generator), 1);
        }

        return $result;
    }

    public static function options(array $values): array
    {
        $options = [];

        foreach ($values as $key => $value) {
            $options[] = compact('key', 'value');
        }

        return $options;
    }
}
