Farther Horizon Site Kit
===

Installation
------------------------------

### 1.  Get the ZF2 Skeleton Application working
http://framework.zend.com/manual/2.2/en/user-guide/skeleton-application.html

### 2.  Replace your `module/` directory with a clone of FhSiteKit
```bash
rm -Rf module
git clone https://github.com/alanwagner/FhSiteKit.git  module
```

### 3.  Install databases
```bash
cd module
mysql -uroot -e"create database ndg_pennshape; create database ndg_ngame; create database ndg_igame"
mysql -uroot ndg_pennshape < PennShapeSite/data/pennshape_schema.sql
mysql -uroot ndg_pennshape < PennShapeSite/data/pennshape_fixture.sql
mysql -uroot ndg_ngame <     NgameSite/data/ngame_schema.sql
mysql -uroot ndg_igame <     IgameSite/data/igame_schema.sql
```

### 4.  Modify `index.php`

This will make methods of `FhSiteKit\FhskCore\FhskSite\Core\Site` available via the autoloader even before the modules have been processed.

```diff
// Setup autoloading
require 'init_autoloader.php';

+ $loader->add('FhSiteKit', 'module/FhskCore/src');

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
```

### 5.  Modify `application.config.php`

For in-depth understanding of this step and the next, see ZF2 Advanced Configuration Tricks:

http://framework.zend.com/manual/2.2/en/tutorials/config.advanced.html

```diff
<?php

+ $siteKey = FhSiteKit\FhskCore\FhskSite\Core\Site::getKey();
+ 
+ $modules = array(
+     'Application',
+     'FhSiteKit\FhskCore',
+     'Ndg\NdgSite',
+     'Ndg\NdgPattern',
+     'NdgTemplate',
+ );
+ 
+ switch ($siteKey) {
+     case 'pennshape' :
+         $modules[] = 'Ndg\PennShape\PennShapeSite';
+         break;
+     case 'ngame' :
+         $modules[] = 'Ndg\Ngame\NgameSite';
+         break;
+     case 'igame' :
+         $modules[] = 'Ndg\Igame\IgameSite';
+         break;
+ }
+ 
return array(
    // This should be an array of module namespaces used in the application.
-    'modules' => array('Application'),
+    'modules' => $modules,

    // These are various options for the listeners attached to the ModuleManager
    'module_listener_options' => array(
        'module_paths' => array(
+             'FhSiteKit\FhskCore'  => './module/FhskCore',
+             'Ndg\NdgSite'         => './module/NdgSite',
+             'Ndg\NdgPattern'      => './module/NdgPattern',
+             'Ndg\NdgTemplate'     => './module/NdgTemplate',
+             'Ndg\Igame\IgameSite' => './module/IgameSite',
+             'Ndg\Ngame\NgameSite' => './module/NgameSite',
+             'Ndg\PennShape\PennShapeSite' => './module/PennShapeSite',
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
-            'config/autoload/{,*.}{global,local}.php',
+            sprintf('config/autoload/{,*.}{global,%s,local}.php', $siteKey),
        ),
```

### 6.  Install site-specific application configs

The dist files contain the database configs

```bash
cd module
cp  PennShapeSite/config/pennshape.php.dist  ../config/autoload/pennshape.php
cp  NgameSite/config/ngame.php.dist          ../config/autoload/ngame.php
cp  IgameSite/config/igame.php.dist          ../config/autoload/igame.php
cp  FhskCore/config/local.php.dist           ../config/autoload/local.php
```

You can also clean up `config/autoload/global.php` and `local.php`
```diff
    'db' => array(
        'driver'         => 'Pdo',
-        'dsn'            => 'mysql:dbname=zf2tutorial;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
```
```diff
return array(
-    'db' => array(
-        'username' => 'YOUR USERNAME HERE',
-        'password' => 'YOUR PASSWORD HERE',
-    ),
);
```

### 7.  Create links to web assets
```bash
cd public/css
ln -s ../../module/*/public/css/*

cd public/js
ln -s ../../module/*/public/js/*
```

Testing
-------------------------

http://fhsitekit.local/pennshape/admin/site

```bash
cd module
./bin/phpunit.sh
```

Add phpunit to `composer.json` and run `php composer.phar update` if you need to install phpunit into your project.

```diff
    "require": {
        "php": ">=5.3.3",
-        "zendframework/zendframework": "2.2.*"
+        "zendframework/zendframework": "2.2.*",
+        "phpunit/phpunit": "3.7.*"
    }
}
```

API Doc
-------------------------

http://FhSiteKit.com/apigen
