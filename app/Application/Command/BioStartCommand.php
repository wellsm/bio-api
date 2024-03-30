<?php

namespace Application\Command;

use Application\Service\Bio\BioStart;
use Core\DTO\Bio\BioStartDTO;
use Core\Enums\BioStartStep;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Contract\ValidatorInterface;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use Symfony\Component\Console\Input\InputOption;

#[Command(name: 'bio:start', description: 'Start Creating User/Password and Profile', options: [
    ['email', null, InputOption::VALUE_REQUIRED, "User's email", null],
    ['password', null, InputOption::VALUE_REQUIRED, "User's password", null],
    ['name', null, InputOption::VALUE_REQUIRED, "Profile's name", null],
    ['username', null, InputOption::VALUE_REQUIRED, "Profile's username (must be unique)", null],
])]
class BioStartCommand extends HyperfCommand
{
    private const string SUCCESS_MESSAGE = '%s - User: %s - Profile: %s - Created Successfully';

    #[Inject()]
    protected ValidatorFactoryInterface $validation;

    #[Inject()]
    protected Db $db;

    #[Inject()]
    protected BioStart $start;

    public function handle()
    {
        $validator = $this->validation->make($this->options(), [
            'email'    => 'required|email|unique:users',
            'password' => 'required',
            'name'     => 'required',
            'username' => 'required|unique:profiles',
        ]);

        match ($validator->fails()) {
            true  => $this->errors($validator),
            false => $this->start()
        };
    }

    private function start():  void
    {
        $this->db->transaction(function () {
            $data     = new BioStartDTO($this->options());
            $response = $this->start->run($data);

            $this->info(sprintf(self::SUCCESS_MESSAGE, date('Y-m-d H:i:s'), $response->getUser()->getEmail(), $response->getProfile()->getUsername()));
        });
    }

    private function errors(ValidatorInterface $validator): void
    {
        $this->error($validator->errors()->first());
    }
}