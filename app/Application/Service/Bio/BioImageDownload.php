<?php

declare(strict_types=1);

namespace Application\Service\Bio;

use GuzzleHttp\RequestOptions;
use Hyperf\DbConnection\Db;
use Hyperf\Guzzle\ClientFactory;

class BioImageDownload
{
    public function __construct(
        private ClientFactory $client
    ) {}

    public function run(string $url): int
    {
        $url   = rtrim($url, '/');
        $path  = BASE_PATH . '/public';
        $links = Db::table('links')
            ->select('thumbnail')
            ->get();

        $success = 0;

        foreach ($links as $link) {
            $filename = $path . $link['thumbnail'];

            if (file_exists($filename)) {
                continue;
            }

            $response = $this->client->create()
                ->get($url . $link['thumbnail'], [
                    RequestOptions::SINK => fopen($path . $link['thumbnail'], 'w')
                ]);

            if ($response->getStatusCode() === 200) {
                $success++;
            }
        }

        return $success;
    }
}
