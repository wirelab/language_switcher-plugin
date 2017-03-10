<?php namespace Wirelab\LanguageSwitcherPlugin;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class LanguageSwitcherPluginServiceProvider extends AddonServiceProvider
{

    protected $plugins = [
        'Wirelab\LanguageSwitcherPlugin\LanguageSwitcherPlugin'
    ];

}
