# SxBootstrap beta 1
This module is intended for usage with a default directory structure of a
[ZendSkeletonApplication](https://github.com/zendframework/ZendSkeletonApplication/) and depends on the [AssetManager module](http://github.com/RWOverdijk/AssetManager).
It includes Twitter Bootstrap and allows you to build custom versions by overriding the configuration, and supplies some useful view helpers.

## Dependencies
This module depends on a couple of things. I've listed them here, with links to installation instructions.

* **Composer**. [Instructions](http://getcomposer.org/download/)
* **NPM/NodeJS**. [Instructions](https://github.com/joyent/node/wiki/Installing-Node.js-via-package-manager)
* **less**. Installing through npm is simple. `npm install less`

## Installation

1. **Preparation is required.** Because twitter bootstrap is not available through composer, and composer doesn't allow recursive repositories to be added,
you'll have to add the following repository to your composer.json file:

    ```json
    {
        "repositories": [
            {
                "type": "package",
                "package": {
                    "version": "dev-2.1.2-wip",
                    "name": "twitter/bootstrap",
                    "source": {
                        "url": "https://github.com/twitter/bootstrap.git",
                        "type": "git",
                        "reference": "2.1.2-wip"
                    }
                }
            }
        ]
    }
    ```

    _Note: This works with other versions as well. This module should be compatible with all 2.* versions._

2. Next **add the requirement to your composer.json file** by either...
    * ... Adding it through the command line,

        ```bash
        ./composer.phar require twitter/bootstrap rwoverdijk/sxbootstrap
        # When asked for a version, type:
        #   "dev-2.1.2-wip" for twitter/bootstrap (depending on the version you decided to use)
        #   "0.*" for rwoverdijk/sxbootstrap.
        ```
    * or, adding them manually to your composer.json file and **then running `./composer.phar install`** to install the dependencies

        ```json
        {
            "require": {
                "twitter/bootstrap": "dev-2.1.2-wip",
                "rwoverdijk/sxbootstrap": "0.*"
            }
        }
        ```

3. Enable `AssetManager` and `SxBootstrap` in your `application.config.php` file.

4. Configure the filter to get it working. (This only applies to you if your node.js binary is not in `/usr/bin/node`,
or your node paths are not the default.)

5. Take a look at the [wiki](https://github.com/RWOverdijk/SxBootstrap/wiki) for examples and other information to get started.
Specifically the part on [how to configure the filter to get it working (bottom of the page)](https://github.com/RWOverdijk/SxBootstrap/wiki/Configuration-options)

## Usage
I'm not going into detail here, as you can find all of the information in the [wiki](https://github.com/RWOverdijk/SxBootstrap/wiki). But to test if
things are working you can simply call the view helper in your layout (before outputting headscript/headlink!):

```php

<?php $this->bootstrap(); ?>

```

Refresh the page and see if it downloaded the required files. Please **realize** that this module
will take up to 2 seconds (depending on your server's performance) to load **every time**,
so please enable caching of some sort [(read about it here, the FilePath cache is recommended)](https://github.com/RWOverdijk/AssetManager/wiki/Caching).

## Todo
There's still a lot of work to be done on this module.
For now it provides basic functionality and it's already useful.

* Include other components as view helpers
* Add unit tests
