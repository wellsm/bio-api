<?php

declare(strict_types=1);

namespace Application\Service\Mail\DTO;

use Core\Common\DTO;

final class UserSetPasswordMailDTO extends DTO
{
    public string $name  = 'NAME';
    public string $email = 'EMAIL@MAIL.COM';
    public string $token = 'TOKEN-HERE-TOKEN-HERE';
}