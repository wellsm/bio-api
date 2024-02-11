<?php

declare(strict_types=1);

namespace Application\Service\Bio;

use Application\Service\Configuration\ConfigList;
use Application\Service\Link\LinkBioList;
use Application\Service\Profile\ProfileShow;
use Application\Service\SocialMedia\SocialMediaList;

class BioShow
{
    public function __construct(
        private ProfileShow $profile,
        private LinkBioList $links,
        private SocialMediaList $medias,
        private ConfigList $configs
    ) {}

    public function run(): array
    {
        $profile = $this->profile->run();
        $links   = $this->links->run($profile);
        $medias  = $this->medias->run(true);
        $configs = $this->configs->run();

        return compact('profile', 'links', 'medias', 'configs');
    }
}