<?php

declare(strict_types=1);

namespace Application\Http\Controller\Overview;

use App\Model\Link;
use App\Model\Profile;
use App\Model\SocialMedia;
use Application\Http\Controller\Common\AbstractController;
use Carbon\Carbon;
use Hyperf\Database\Query\Builder;
use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Request;
use Hyperf\View\RenderInterface;

class OverviewController extends AbstractController
{
    public function __invoke(Request $request, RenderInterface $render)
    {
        $range = $request->query('range', null);
        $query = fn (string $type): int => Db::table('interactions')
            ->where('interactable_type', $type)
            ->when($range, fn (Builder $query) => $query->whereBetween('created_at', $this->range($range)))
            ->count();


        $views  = $query(Profile::class);
        $clicks = $query(Link::class);
        $medias = $query(SocialMedia::class);
        $ctr    = $clicks == 0 || $views == 0 ? 0 : (int) round($clicks / $views * 100);

        $overview = Db::table('interactions')
            ->selectRaw('COUNT(*) AS total')
            ->selectRaw('MONTH(created_at) AS month')
            ->selectRaw('YEAR(created_at) AS year')
            ->whereIn('interactable_type', [Link::class, SocialMedia::class])
            ->when($range, fn (Builder $query) => $query->whereBetween('created_at', $this->range($range)))
            ->groupBy(Db::raw('YEAR(created_at)'))
            ->groupBy(Db::raw('MONTH(created_at)'))
            ->get()
            ->sortBy(function ($interaction) {
                return (int) ($interaction['year'] . str_pad((string) $interaction['month'], 2, '0', STR_PAD_LEFT));
            }, SORT_STRING)
            ->values();

        $query = function ($column, $table, $class, $columns = []) use ($range) {
            return Db::table('interactions AS i')
                ->select(array_merge(["x.{$column} AS column", "x.id"], $columns))
                ->selectRaw('COUNT(*) AS total')
                ->join("{$table} AS x", 'x.id', '=', 'i.interactable_id')
                ->where('i.interactable_type', $class)
                ->when($range, fn (Builder $query) => $query->whereBetween('i.created_at', $this->range($range)))
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

    private function range(string $range): array
    {
        [$from, $to] = explode(' - ', $range);

        $from = Carbon::createFromFormat("Y-m-d", trim($from))->startOfDay();
        $to   = Carbon::createFromFormat("Y-m-d", trim($to))->endOfDay();

        return [
            $from->format("Y-m-d H:i:s"),
            $to->format("Y-m-d H:i:s"),
        ];
    }
}
