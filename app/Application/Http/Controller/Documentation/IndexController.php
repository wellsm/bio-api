<?php

declare(strict_types=1);

namespace Application\Http\Controller\Documentation;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\View\RenderInterface;
use Symfony\Component\Yaml\Yaml;

class IndexController
{
    public function __invoke(RequestInterface $request, RenderInterface $render, ResponseInterface $response)
    {
        $query = $request->getQueryParams();

        if (array_key_exists('doc', $query)) {
            return $response->json(
                Yaml::parseFile(BASE_PATH . '/public/documentation/api.yml')
            );
        }

        return $render->render('documentation.index');
    }
}
