<?php

declare(strict_types=1);

use Hyperf\HttpServer\Router\Router;

use Application\Http\Controller;
use Application\Http\Middleware\VerifyJWTMiddleware;

Router::addGroup('/api', function () {
    // ------ Documentation ------
    Router::get('/documentation', Controller\Documentation\IndexController::class);

    // ------ User ------
    Router::post('/users', Controller\User\UserCreateController::class);
    Router::post('/users/auth', Controller\User\UserAuthController::class);

    // ------ Password ------
    Router::post('/password', Controller\Password\PasswordSetController::class);

    // ------ Bio ------
    Router::get('/bio', Controller\Bio\IndexController::class);
    Router::post('/interaction', Controller\Interaction\InteractionCreateController::class);

    Router::addGroup('', function () {
        Router::get('/overview', Controller\Overview\OverviewController::class);        
        
        // ------ Link ------
        Router::get('/links', Controller\Link\LinkListController::class);
        Router::post('/links', Controller\Link\LinkCreateController::class);
        Router::put('/links/{link}', Controller\Link\LinkUpdateController::class);
        Router::put('/links/{link}/toggle', Controller\Link\LinkToggleController::class);
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
        'middleware' => [VerifyJWTMiddleware::class]
    ]);
});