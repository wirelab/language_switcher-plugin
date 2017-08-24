<?php namespace Wirelab\LanguageSwitcherPlugin;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class LanguageSwitcherPluginServiceProvider
 * @package Wirelab\LanguageSwitcherPlugin
 */
class LanguageSwitcherPluginServiceProvider extends AddonServiceProvider
{

    /**
     * @var array
     */
    protected $plugins = [
        'Wirelab\LanguageSwitcherPlugin\LanguageSwitcherPlugin'
    ];
}
