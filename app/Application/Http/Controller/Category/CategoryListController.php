<?php

declare(strict_types=1);

namespace Application\Http\Controller\Category;

use Application\Http\Controller\Common\AbstractController;
use Hyperf\DbConnection\Db;
use Hyperf\View\RenderInterface;

class CategoryListController extends AbstractController
{
    public function __invoke(RenderInterface $render)
    {
        $categories = Db::table('categories')->get();

        return $render->render('categories', compact('categories'));
    }
}
