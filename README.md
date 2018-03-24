**NOTE**: This repository is not maintained anymore and archived.

phileTemplateSmarty
===================

[Smarty](http://www.smarty.net/docs/en/)(version 3.1.15 included) template parser for [PhileCMS](https://github.com/PhileCMS/Phile)

### 1.1 Installation (composer)
```
php composer.phar require phile/template-smarty:*
```

### 1.2 Installation (Download)

* Install the latest version of [Phile](https://github.com/PhileCMS/Phile)
* Clone this repo into `plugins/phile/templateSmarty`

### 2. Activation

After you have installed the plugin. You need to add the following line to your `config.php` file:

```
$config['plugins']['phile\\templateSmarty'] = array('active' => true);
```

Modify your `config.php` file:

```php
$config['plugins'] = array(
  // disable the Twig template engine
  'phile\\templateTwig' => array('active' => false),
  // enable the Smarty template engine
  'phile\\templateSmarty' => array('active' => true)
);
```

### Disclaimer

Due to the nature of the Page model in Phile, and the fact that Smarty doesn't like objects, there are some slightly different properties available to the `pages` array.

* title
* url
* content
* meta

This covers most of the things that the `pages` array covers in Twig.

### Not a drop in replacement for Twig

If you have not used Smarty before, please read the [docs](http://www.smarty.net/docs/en/) because there are a few differences in syntax, and philosophy, over Twig.

I have included an index.tpl file to show how to recreate the index page from the default theme.

### Why use this over Twig

* You prefer Smarty syntax/style/philosophy
* Smarty has a large community than Twig (Smarty is older)
* Some argue Smarty is faster than Twig
