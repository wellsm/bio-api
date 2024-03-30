<?php

declare (strict_types=1);

namespace Application\Service\Importer\Provider;

use Application\Service\Importer\Common\Importer;
use Application\Service\Importer\Common\LinkCollection;
use Application\Service\Importer\Common\SocialMediaCollection;
use Core\DTO\Link\LinkCreateDTO;
use Core\Entities\ProfileEntity;
use Symfony\Component\DomCrawler\Crawler;

class LinktreeImporter extends Importer
{
    public function links(Crawler $crawler, ProfileEntity $profile): LinkCollection
    {
        $links = new LinkCollection();

        $crawler->filter('#links-container > *')
            ->each(static function (Crawler $node) use ($profile, $links): void  {
                $thumb = $node->filter('img');

                $links->addLink(new LinkCreateDTO([
                    'profile'   => $profile,
                    'url'       => $node->filter('a')->attr('href'),
                    'title'     => $node->filter('p')->text(),
                    'thumbnail' => $thumb->count() === 0 ? null : $thumb->attr('src'),
                ]));
            });

        return $links;
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