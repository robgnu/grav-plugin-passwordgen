# Passwordgen Plugin

The **Passwordgen** Plugin is for [Grav CMS](http://github.com/getgrav/grav).  This README.md file should be modified to describe the features, installation, configuration, and general usage of this plugin.

## Description

This plugin offers a simply way to create passwords on your website. You can use it as a service for your clients to create proper passwords (I do so). This plugin respects the privacy of your visitors an does **not** save the created passwords. You should provide a secure TLS connection (https) for your visitors. To create passwords, this plugin uses the *pwgen* tool which is part of the most distributions. If pwgen is not available or allowed to run on server, it falls back to backup function.

## Features

* Simple to use in your pages or in your template.
* Easy to customize with parameters.
* Optional built in CSS for nice looking passwords.

## Setup

* Install the plugin to /your/site/grav/user/plugins/
* Navigate to the Plugin-Settings in your Admin-Panel and enable Passwordgen.
* Navigate to your page where the password(s) should appear.
* Edit the frontmatter of your page and set these options:
 process:
    markdown: true
    twig: true
 cache_enable: false
* Edit the page content and set this code at your preferred position:
 {{ passwordgen(12, true, 5) }}

## Parameters

Example: {{ passwordgen(12, true, 5) }}

* The first parameter sets the lenght of you password. You can set any number (integer). The value in this example is 12.
* The second parameter is a boolean. Set to true to use special-characters in the generated passwords. Set to false to use only alphanumeric characters. In this example we use special characters.
* The third paramater sets the amount of passwords you want to create. 


