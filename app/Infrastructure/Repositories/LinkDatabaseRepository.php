<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use App\Model\Link;
use Application\DTO\File\UploadDTO;
use Core\DTO\Link\LinkCreateDTO;
use Core\DTO\Link\LinkListDTO;
use Core\DTO\Link\LinkUpdateDTO;
use Core\Entities\LinkEntity;
use Core\Entities\ProfileEntity;
use Core\Repositories\LinkRepository;
use Hyperf\Database\Model\Builder;
use Hyperf\DbConnection\Db;

class LinkDatabaseRepository implements LinkRepository
{
    public function getLinkList(ProfileEntity $profile, LinkListDTO $dto)
    {
        return Link::query()
            ->where('profile_id', $profile->getId())
            ->when($dto->title, fn (Builder $query) => $query->where('title', 'LIKE', '%' . $dto->title . '%'))
            ->when($dto->url, fn (Builder $query) => $query->where('url', 'LIKE', '%' . $dto->url . '%'))
            ->when($dto->active !== null, fn (Builder $query) => $query->where('active', $dto->isActive()))
            ->when($dto->fixed !== null, fn (Builder $query) => $query->where('fixed', $dto->isFixed()))
            ->orderBy('id', 'DESC')
            ->paginate(perPage: $dto->perPage, page: $dto->getPage());
    }

    public function getLinkCollectionList(ProfileEntity $profile)
    {
        return Link::query()
            ->where('profile_id', $profile->getId())
            ->orderBy('fixed', 'DESC')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getLinksByProfile(ProfileEntity $profile)
    {
        return Link::query()
            ->where('profile_id', $profile->getId())
            ->where('active', 1)
            ->orderBy('fixed', 'DESC')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function createLink(ProfileEntity $profile, LinkCreateDTO $dto, ?UploadDTO $upload, ?string $shorUrl = null): void
    {
        Link::create([
            'title'      => $dto->title,
            'url'        => $dto->url,
            'thumbnail'  => $upload->filename,
            'profile_id' => $profile->getId(),
            'short_url'  => $shorUrl,
            'active'     => false
        ]);
    }

    public function getLinkById(int $id): LinkEntity
    {
        return Link::findOrFail($id);
    }

    public function updateLink(LinkUpdateDTO $dto): void
    {
        Link::query()
            ->where('id', $dto->id)
            ->update(array_filter([
                'title'      => $dto->title,
                'url'        => $dto->url,
                'thumbnail'  => $dto->thumbnail,
            ]));
    }

    public function toggleLink(int $id): void
    {
        Link::query()
            ->where('id', $id)
            ->update(['active' => Db::raw('NOT active')]);
    }

    public function toggleFixedLink(int $id): void
    {
        Link::query()
            ->where('id', $id)
            ->update(['fixed' => Db::raw('NOT fixed')]);
    }

    public function deleteLink(int $id): void
    {
        Link::query()
            ->where('id', $id)
            ->delete();
    }
}
