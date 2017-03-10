# Language switcher plugin
A PyroCMS 3 plugin providing users with numerous ways of switching language. The default types use bootstrap 3.

## Installation
__Make sure to replace \<namespace\> with your own namespace. This is the name of the folder under `/addons`__
1. In your terminal navigate to your project root
2. `mkdir addons/<namespace>/wirelab`
2. `cd addons/<namespace>/wirelab`
3. `git clone https://github.com/wirelab/language_switcher-plugin.git`

## Usage
Call `{{ languageSwitcher($type, $options) }}` in the desired twig file. For example `{{ languageSwitcher('dropdown') }}`

### String $type
The default types are 'dropdown','modal','li'.
When using the `modal` type make sure to call it _after_ loading jQuery.

#### Making a new type
New types can be made by adding a view under `<plugin path>/resources/views/`. When making a new view it'll automatically add it as a type.

The following variables are passed to all views:
`container.class`
`toggle.class`
`ul.class`
`li.class`
`a.class`

`toggle.title`

`locales` array of all available locales formated like: `[[url => locale],[url => locale]]`

The current variables contain data about the locale that's currently in use
`current.locale`
`current.country`
`current.language`

The prefered variables contain data about the user.
`prefered.locale`
`prefered.enabled` Checks if the users language is available/enabled.
`prefered.url` Url to the current page in the users locale.
`prefered.country`
`prefered.language`

### Array $options (optional)
The `$options` array accepts the following options:
`container_class`
`toggle_class`
`toggle_title` When no title is given the current locale will be used
`ul_class`
`li_class`
`a_class`