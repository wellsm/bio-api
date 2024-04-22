<?php

declare(strict_types=1);

namespace Application\Service\ShortUrl;

use Application\Exception\BusinessException;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\Stringable\Str;

class ShortUrlUpdate
{
    private const string UPDATE_URL = '/rest/v3/short-urls/%s';

    private Client $http;

    public function __construct(
        private ConfigInterface $config,
        private ClientFactory $client
    ) {
    }

    public function run(string $url, string $shortUrl): void
    {
        $enabled = $this->config->get('short_url.enabled');

        if (!$enabled) {
            return;
        }

        $shortCode = Str::afterLast($shortUrl, '/');
        $response  = $this->api()->patch(sprintf(self::UPDATE_URL, $shortCode), [
            RequestOptions::JSON => [
                'longUrl' => $url
            ],
        ]);

        if ($response->getStatusCode() != 200) {
            throw new BusinessException();
        }
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
