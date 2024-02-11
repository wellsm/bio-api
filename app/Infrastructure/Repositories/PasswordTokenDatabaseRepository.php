<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use App\Model\PasswordToken;
use Carbon\Carbon;
use Core\Entities\UserEntity;
use Core\Entities\PasswordTokenEntity;
use Core\Helper\Util;
use Core\Repositories\PasswordTokenRepository;

class PasswordTokenDatabaseRepository implements PasswordTokenRepository
{
    public function generateToken(UserEntity $user): PasswordTokenEntity
    {
        return PasswordToken::create([
            'user_id'    => $user->getId(),
            'token'      => Util::otp(),
            'expires_at' => Carbon::now()->addHour()->toDateTimeString()
        ]);
    }

    public function verifyToken(string $token): ?PasswordTokenEntity
    {
        return PasswordToken::where('token', $token)
            ->where('expires_at', '>', date('Y-m-d H:i:s'))
            ->firstOrFail();
    }

    public function verifyUser(UserEntity $user): ?PasswordTokenEntity
    {
        return PasswordToken::where('user_id', $user->getId())
            ->where('expires_at', '>', date('Y-m-d H:i:s'))
            ->first();
    }
}
