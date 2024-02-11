<?php

declare(strict_types=1);

namespace Application\Http\Controller\Category;

use Application\Http\Controller\Common\AbstractController;
use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Request;

class CategoryCreateController extends AbstractController
{
    public function __invoke(Request $request, ResponseInterface $response)
    {
        Db::table('categories')->insert([
            'name' => $request->post('name'),
        ]);

        return $response->redirect('/categories');
    }
}
