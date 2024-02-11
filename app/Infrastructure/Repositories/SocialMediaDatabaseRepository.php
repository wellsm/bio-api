<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use App\Model\SocialMedia;
use Application\Exception\BusinessException;
use Core\DTO\SocialMedia\SocialMediaCreateDTO;
use Core\DTO\SocialMedia\SocialMediaUpdateDTO;
use Core\Entities\ProfileEntity;
use Core\Repositories\SocialMediaRepository;
use Hyperf\Database\Model\Builder;
use Hyperf\DbConnection\Db;
use Hyperf\Validation\UnauthorizedException;
use Teapot\StatusCode\Http;

use function Hyperf\Collection\data_fill;

class SocialMediaDatabaseRepository implements SocialMediaRepository
{
    public function listSocialMedias(ProfileEntity $profile, ?bool $active)
    {
        return SocialMedia::where('profile_id', $profile->getId())
            ->when($active !== null, fn (Builder $query) => $query->where('active', $active))
            ->orderBy('order')
            ->get();
    }

    public function createSocialMedia(ProfileEntity $profile, SocialMediaCreateDTO $dto): void
    {
        $order = Db::table('social_medias')->select('order')->orderByDesc('order')->first();

        SocialMedia::create([
            'profile_id' => $profile->getId(),
            'icon'       => $dto->icon,
            'name'       => $dto->getName(),
            'url'        => $dto->url,
            'order'      => ($order['order'] ?? 0) + 1,
            'active'     => true
        ]);
    }

    public function updateSocialMedia(ProfileEntity $profile, SocialMediaUpdateDTO $dto): void
    {
        SocialMedia::query()
            ->where('id', $dto->id)
            ->update([
                'profile_id' => $profile->getId(),
                'icon'       => $dto->icon,
                'name'       => $dto->getName(),
                'url'        => $dto->url,
                'active'     => (bool) $dto->active
            ]);
    }

    public function orderSocialMedias(ProfileEntity $profile, array $medias): void
    {
        $result = Db::table('social_medias')
            ->where('profile_id', $profile->getId())
            ->whereIn('id', array_column($medias, 'id'))
            ->get()
            ->toArray();

        $medias = array_column($medias, 'order', 'id');

        if (count($result) != count($medias)) {
            throw new BusinessException(Http::UNAUTHORIZED);
        }

        foreach ($result as $key => $value) {
            $result[$key]['order'] = $medias[$value['id']];
        }

        Db::table('social_medias')->upsert($result, ['id'], ['order']);
    }
}
