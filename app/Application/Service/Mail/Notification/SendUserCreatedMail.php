<?php

namespace Application\Service\Mail\Notification;

use Application\Service\Mail\DTO\MailDTO;
use Application\Service\Mail\DTO\UserSetPasswordMailDTO;
use Application\Service\Mail\EmailSend;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\View\RenderInterface;

use function Hyperf\Translation\__;

class SendUserCreatedMail
{
    public function __construct(
        private RenderInterface $render,
        private StdoutLoggerInterface $logger,
        private EmailSend $mailer,
    ) {}

    public function render(UserSetPasswordMailDTO $dto): string
    {
        $html = $this->render->getContents('mail.password-set', [
            'title' => __('messages.welcome'),
            'token' => $dto->token,
        ]);
 
        return str_replace(PHP_EOL, '', $html);
    }

    public function send(UserSetPasswordMailDTO $dto): void
    {
        $this->mailer->send(new MailDTO([
            'name'  => $dto->name,
            'email' => $dto->email,
            'html'  => $this->render($dto)
        ]));
    }
}