# SxBootstrap 1.6.6
This module is intended for usage with a default directory structure of a
[ZendSkeletonApplication](https://github.com/zendframework/ZendSkeletonApplication/) and depends on the [AssetManager module](http://github.com/RWOverdijk/AssetManager).
It includes Twitter Bootstrap and allows you to build custom versions by overriding the configuration, and supplies some useful view helpers.

## Warning!
Please rename your package to `spoonx/sxbootstrap`. It has been moved there.

## Features
* Fast
* Customizable (variables, components, plugins)
* Works with AssetManager
* Plenty of ViewHelpers
* Extendable (run your own less files from bootstrap context to share mixins and variables)
* Compatible, and tested with twitter bootstrap 2.1, 2.2 and 2.3+
* Can use lessphp

## Installation

1. **Add the requirement to your composer.json file** by either...
    * ... Adding it through the command line,

        ```bash
        ./composer.phar require spoonx/sxbootstrap
        # When asked for a version, type: "1.*"
        ```
    * or, adding it manually to your composer.json file and **then running `./composer.phar install`** to install the dependencies

        ```json
        {
            "require": {
                "spoonx/sxbootstrap": "1.*"
            }
        }
        ```

2. Enable `AssetManager` and `SxBootstrap` in your `application.config.php` file.

3. Install less...

    a) Via NPM/Node.js **(recommended method)**:

       Install npm/node.js. [Instructions](https://github.com/joyent/node/wiki/Installing-Node.js-via-package-manager) can be found here.
       
       To Install lessc, open up your command line, and navigate to your project (`cd /path/to/my/project`).
       Once you get there, run the following command: `npm install less .` (including the dot).
       This will install less in a new directory named node_modules, enabling us to find it.
       If you're stubborn, and wish to install less somewhere else, Check out the wiki at "[how to configure the filter to get it working (bottom of the page)](https://github.com/SpoonX/SxBootstrap/wiki/Configuration-options)"
       
    b) Via lessphp (please only use if absolutely necessary as lessphp is not yet complete):
    
       **Add the requirement to your composer.json file** 
       
       ```json
       {
           "require": {
               "leafo/lessphp": "0.*"
           }
       }
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

## Usage
I'm not going into detail here, as you can find all of the information in the [wiki](https://github.com/SpoonX/SxBootstrap/wiki). But to test if
things are working you can simply call the view helper in your layout (before outputting headscript/headlink!):

```php

<?php $this->sxBootstrap(); ?>

```

Refresh the page and see if it downloaded the required files. Please **realize** that this module
will take up to a second (depending on your server's performance) to load **every time**,
so please enable caching of some sort [(read about it here, the FilePath cache is recommended)](https://github.com/RWOverdijk/AssetManager/wiki/Caching#wiki-filepath).

## Questions / support
If you're having trouble with the module there are a couple of resources that might be of help.
* The [wiki page](https://github.com/SpoonX/SxBootstrap/wiki), where you'll perhaps find your answer.
* [RWOverdijk at irc.freenode.net #zftalk.dev](http://webchat.freenode.net?channels=zftalk.dev%2Czftalk&uio=MTE9MTAz8d)
* [Issue tracker](https://github.com/SpoonX/SxBootstrap/issues). (Please try to not submit unrelated issues).
* By [mail](mailto:r.w.overdijk@gmail.com?Subject=SxBootstrap%20help)

## Todo
There's still a lot of work to be done on this module.
For now it provides really useful functionalities and it's already useful.

* Include other components as view helpers
* Add unit tests
