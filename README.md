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

		Console/cake TinyAdmin.user create lubos@lubos.me secretPassword

1. Vision http://example.com/tinyadmin and use your login details (see demo below)
1. Enjoy

## Sample & Demo

TBC

## Reference

TBC
