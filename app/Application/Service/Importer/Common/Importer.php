<?php

declare (strict_types=1);

namespace Application\Service\Importer\Common;

use Core\DTO\Link\LinkCreateDTO;
use Core\Entities\ProfileEntity;
use Symfony\Component\DomCrawler\Crawler;

abstract class Importer
{
    public function links(Crawler $crawler, ProfileEntity $profile): LinkCollection
    {
        return new LinkCollection();
    }

    public function medias(Crawler $crawler, ProfileEntity $profile): SocialMediaCollection
    {
        return new SocialMediaCollection();
    }

    public function profile(Crawler $crawler): array
    {
        return [];
    }
}