<?php

declare(strict_types=1);

use Hyperf\HttpServer\Router\Router;

use Application\Http\Controller;
use Application\Http\Middleware\VerifyJWTMiddleware;
use Application\Http\Middleware\VerifyProfileKeyMiddleware;

Router::addGroup('/api', function () {
    Router::get('/health', fn () => 'Alive');

    // ------ Documentation ------
    Router::get('/documentation', Controller\Documentation\IndexController::class);

    // ------ User ------
    Router::post('/users', Controller\User\UserCreateController::class);
    Router::post('/users/auth', Controller\User\UserAuthController::class);

    // ------ Password ------
    Router::post('/password', Controller\Password\PasswordSetController::class);

    Router::addGroup('', function () {
        // ------ Bio ------
        Router::get('/bio', Controller\Bio\IndexController::class);
        Router::get('/bio/collections/{collection}', Controller\Bio\CollectionController::class);
        Router::post('/interaction', Controller\Interaction\InteractionCreateController::class);
    }, [
        'middleware' => [VerifyProfileKeyMiddleware::class]
    ]);

    Router::addGroup('', function () {
        // ------ Profile ------
        Router::post('/profile', Controller\Profile\ProfileCreateController::class);

        Router::addGroup('', function () {
            Router::get('/overview', Controller\Overview\OverviewController::class);

            // ------ Collection ------
            Router::get('/collections', Controller\Collection\CollectionListController::class);
            Router::get('/collections/links', Controller\Collection\CollectionLinkListController::class);
            Router::post('/collections', Controller\Collection\CollectionCreateController::class);
            Router::put('/collections/{collection}', Controller\Collection\CollectionUpdateController::class);
            Router::delete('/collections/{collection}', Controller\Collection\CollectionDeleteController::class);
        
            // ------ Link ------
            Router::get('/links', Controller\Link\LinkListController::class);
            Router::post('/links', Controller\Link\LinkCreateController::class);
            Router::put('/links/{link}', Controller\Link\LinkUpdateController::class);
            Router::put('/links/{link}/toggle', Controller\Link\LinkToggleController::class);
            Router::put('/links/{link}/toggle/fixed', Controller\Link\LinkToggleFixedController::class);
            Router::delete('/links/{link}', Controller\Link\LinkDeleteController::class);

            // ------ Social Media ------
            Router::get('/social-medias', Controller\SocialMedia\SocialMediaListController::class);
            Router::post('/social-medias', Controller\SocialMedia\SocialMediaCreateController::class);
            Router::put('/social-medias/ordering', Controller\SocialMedia\SocialMediaOrderingController::class);
            Router::put('/social-medias/{media:\d+}', Controller\SocialMedia\SocialMediaUpdateController::class);

            // ------ Profile ------
            Router::get('/profile', Controller\Profile\ProfileShowController::class);
            Router::put('/profile', Controller\Profile\ProfileUpdateController::class);

            // ------ Settings ------
            Router::get('/configs', Controller\Config\ConfigListController::class);
            Router::put('/configs', Controller\Config\ConfigUpdateController::class);
        }, [
            'middleware' => [VerifyProfileKeyMiddleware::class]
        ]);
    }, [
        'middleware' => [VerifyJWTMiddleware::class]
    ]);
});