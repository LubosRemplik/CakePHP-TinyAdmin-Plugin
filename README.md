# CakePHP TinyAdmin Plugin

Tiny admin plugin which can be easily installed for simple pages - makes domIDs editable.

## Requirements

- Apache / Nginx
- CakePHP 2.4 (PHP 5.2.8 or greater)
- MySQL 5.x
- [CakePHP Twbs Plugin](https://github.com/LubosRemplik/CakePHP-Twbs-Plugin)

## Install & Config

I assume Git is used for installation (will support composer later)

1. Install/[clone](http://git-scm.com/docs/git-clone) & config your website/app or 
[install](http://book.cakephp.org/2.0/en/installation.html)/[clone](https://github.com/cakephp/cakephp) & config
fresh [CakePHP app/website](http://book.cakephp.org/2.0/en/tutorials-and-examples.html)
1. Add [CakePHP TinyAdmin Plugin](https://github.com/LubosRemplik/CakePHP-TinyAdmin-Plugin) 
submodule into `APP/Plugin/TinyAdmin` and [CakePHP Twbs Plugin](https://github.com/LubosRemplik/CakePHP-Twbs-Plugin) 
into `APP/Plugin/Twbs`, both with recursive option

        git submodule add https://github.com/LubosRemplik/CakePHP-TinyAdmin-Plugin.git app/Plugin/TinyAdmin  
        git submodule add https://github.com/LubosRemplik/CakePHP-Twbs-Plugin.git app/Plugin/Twbs   
        git submodule update --init --recursive  

1. Add TinyAdmin and Twbs plugins into your bootstrap

        CakePlugin::loadAll(array(  
			'TinyAdmin' => array('routes' => true, 'bootstrap' => true),  
			'Twbs'  
        ));  

1. Use `TinyAdmin.Admin` component in your AppController and set up your config.php file

        // in your AppController.php file  
        class AppController extends Controller {  
        	public $components = array(  
        		'TinyAdmin.Admin'  
        	);  
        }  
        ...  
        // in bash  
        cp app/Plugin/TinyAdmin/Config/config.php.default app/Plugin/TinyAdmin/Config/config.php  
        vim app/Plugin/TinyAdmin/Config/config.php  

1. Make sure you have domID in your view/layout file which is set in TinyAdmin config.php file
1. Set user in TinyAdmin config.php file or use console to create new one

		Console/cake TinyAdmin.user create lubos@example.com secretPassword

1. Vision http://example.com/tinyadmin and use your login details (see demo below)
1. Enjoy

## Sample & Demo

To see how this work I created demo on [tinyadmin.lubos.me](http://tinyadmin.lubos.me). You can login on 
[**tinyadmin.lubos.me/tinyadmin**](http://tinyadmin.lubos.me/tinyadmin) with email: **lubos@example.com** and password: **tinyadmin**

After login you can edit [http://tinyadmin.lubos.me/pages/demo1](http://tinyadmin.lubos.me/pages/demo1) or [http://tinyadmin.lubos.me/pages/demo2](http://tinyadmin.lubos.me/pages/demo2)
by clicking inside the yellow box. You can browser revision and edit meta tags from toolbar.

You can install sample by cloning [CakePHP TiyAdmin Plugin sample](https://github.com/LubosRemplik/CakePHP-TinyAdmin-Plugin-sample) and using app/Config/sql/dump.sql file.

## Reporting issues

If you have a problem with TinyAdmin please open an issue on [GitHub](https://github.com/LubosRemplik/CakePHP-TinyAdmin-Plugin/issues).

## Contributing

If you'd like to contribute to TinyAdmin 
you can [fork](https://help.github.com/articles/fork-a-repo)
the project, add features, and send [pull
requests](https://help.github.com/articles/using-pull-requests) or open
[issues](https://github.com/LubosRemplik/CakePHP-TinyAdmin-Plugin/issues).

## Reference

Below is what is used in TinyAdmin plugin

[CakePHP](http://cakephp.org/)  
[CKEditor](http://ckeditor.com/)  
[phpquery](https://code.google.com/p/phpquery/)  
[Twitter bootstrap](getbootstrap.com)  
[Font awesome](fontawesome.io)  
