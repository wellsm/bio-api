<?php

declare(strict_types=1);

namespace Application\Http\Controller\Config;

use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\StatusCode\NoContentResource;
use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Request;
use Hyperf\View\RenderInterface;

class ConfigUpdateController extends AbstractController
{
    public function __invoke(Request $request, RenderInterface $render)
    {
        $data = $request->all();

        Db::table('configurations')
            ->where('key', $data['key'])
            ->update([
                'value' => $data['value']
            ]);

        return new NoContentResource(null);
    }
}
