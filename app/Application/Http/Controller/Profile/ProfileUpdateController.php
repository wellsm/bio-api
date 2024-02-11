<?php

declare(strict_types=1);

namespace Application\Http\Controller\Profile;

use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\StatusCode\NoContentResource;
use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Request;

class ProfileUpdateController extends AbstractController
{
    public function __invoke(Request $request)
    {
        $profile  = Db::table('profiles')->first();
        $filename = $profile['avatar'] ?? null;

        if (
            $request->hasFile('avatar')
            && $request->file('avatar')->getSize() > 0
        ) {
            $avatar = $request->file('avatar');
            $path = BASE_PATH . '/public';
            $filename = "/uploads/avatar.{$avatar->getExtension()}";

            $avatar->moveTo($path . $filename);
        }

        Db::table('profiles')->update([
            'avatar' => $filename,
            'name'   => $request->post('name'),
        ]);

        return new NoContentResource(null);
    }
}
