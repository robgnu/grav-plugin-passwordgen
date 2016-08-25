# Passwordgen Plugin

The **Passwordgen** Plugin is for [Grav CMS](http://github.com/getgrav/grav).

## Description

This plugin offers a simply way to create passwords on your website. You can use it as a service for your clients to create proper passwords (I do so). This plugin respects the privacy of your visitors and does **not** save the created passwords. You should provide a secure TLS connection (https) for your visitors. To create passwords, this plugin uses the *pwgen* tool which is part of the most distributions. If pwgen is not available or allowed to run on server, it falls back to a backup function and creates the passwords by itself.

## Features

* Simple to use in your pages or in your template.
* Easy to customize with parameters.
* Optional built in CSS for nice looking passwords.

## Setup

* Install the plugin to `/your/site/grav/user/plugins/`
* Navigate to the Plugin-Settings in your Admin-Panel and enable Passwordgen.
* Navigate to your page where the password(s) should appear.
* Edit the frontmatter of your page and set these options:
```
process:
  markdown: true
  twig: true
cache_enable: false
```
* Edit the page content and set this code at your preferred position:
 `{{ passwordgen(12, true, 5) }}`
* Visit your Page and you will see your first passwords.

### Custom CSS styles

By default this plugin creates some CSS rules for displaying the passwords. You can disable this in the plugin settings and create your own CSS styles.

## Parameters

Example: `{{ passwordgen(12, true, 5) }}`

* The first parameter sets the length of you password. You can set any integer-number (8-16 is a good choice). The value in this example is 12.
* The second parameter is a boolean. Set it to true to get passwords with special-characters. Set to false to get only alphanumeric passwords. In this example we want special characters.
* The third paramater sets the amount of passwords you want to create.

