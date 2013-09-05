# SxBootstrap

This version has revisited the Form implementation, and is now easier to use than ever!

This module supplies view helpers to make it easy to work with twitter bootstrap.
Optionally, this module also allows you to build, cache, modify and extend twitter bootstrap using the [AssetManager module](http://github.com/RWOverdijk/AssetManager).

## Installation ViewHelpers
### How?
**Add the requirement to your composer.json file**

```bash
./composer.phar require spoonx/sxbootstrap
# When asked for a version, type: "2.*"
```

## Installation [Font Awesome](http://fontawesome.io/)
### How?
1. Add the dependency to your composer.json file:

    ```bash
    ./composer.phar require fortawesome/font-awesome
    # When asked for a version, type: "3.*"
    ```

2. Enable the use of [Font Awesome](http://fontawesome.io/) by adding the following in `config/autoload/sxbootstrap.local.php`:

    ```php
    <?php
    return array(
        'twitter_bootstrap' => array(
            'use_font_awesome' => true,
        ),
    );

    ```

## Installation renderer (recommended)

### How?
1. Add the dependencies to your composer.less file:

    ```bash
    ./composer.phar require rwoverdijk/assetmanager twbs/bootstrap
    # When asked for a version, type: "1.*" for assetmanager and "2.*" for bootstrap.
    ```

2. Enable `AssetManager` and `SxBootstrap` in your `application.config.php` config file.

3. Install less...

    a) Via NPM/Node.js **(recommended method)**:

       1. Install npm/node.js. [Instructions](https://github.com/joyent/node/wiki/Installing-Node.js-via-package-manager) can be found here.
       2. To Install lessc, open up your command line, and navigate to your project (`cd /path/to/my/project`).
       3. Once you get there, run the following command: `npm install less .` (including the dot).

    b) Via lessphp (Advised against):

       **Add the requirement**

       ```bash
       ./composer.phar require leafo/lessphp
       # When asked for a version, type: "0.*"
       ```

       Then add the following config to your application's module.config.php:

       ```php
       'twitter_bootstrap' => array(
           'use_lessphp' => true,
       ),
       ```

4. Configure the filter to get it working. (This only applies to you if your using node.js and the binary is not in `/usr/bin/node`,
or your node paths are not the default, so you've ignored my advice in step 3a.)

5. Take a look at the [wiki](https://github.com/SpoonX/SxBootstrap/wiki) for examples and other information to get started.
Specifically the part on [how to configure the filter to get it working (bottom of the page)](https://github.com/SpoonX/SxBootstrap/wiki/Configuration-options)

### Okay... Why?
The renderer has a lot of advantages.

- Allows easy customization
- Allows you to extend [(use mixins and variables in your own less files!)](https://github.com/SpoonX/SxBootstrap/wiki/Shared-variables-and-mixins)
- Prevents having to manually manage assets
- Allows toggling components, and plugins to include (minimizing file size by not included what you do not need).
- And more.

## Features
* Simple awesome forms
* **NEW** Optional [Font Awesome integration](https://github.com/SpoonX/SxBootstrap/wiki/Configuration-options#use_font_awesome)
* **NEW** Add load paths
* **NEW** Add custom components
* Customizable (variables, components, plugins)
* Works with AssetManager
* Plenty of ViewHelpers
* Extendable (run your own less files from bootstrap context to share mixins and variables)
* Tested with twitter bootstrap 2.3+ (older versions will probably work, too)
* You can optionally use lessphp (not recommended)

## Usage
Check out the `config/sxbootstrap.local.php.dist` file in _vendor/spoonx/sxbootstrap/config_ for the configuration options, and info.
Also, please check out the [wiki](https://github.com/SpoonX/SxBootstrap/wiki).

## Questions / support
If you're having trouble with the module there are a couple of resources that might be of help.
* The [wiki page](https://github.com/SpoonX/SxBootstrap/wiki), where you'll perhaps find your answer.
* [RWOverdijk at irc.freenode.net #zftalk.dev](http://webchat.freenode.net?channels=zftalk.dev%2Czftalk&uio=MTE9MTAz8d)
* [Issue tracker](https://github.com/SpoonX/SxBootstrap/issues). (Please try to not submit unrelated issues).
* By [mail](mailto:r.w.overdijk@gmail.com?Subject=SxBootstrap%20help)
