<?php

declare(strict_types=1);

namespace Core\Helper;

class SocialMedia
{
    private static $ICONS = [];

    private const DRIBBLE        = 'dribbble';
    private const BEHANCE        = 'behance';
    private const PINTEREST      = 'pinterest';
    private const REDDIT         = 'reddit';
    private const THREADS        = 'threads';
    private const GOOGLE_PLAY    = 'google play';
    private const APP_STORE      = 'app store';
    private const AMAZON         = 'amazon';
    private const SKETCH         = 'sketch';
    private const SPOTIFY        = 'spotify';
    private const SOUNDCLOUD     = 'soundcloud';
    private const INVISION       = 'invision';
    private const EMAIL          = 'email';
    private const FACEBOOK       = 'facebook';
    private const MESSENGER      = 'facebook messenger';
    private const YOUTUBE        = 'youtube';
    private const TWITCH         = 'twitch';
    private const TIKTOK         = 'tiktok';
    private const TWITTER        = 'twitter';
    private const GOOGLE_PLUS    = 'google plus g';
    private const LINKEDIN       = 'linkedin';
    private const INSTAGRAM      = 'instagram';
    private const DISCORD        = 'discord';
    private const TELEGRAM       = 'telegram';
    private const WHATSAPP       = 'whatsapp';
    private const SIGNAL         = 'signal messenger';
    private const PATREON        = 'patreon';
    private const SNAPCHAT       = 'snapchat';
    private const SLACK          = 'slack';
    private const STACK_OVERFLOW = 'stack-overflow';
    private const GITHUB         = 'github';
    private const GITLAB         = 'gitlab';
    private const BITBUCKET      = 'bitbucket';
    private const SHOPIFY        = 'shopify';
    private const EXTERNAL       = 'external';

    public const ICONS = [
        [ 'family' => "fab", 'icon' => "dribbble", 'media' => self::DRIBBLE ],
        [ 'family' => "fab", 'icon' => "square-dribbble", 'media' => self::DRIBBLE ],
        [ 'family' => "fab", 'icon' => "behance", 'media' => self::BEHANCE ],
        [ 'family' => "fab", 'icon' => "square-behance", 'media' => self::BEHANCE ],
        [ 'family' => "fab", 'icon' => "pinterest", 'media' => self::PINTEREST ],
        [ 'family' => "fab", 'icon' => "square-pinterest", 'media' => self::PINTEREST ],
        [ 'family' => "fab", 'icon' => "pinterest-p", 'media' => self::PINTEREST ],
        [ 'family' => "fab", 'icon' => "reddit", 'media' => self::REDDIT ],
        [ 'family' => "fab", 'icon' => "square-reddit", 'media' => self::REDDIT ],
        [ 'family' => "fab", 'icon' => "threads", 'media' => self::THREADS ],
        [ 'family' => "fab", 'icon' => "square-threads", 'media' => self::THREADS ],
        [ 'family' => "fab", 'icon' => "google-play", 'media' => self::GOOGLE_PLAY ],
        [ 'family' => "fab", 'icon' => "app-store", 'media' => self::APP_STORE ],
        [ 'family' => "fab", 'icon' => "app-store-ios", 'media' => self::APP_STORE ],
        [ 'family' => "fab", 'icon' => "amazon", 'media' => self::AMAZON ],
        [ 'family' => "fab", 'icon' => "sketch", 'media' => self::SKETCH ],
        [ 'family' => "fab", 'icon' => "spotify", 'media' => self::SPOTIFY ],
        [ 'family' => "fab", 'icon' => "soundcloud", 'media' => self::SOUNDCLOUD ],
        [ 'family' => "fab", 'icon' => "invision", 'media' => self::INVISION ],
        [ 'family' => "fas", 'icon' => "envelope", 'media' => self::EMAIL ],
        [ 'family' => "far", 'icon' => "envelope", 'media' => self::EMAIL ],
        [ 'family' => "fab", 'icon' => "facebook", 'media' => self::FACEBOOK ],
        [ 'family' => "fab", 'icon' => "facebook-f", 'media' => self::FACEBOOK ],
        [ 'family' => "fab", 'icon' => "square-facebook", 'media' => self::FACEBOOK ],
        [ 'family' => "fab", 'icon' => "facebook-messenger", 'media' => self::MESSENGER ],
        [ 'family' => "fab", 'icon' => "youtube", 'media' => self::YOUTUBE ],
        [ 'family' => "fab", 'icon' => "twitch", 'media' => self::TWITCH ],
        [ 'family' => "fab", 'icon' => "tiktok", 'media' => self::TIKTOK ],
        [ 'family' => "fab", 'icon' => "x-twitter", 'media' => self::TWITTER ],
        [ 'family' => "fab", 'icon' => "twitter", 'media' => self::TWITTER ],
        [ 'family' => "fab", 'icon' => "google-plus-g", 'media' => self::GOOGLE_PLUS ],
        [ 'family' => "fab", 'icon' => "linkedin", 'media' => self::LINKEDIN ],
        [ 'family' => "fab", 'icon' => "linkedin-in", 'media' => self::LINKEDIN ],
        [ 'family' => "fab", 'icon' => "instagram", 'media' => self::INSTAGRAM ],
        [ 'family' => "fab", 'icon' => "square-instagram", 'media' => self::INSTAGRAM ],
        [ 'family' => "fab", 'icon' => "discord", 'media' => self::DISCORD ],
        [ 'family' => "fab", 'icon' => "telegram", 'media' => self::TELEGRAM ],
        [ 'family' => "fab", 'icon' => "whatsapp", 'media' => self::WHATSAPP ],
        [ 'family' => "fab", 'icon' => "square-whatsapp", 'media' => self::WHATSAPP ],
        [ 'family' => "fab", 'icon' => "signal-messenger", 'media' => self::SIGNAL ],
        [ 'family' => "fab", 'icon' => "patreon", 'media' => self::PATREON ],
        [ 'family' => "fab", 'icon' => "snapchat", 'media' => self::SNAPCHAT ],
        [ 'family' => "fab", 'icon' => "square-snapchat", 'media' => self::SNAPCHAT ],
        [ 'family' => "fab", 'icon' => "slack", 'media' => self::SLACK ],
        [ 'family' => "fab", 'icon' => "stack-overflow", 'media' => self::STACK_OVERFLOW ],
        [ 'family' => "fab", 'icon' => "github", 'media' => self::GITHUB ],
        [ 'family' => "fab", 'icon' => "github-alt", 'media' => self::GITHUB ],
        [ 'family' => "fab", 'icon' => "square-github", 'media' => self::GITHUB ],
        [ 'family' => "fab", 'icon' => "gitlab", 'media' => self::GITLAB ],
        [ 'family' => "fab", 'icon' => "square-gitlab", 'media' => self::GITLAB ],
        [ 'family' => "fab", 'icon' => "bitbucket", 'media' => self::BITBUCKET ],
        [ 'family' => "fab", 'icon' => "shopify", 'media' => self::SHOPIFY ],
        [ 'family' => "fab", 'icon' => "shop", 'media' => self::EXTERNAL ],
        [ 'family' => "fas", 'icon' => "bag-shopping", 'media' => self::EXTERNAL ],
        [ 'family' => "fas", 'icon' => "cart-shopping", 'media' => self::EXTERNAL ],
    ];

    public static function getName(string $icon): ?string
    {
        $icons = static::$ICONS ?: static::getIcons();

        return $icons[$icon] ?? null;
    }

    private static function getIcons(): array
    {
        $icons = [];

        foreach (self::ICONS as $item) {
            $icons["{$item['family']} {$item['icon']}"] = $item['media'];
        }

        return static::$ICONS = $icons;
    }
}
