<?php

declare(strict_types=1);

namespace Application\Http\Controller\Profile;

use Application\Http\Controller\Common\AbstractController;
use Hyperf\DbConnection\Db;

class ProfileShowController extends AbstractController
{
    public function __invoke()
    {
        $profile = Db::table('profiles')->first();

        return [
            'name'   => $profile['name'],
            'avatar' => $profile['avatar'],
        ];
    }
}
