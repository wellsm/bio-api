<?php

namespace Application\Command;

use Application\Service\Bio\BioImageDownload;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Di\Annotation\Inject;
use Symfony\Component\Console\Input\InputOption;

#[Command(name: 'bio:image:download', description: 'Download Images', options: [
    ['url', 'u', InputOption::VALUE_REQUIRED, 'Bio BASE URL to Download Images', null],
])]
class BioImageDownloadCommand extends HyperfCommand
{
    #[Inject()]
    private BioImageDownload $download;

    #[Inject()]
    public StdoutLoggerInterface $logger;

    public function handle()
    {
        $start = microtime(true);
        $count = $this->download->run($this->option('url'));

        if ($count === 0) {
            return;
        }
        
        $count = str_pad((string) $count, 4, '0', STR_PAD_LEFT);
        $time  = round(microtime(true) - $start, 3);

        $this->logger->info(date('Y-m-d H:i:s') . " - {$count} Images Downloaded - Elapsed Time: {$time}s");
    }
}