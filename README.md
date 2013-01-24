# SxBootstrap 1.1.2
This module is intended for usage with a default directory structure of a
[ZendSkeletonApplication](https://github.com/zendframework/ZendSkeletonApplication/) and depends on the [AssetManager module](http://github.com/RWOverdijk/AssetManager).
It includes Twitter Bootstrap and allows you to build custom versions by overriding the configuration, and supplies some useful view helpers.

## BC-Breaks
All view helpers have been renamed. The new format is `sxbHelper`.

## Installation

1. **add the requirement to your composer.json file** by either...
    * ... Adding it through the command line,

        ```bash
        ./composer.phar require rwoverdijk/sxbootstrap
        # When asked for a version, type: "1.*"
        ```
    * or, adding it manually to your composer.json file and **then running `./composer.phar install`** to install the dependencies

        ```json
        {
            "require": {
                "rwoverdijk/sxbootstrap": "1.*"
            }
        }
        ```

2. Enable `AssetManager` and `SxBootstrap` in your `application.config.php` file.

3. Install NPM/NodeJS. If you've already done this, continue to step 4.
    [Instructions](https://github.com/joyent/node/wiki/Installing-Node.js-via-package-manager) can be found here.

4. Install less.
    Open up your command line, and navigate to your project (`cd /path/to/my/project`).
    Once you get there, run the following command: `npm install less .` (including the dot).
    This will install less in a new directory named node_modules, enabling us to find it.
    If you're stubborn, and wish to install less somewhere else... Well, too bad.
    Okay okay... There's a way for you to point us in the right direction, too.
    Check out the wiki at "[how to configure the filter to get it working (bottom of the page)](https://github.com/RWOverdijk/SxBootstrap/wiki/Configuration-options)"

5. Configure the filter to get it working. (This only applies to you if your node.js binary is not in `/usr/bin/node`,
or your node paths are not the default, so you've ignored my advice in step 4.)

6. Take a look at the [wiki](https://github.com/RWOverdijk/SxBootstrap/wiki) for examples and other information to get started.
Specifically the part on [how to configure the filter to get it working (bottom of the page)](https://github.com/RWOverdijk/SxBootstrap/wiki/Configuration-options)

## Usage
I'm not going into detail here, as you can find all of the information in the [wiki](https://github.com/RWOverdijk/SxBootstrap/wiki). But to test if
things are working you can simply call the view helper in your layout (before outputting headscript/headlink!):

```php

<?php $this->sxBootstrap(); ?>

```

Refresh the page and see if it downloaded the required files. Please **realize** that this module
will take up to a second (depending on your server's performance) to load **every time**,
so please enable caching of some sort [(read about it here, the FilePath cache is recommended)](https://github.com/RWOverdijk/AssetManager/wiki/Caching#wiki-filepath).

## Todo
There's still a lot of work to be done on this module.
For now it provides basic functionality and it's already useful.

* Include other components as view helpers
* Add unit tests
