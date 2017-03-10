<?php namespace Wirelab\LanguageSwitcherPlugin\LanguageSwitcher\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Exception;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RenderLanguageSwitcher
{
    use DispatchesJobs;

    private $div_class;
    private $button_class;
    private $button_title;
    private $ul_class;
    private $li_class;
    private $a_class;
    private $type;

    public function __construct(String $type, Array $options)
    {
        $default_button_class = $type == 'li' ? 'dropdown' : 'btn btn-primary dropdown-toggle';

        $this->div_class    = isset($options['div_class'])    ? $options['div_class']    : 'dropdown';
        $this->button_class = isset($options['button_class']) ? $options['button_class'] : $default_button_class;
        $this->button_title = isset($options['button_title']) ? $options['button_title'] : false;
        $this->ul_class     = isset($options['ul_class'])     ? $options['ul_class']     : 'dropdown-menu';
        $this->li_class     = isset($options['li_class'])     ? $options['li_class']     : '';
        $this->a_class      = isset($options['a_class'])      ? $options['a_class']      : '';
        $this->type         = $type;
    }

    public function handle(
        SettingRepositoryInterface $settings,
        Request $request,
        Repository $config
    )
   {
        $type             = $this->type;
        $types            = [];
        $locales          = $settings->value('streams::enabled_locales'); // Get an array of all currently enables locales.
        $current_path     = $request->path(); // Get the current request path. For example /pages/some-page-title
        $current_locale   = $config->get('app.locale'); // Get the current request locale.
        $prefered_locale  = $request->server('HTTP_ACCEPT_LANGUAGE'); // Extract http_accept_lang from the request
        $prefered_locale  = strtolower(substr($prefered_locale, 0, strpos($prefered_locale, ','))); // Get the first prefered lang out of the string
        $prefered_enabled = in_array($prefered_locale, $locales); // Check if the prefered locale is enabled in pyro
        $prefered_url     = url()->locale($current_path,$prefered_locale);
        $button_title     = $this->button_title ? $this->button_title : $current_locale . " <span class='caret'></span>"; // If the user has passed a button title set it, else default to the currently enabled locale.
        $custom_title     = $this->button_title != false; // Check if the user has set a custom title. Used in building the ul of locales
        $views_dir        = File::directories('../addons')[0] . '/wirelab/language_switcher-plugin/resources/views'; // Get the dir within the addon dir

        foreach (File::allFiles($views_dir) as $file){
            // Use the names of the views as types
            $types[] = $file->getBaseName('.' . $file->getExtension());
        }

        if (!in_array($type, $types)) {
            throw new Exception("Unkown LanguageSwitcher type");
        }

        if(($key = array_search($current_locale, $locales)) !== false && !$custom_title) {
            // If the user has not set a button title we're going to use the currently enabled locale as title
            // here we unset it to prevent the locale from showing up both as a list item and title
            unset($locales[$key]);
        }

        // Loop over all currently enabled languages and manipulate the array structure
        // Old structure: ['en','nl']
        // New structure:
        // [[
        //    'url'  => 'pyro.com/contact'
        //    'name' => 'en'
        //  ],
        //  [
        //    'url'  => 'pyro.com/nl/contact'
        //    'name' => 'nl'
        // ]]
        foreach ($locales as $key => $locale) {
            $locale_url = url()->locale($current_path,$locale); // Generate a url to the current page with the new locale
            $locales[$key] = [
                'url'  => $locale_url,
                'name' => $locale
            ];
        }

        $data = [
            'div_class'    => $this->div_class,
            'button_class' => $this->button_class,
            'ul_class'     => $this->ul_class,
            'li_class'     => $this->li_class,
            'a_class'      => $this->a_class,
            'button_title' => $button_title,
            'custom_title' => $custom_title,
            'locales'      => $locales,
            'current'      => [
                    'locale'   => $current_locale,
                    'country'  => locale_get_display_region("-$current_locale"),
                    'language' => locale_get_display_language("$current_locale")
            ],
            'prefered'     => [
                    'locale'   => $prefered_locale,
                    'enabled'  => $prefered_enabled,
                    'url'      => $prefered_url,
                    'country'  => locale_get_display_region("-$prefered_locale"),
                    'language' => locale_get_display_language("$prefered_locale")
            ]
        ];

        return view("wirelab.plugin.language_switcher::$this->type", $data);
    }
}

?>