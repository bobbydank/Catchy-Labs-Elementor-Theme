# CatchyLabs Elementor Theme

A simple, lightweight Wordpress theme built perfect for Elementor. 

TODO: A proper readme.md

## Zipping commands

```
cd wp-content/themes/
zip -r catchylabs-theme-1.0.16.zip catchylabs-theme/ -x "catchylabs-theme/.git/*" -x "*.DS_Store"
zip -r catchylabs-theme-child.zip catchylabs-theme-child/ -x "catchylabs-theme-child/.git/*" -x "*.DS_Store"
```

## How to install

Well, here's how I do it:

```
cd wp-content/themes
```
```
wget https://files.catchylabs.com/themes/catchylabs-theme/catchylabs-theme.zip
```
```
tar -xvf catchylabs-theme.zip
```
```
cd catchylabs-theme/admin
```
```
composer update
```
