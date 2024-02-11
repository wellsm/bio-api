<?php

declare(strict_types=1);

namespace Application\Http\Controller\Category;

use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\StatusCode\ErrorResource;
use Application\Http\Resource\StatusCode\NoContentResource;
use Hyperf\Database\Exception\QueryException;
use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Request;

class CategoryDeleteController extends AbstractController
{
    public function __invoke(Request $request)
    {
        try {
            Db::table('categories')->delete($request->route('category'));
        } catch (QueryException) {
            return new ErrorResource('Category binded to Links');
        }

        return new NoContentResource(0);
    }
}
