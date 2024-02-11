<?php

declare(strict_types=1);

namespace Application\Http\Controller\Link;

use Application\Http\Controller\Common\AbstractController;
use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Request;
use Hyperf\View\RenderInterface;

class LinkShowController extends AbstractController
{
    public function __invoke(Request $request, RenderInterface $render)
    {
        $categories = Db::table('categories')
            ->get()
        ;

        $links = Db::table('links AS l')
            ->select(['l.*', 'c.name AS category'])
            ->leftJoin('categories AS c', 'c.id', '=', 'l.category_id')
            ->orderByDesc('id')
            ->get()
        ;

        $link = Db::table('links')->find($request->route('link'));

        return $render->render('links', compact('categories', 'links', 'link'));
    }
}
