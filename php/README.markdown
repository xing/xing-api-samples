# PHP example for the XING API

This example uses [HybridAuth](https://github.com/hybridauth/hybridauth)
and [Slim](http://slimframework.com/) to showcase a simple login with XING scenario.

## Documentation

The application is contained in the [index.php](index.php) file.
It's using Slim to configure some routes: `/`, `/login`, `/endpoint` and `/logout`.
Have a look at the source code for further details.

The configuration for HybridAuth is done in the [config.php](app/config.php) file.
You have to paste your consumer key and secret, which you'll get
from the [XING Developer site](https://dev.xing.com/applications),
in that file.

The directory [templates/](templates/) contains the templates that are used
in the [index.php](index.php) file.

## Setup a development environment

### Vagrant (recommended)

You may use [Vagrant](http://www.vagrantup.com/) to automatically
create a virtual machine with all necessary dependencies.

If you haven't used Vagrant before, you'll need to install it's
dependencies manually

* Install [VirtualBox](https://www.virtualbox.org/)
* Install [Vagrant](http://www.vagrantup.com/)

To automatically create the virtual machine, you have to execute 
`vagrant up` in this directory. For example:

    git clone https://github.com/xing/xing-api-samples
    cd xing-api-samples/php/
    vagrant up

Once the machine is setup you can view the results
at [http://localhost:8080/](http://localhost:8080).

Vagrant will automatically connect this directory
to the `/vagrant` directory inside the virtual machine.
You can edit any file directly on your host system.

If you want to connect to the virtual machine to view the log-files,
or change some configurations, you can use `vagrant ssh` to establish
a SSH connection.

Use `vagrant halt` to stop the virtual machine.

### Manual setup

If you don't want to use Vagrant you can setup your own environment.

You'll need to fetch the dependencies using [Composer](http://getcomposer.org/):

    git clone https://github.com/xing/xing-api-samples
    cd xing-api-samples/php/
    curl -sS https://getcomposer.org/installer | php
    php composer.phar install

After that you have to setup Apache (or a similar webserver) to serve
the `index.php` file on port `8080`. You also have to make sure that
requests to `/endpoint`, `/login` and `/logout` will be
served by `index.php`, too. The repository contains a `.htaccess` file
which will do the necessary configuration for Apache.

## Further reading

* [XING API Resources](https://dev.xing.com/docs/resources)
* German blog post: [XING API mit PHP (HybridAuth) abfragen](http://fabian-beiner.de/de/artikel/xing-api-mit-php-hybridauth-abfragen/)
* [HybridAuth documentation](http://hybridauth.sourceforge.net/)
* [Slim Framework documentation](http://slimframework.com/)
