<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use App\Model\Collection;
use Application\Exception\BusinessException;
use Core\DTO\Collection\CollectionCreateDTO;
use Core\DTO\Collection\CollectionListDTO;
use Core\DTO\Collection\CollectionUpdateDTO;
use Core\Entities\CollectionEntity;
use Core\Entities\ProfileEntity;
use Core\Repositories\CollectionRepository;
use Hyperf\Database\Model\Builder;
use Teapot\StatusCode\Http;

class CollectionDatabaseRepository implements CollectionRepository
{
    public function getCollectionList(ProfileEntity $profile, CollectionListDTO $dto)
    {
        return Collection::query()
            ->with('links')
            ->where('profile_id', $profile->getId())
            ->when($dto->name, fn (Builder $query) => $query->where('name', 'LIKE', '%' . $dto->name . '%'))
            ->orderBy('id', 'DESC')
            ->paginate(perPage: $dto->perPage, page: $dto->getPage());
    }

    public function showCollection(string $hash): CollectionEntity
    {
        return Collection::query()
            ->with('links')
            ->where('hash', $hash)
            ->first();
    }

    public function createCollection(ProfileEntity $profile, CollectionCreateDTO $dto): void
    {
        $collection = new Collection();
        $collection->setProfile($profile);
        $collection->addHash();
        $collection->setName($dto->name);
        $collection->setDescription($dto->description);

        $collection->save();

        $collection->links()->sync($dto->links);
    }

    public function updateCollection(ProfileEntity $profile, CollectionUpdateDTO $dto): void
    {
        $collection = Collection::query()->with('profile')->find($dto->id);

        if ($collection->getProfile()->getId() !== $profile->getId()) {
            throw new BusinessException(Http::FORBIDDEN);
        }

        $collection->setName($dto->name);
        $collection->setDescription($dto->description);

        $collection->save();

        $collection->links()->sync($dto->links);
    }

    public function deleteCollection(int $id): void
    {
        Collection::query()
            ->where('id', $id)
            ->delete();
    }
}
