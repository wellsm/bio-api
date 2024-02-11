<?php

declare(strict_types=1);

namespace Application\Http\Controller\Interaction;

use App\Model\Link;
use App\Model\Profile;
use App\Model\SocialMedia;
use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\StatusCode\CreatedResource;
use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Request;
use Ramsey\Uuid\Uuid;

class InteractionCreateController extends AbstractController
{
    public function __invoke(Request $request)
    {
        $class = match ($request->post('type')) {
            'link'  => Link::class,
            'media' => SocialMedia::class,
            'view'  => Profile::class,
        };

        Db::table('interactions')->insert([
            'id'                => Uuid::uuid4()->toString(),
            'interactable_id'   => $request->post('id'),
            'interactable_type' => $class,
        ]);

        return new CreatedResource(null);
    }
}
