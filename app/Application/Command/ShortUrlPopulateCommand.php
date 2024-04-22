<?php

namespace Application\Command;

use Application\Service\Link\LinkBioList;
use Application\Service\Profile\ProfileShow;
use Application\Service\ShortUrl\ShortUrlCreate;
use Core\Entities\LinkEntity;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Hyperf\Collection\Collection;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Contract\ConfigInterface;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Guzzle\ClientFactory;

#[Command(name: 'short-url:populate', description: 'Populate Links with ShortURL if Enabled')]
class ShortUrlPopulateCommand extends HyperfCommand
{
    private const string SUCCESS_MESSAGE = '%s - Links: %d - Populated - Elapsed Time: %s';

    #[Inject()]
    protected ProfileShow $profile;

    #[Inject()]
    protected LinkBioList $list;

    #[Inject()]
    protected ClientFactory $client;

    #[Inject()]
    private ConfigInterface $config;

    private Client $http;

    public function handle()
    {
        $enabled = $this->config->get('short_url.enabled');

        if (!$enabled) {
            return;
        }

        $start   = microtime(true);
        $profile = $this->profile->run();
        $links   = $this->list->run($profile);
        $links   = $links->filter(fn (LinkEntity $link) => empty($link->getShortUrl()))
            ->keyBy('id');

        $requests  = $this->requests($links);
        $responses = Utils::unwrap($requests);
        $upsert    = [];
        $links     = $links->toArray();

        /** @var Response */
        foreach ($responses as $id => $response) {
            $upsert[] = array_merge($links[$id], [
                'short_url' => json_decode($response->getBody()->getContents(), true)['shortUrl'] ?? null,
            ]);
        }

        Db::table('links')->upsert($upsert, ['id']);

        $elapsed = round(microtime(true) - $start, 3);

        if (count($upsert) > 0) {
            $this->info(sprintf(self::SUCCESS_MESSAGE, date('Y-m-d H:i:s'), count($upsert), $elapsed));
        }
    }

    private function requests(Collection $links): array
    {
        $requests = [];

        /** @var LinkEntity */
        foreach ($links as $link) {
            $requests[$link->getId()] = $this->api()->postAsync(ShortUrlCreate::CREATE_URL, [
                RequestOptions::JSON => [
                    'title'        => $link->getTitle(),
                    'findIfExists' => true,
                    'longUrl'      => $link->getUrl()
                ],
            ]);
        }

        return $requests;
    }

    private function api(): Client
    {
        return $this->http ??= $this->client->create([
            'base_uri' => $this->config->get('short_url.base_uri'),
            'headers'  => [
                'X-Api-Key' => $this->config->get('short_url.api_key')
            ]
        ]);
    }
}