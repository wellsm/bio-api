<?php

declare(strict_types=1);

namespace Application\Http\Controller\Link;

use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\Link\LinkListResource;
use Application\Service\Link\LinkList;
use Core\DTO\Link\LinkListDTO;
use Hyperf\HttpServer\Contract\RequestInterface;

class LinkListController extends AbstractController
{
    public function __invoke(RequestInterface $request, LinkList $service)
    {
        $data = $request->getQueryParams();

        return (new LinkListResource(
            $service->run(new LinkListDTO($data))
        ))->toResponse();
    }
}
