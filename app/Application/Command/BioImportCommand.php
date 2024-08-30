<?php

namespace Application\Command;

use App\Model\Profile;
use Application\Service\Importer\Common\Importer;
use Application\Service\Importer\Provider\LinktreeImporter;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Guzzle\ClientFactory;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\DomCrawler\Crawler;

use function Hyperf\Support\make;

#[Command(name: 'bio:import', description: 'Import Profile,Links From Bio Systems', options: [
    ['url', 'u', InputOption::VALUE_REQUIRED, 'Bio URL to Import', null],
    ['provider', 'p', InputOption::VALUE_REQUIRED, 'Provider (linktre)', null],
])]
class BioImportCommand extends HyperfCommand
{
    #[Inject()]
    private ClientFactory $client;

    public function handle()
    {
        $url      = $this->option('url');
        $response = $this->client->create()->get($url);

        $html    = $response->getBody()->getContents();

        dd($html);

        $crawler = new Crawler($html);

        $provider = $this->provider($url);
        $links    = $provider->links($crawler, new Profile());

        dd($links);
    }

    private function provider(string $url): Importer
    {
        $uri = parse_url($url);

        return match ($uri['host']) {
            'linktr.ee' => make(LinktreeImporter::class),
        };
    }
}