<?php

namespace Application\Service\Mail;

use Application\Constants\Env;
use Application\Service\Mail\DTO\MailDTO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

use function Hyperf\Support\env;

class EmailSend
{
    public function send(MailDTO $dto): void
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();

        $mail->SMTPDebug  = Env::ifLocal(SMTP::DEBUG_SERVER, SMTP::DEBUG_OFF);
        $mail->Host       = env('SMTP_HOST');
        $mail->SMTPAuth   = (bool) env('SMTP_AUTH', false);
        $mail->Username   = env('SMTP_USERNAME');
        $mail->Password   = env('SMTP_PASSWORD');
        $mail->SMTPSecure = env('SMTP_ENCRYPTION');
        $mail->Port       = env('SMTP_PORT');

        $mail->setFrom($mail->Username, env('APP_NAME'));
        $mail->addAddress($dto->email, $dto->name);

        $mail->isHTML(true);
        $mail->Body = $dto->html;

        $mail->send();
    }
}