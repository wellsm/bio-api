<?php

declare(strict_types=1);

return [
    Core\Repositories\PasswordTokenRepository::class => Infrastructure\Repositories\PasswordTokenDatabaseRepository::class,
    Core\Repositories\UserRepository::class          => Infrastructure\Repositories\UserDatabaseRepository::class,
    Core\Repositories\CollectionRepository::class    => Infrastructure\Repositories\CollectionDatabaseRepository::class,
    Core\Repositories\LinkRepository::class          => Infrastructure\Repositories\LinkDatabaseRepository::class,
    Core\Repositories\ConfigurationRepository::class => Infrastructure\Repositories\ConfigurationDatabaseRepository::class,
    Core\Repositories\ProfileRepository::class       => Infrastructure\Repositories\ProfileDatabaseRepository::class,
    Core\Repositories\SocialMediaRepository::class   => Infrastructure\Repositories\SocialMediaDatabaseRepository::class,
];
