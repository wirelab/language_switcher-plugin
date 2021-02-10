# Language switcher plugin
## ⚠️ This repository has been deprecated ⚠️
A PyroCMS 3 plugin providing users with numerous ways of switching language. The default types use bootstrap 3.

## Installation
```bash
composer require wirelab/language_switcher-plugin
```

## Usage
Call `{{ languageSwitcher($type, $options) }}` in the desired twig file. <br>
For example `{{ languageSwitcher('dropdown', {'toggle_title':'Choose language'}) }}`

### String $type
The default types are `dropdown`,`modal`, and `li`.
When using the `modal` type make sure to call it _after_ loading jQuery.

#### Default types
#### Li
<p align="center"><img src='https://wirelab.github.io/images/language_switcher-plugin/li.png'></p>

#### Dropdown
<p align="center"><img src='https://wirelab.github.io/images/language_switcher-plugin/dropdown.png'></p>

#### Modal
The modal makes a cookie when dismissed.
<p align="center"><img src='https://wirelab.github.io/images/language_switcher-plugin/modal.png'></p>

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
`pecl` Opt out of usign PECL _( Will remove some features)_
