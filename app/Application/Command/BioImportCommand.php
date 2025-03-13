<?php

namespace Application\Command;

use Application\Service\Bio\BioImport;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Di\Annotation\Inject;
use Symfony\Component\Console\Input\InputOption;

#[Command(name: 'bio:import', description: 'Import Profile,Links From Bio Systems', options: [
    ['url', 'u', InputOption::VALUE_REQUIRED, 'Bio URL to Import', null],
    ['provider', 'p', InputOption::VALUE_OPTIONAL, 'Provider (linktre)', null],
])]
class BioImportCommand extends HyperfCommand
{
    #[Inject()]
    private BioImport $import;

    public function handle()
    {
        $this->import->run($this->option('url'), $this->option('provider'));
    }
}