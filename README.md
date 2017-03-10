# Language switcher plugin
A PyroCMS 3 plugin providing users with numerous ways of switching language. The default types use bootstrap 3.

## Installation
`composer require wirelab/language_switcher-plugin`

### Manual installation
__Make sure to replace \<namespace\> with your own namespace. This is the name of the folder under `/addons`__ <br>
1. In your terminal navigate to your project root<br>
2. `mkdir addons/<namespace>/wirelab`<br>
2. `cd addons/<namespace>/wirelab`<br>
3. `git clone https://github.com/wirelab/language_switcher-plugin.git`<br>

## Usage
Call `{{ languageSwitcher($type, $options) }}` in the desired twig file. <br>
For example `{{ languageSwitcher('dropdown', {'toggle_title':'Choose language'}) }}`

### String $type
The default types are `dropdown`,`modal`, and `li`.
When using the `modal` type make sure to call it _after_ loading jQuery.

#### Making a new type
New types can be made by adding a view under `<plugin path>/resources/views/`. When making a new view it'll automatically add it as a type.

The following variables are passed to all views:<br>
`container.class`<br>
`toggle.class`<br>
`ul.class`<br>
`li.class`<br>
`a.class`<br>

`toggle.title`<br>

`locales` _array of all available locales formated like: `[[url => locale],[url => locale]]`_<br>

The current variables contain data about the locale that's currently in use<br>
`current.locale`<br>
`current.country`<br>
`current.language`<br>

The prefered variables contain data about the user.<br>
`prefered.locale`<br>
`prefered.enabled` _Checks if the users language is available/enabled._<br>
`prefered.url` _Url to the current page in the users locale._<br>
`prefered.country`<br>
`prefered.language`<br>

### Array $options (optional)
The `$options` array accepts the following options:<br>
`container_class`<br>
`toggle_class`<br>
`toggle_title` _When no title is given the current locale will be used_<br>
`ul_class`<br>
`li_class`<br>
`a_class`<br>