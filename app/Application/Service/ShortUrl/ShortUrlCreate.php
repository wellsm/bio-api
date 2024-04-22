<?php

declare(strict_types=1);

namespace Application\Service\ShortUrl;

use Application\Exception\BusinessException;
use Core\DTO\ShortUrl\ShortUrlCreateDTO;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Guzzle\ClientFactory;

class ShortUrlCreate
{
    public const string CREATE_URL = '/rest/v3/short-urls';

    private Client $http;

    public function __construct(
        private ConfigInterface $config,
        private ClientFactory $client
    ) {
    }

    public function run(ShortUrlCreateDTO $dto): ?string
    {
        $enabled = $this->config->get('short_url.enabled');

        if (!$enabled) {
            return null;
        }

        $response = $this->api()->post(self::CREATE_URL, [
            RequestOptions::JSON => [
                'findIfExists' => true,
                'longUrl'      => $dto->url,
                'title'        => $dto->title,
            ],
        ]);

        if ($response->getStatusCode() != 200) {
            throw new BusinessException();
        }

        $data = json_decode($response->getBody()->getContents(), true);

        return $data['shortUrl'] ?? null;
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
