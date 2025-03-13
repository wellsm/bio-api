<?php

declare(strict_types=1);

namespace Application\Service\Bio;

use App\Model\Profile;
use Application\Service\Importer\Common\LinkCollection;
use Application\Service\Importer\Provider\LinktreeImporter;
use Application\Service\Importer\Provider\SelfImporter;
use Hyperf\Guzzle\ClientFactory;
use Symfony\Component\DomCrawler\Crawler;

class BioImport
{
    public function __construct(
        private ClientFactory $client,
        private LinktreeImporter $linktree,
        private SelfImporter $self,
    ) {}

    public function run(string $url, ?string $provider = null): array
    {
        $response = $this->client->create()->get($url);
        $html     = $response->getBody()->getContents();

        file_put_contents(__DIR__ . '/' . uniqid() . '.html', $html);

        dd('FIM');

        $crawler = new Crawler($html);
        $links   = $provider ?? $this->provider($url);

        dd($links);
    }

    private function provider(string $url): string
    {
        $uri = parse_url($url);

        return match ($uri['host']) {
            'linktr.ee' => LinktreeImporter::class,
        };
    }

    private function links(Crawler $crawler, string $provider): LinkCollection
    {
        return match ($provider) {
            LinktreeImporter::class => $this->linktree->links($crawler, new Profile()),
            SelfImporter::class     => $this->self->links($crawler, new Profile()),
        };
    }
}