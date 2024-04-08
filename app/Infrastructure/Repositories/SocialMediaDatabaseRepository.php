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
use Teapot\StatusCode\Http;


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

        $media = new SocialMedia();
        $media->setProfile($profile);
        $media->setIcon($dto->icon);
        $media->setName($dto->getName());
        $media->setUrl($dto->url);
        $media->setOrder(($order['order'] ?? 0) + 1);
        $media->setActive(true);
        $media->setTextColor($dto->textColor);
        $media->setBackground($dto->background);

        $media->save();
    }

    public function updateSocialMedia(ProfileEntity $profile, SocialMediaUpdateDTO $dto): void
    {
        $media = SocialMedia::query()->find($dto->id);

        $media->setProfile($profile);
        $media->setIcon($dto->icon);
        $media->setName($dto->getName());
        $media->setUrl($dto->url);
        $media->setActive((bool) $dto->active);
        $media->setTextColor($dto->textColor);
        $media->setBackground($dto->background);

        $media->save();
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
