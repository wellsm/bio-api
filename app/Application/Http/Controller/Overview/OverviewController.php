<?php

declare(strict_types=1);

namespace Application\Http\Controller\Overview;

use App\Model\Link;
use App\Model\Profile;
use App\Model\SocialMedia;
use Application\Http\Controller\Common\AbstractController;
use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Request;
use Hyperf\View\RenderInterface;

class OverviewController extends AbstractController
{
    public function __invoke(Request $request, RenderInterface $render)
    {
        $views  = Db::table('interactions')->where('interactable_type', Profile::class)->count();
        $clicks = Db::table('interactions')->where('interactable_type', Link::class)->count();
        $medias = Db::table('interactions')->where('interactable_type', SocialMedia::class)->count();
        $ctr    = (int) round($clicks / $views * 100);

        $overview = Db::table('interactions')
            ->selectRaw('COUNT(*) AS total')
            ->selectRaw('MONTH(created_at) AS month')
            ->selectRaw('YEAR(created_at) AS year')
            ->where('interactable_type', Link::class)
            ->groupBy(Db::raw('YEAR(created_at)'))
            ->groupBy(Db::raw('MONTH(created_at)'))
            ->get()
            ->sortBy(function ($interaction) {
                return (int) ($interaction['year'] . str_pad((string) $interaction['month'], 2, '0', STR_PAD_LEFT));
            }, SORT_STRING)
            ->values();

        $query = function ($column, $table, $class, $columns = []) {
            return Db::table('interactions AS i')
                ->select(array_merge(["x.{$column} AS column", "x.id"], $columns))
                ->selectRaw('COUNT(*) AS total')
                ->join("{$table} AS x", 'x.id', '=', 'i.interactable_id')
                ->where('i.interactable_type', $class)
                ->groupBy('interactable_id')
                ->orderByDesc('total')
                ->orderBy($column)
                ->limit(5)
                ->get();
        };

        $traffic = [
            'medias' => $query('name', 'social_medias', SocialMedia::class, ['x.icon']),
            'clicks' => $query('title', 'links', Link::class, ['x.thumbnail']),
        ];

        $traffic['medias'] = $traffic['medias']->map(function ($item) {
            [$family, $icon] = explode(' ', $item['icon']);

            return array_merge($item, [
                'icon' => compact('family', 'icon')
            ]);
        });

        return compact('views', 'clicks', 'medias', 'ctr', 'overview', 'traffic');
    }
}
