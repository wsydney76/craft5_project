# Craft 5 Simple Starter

This is a simple Craft CMS starter for use in DDEV with a minimum config, that can be useful as a starting point:

## Install

* Clone this repository `git clone https://github.com/wsydney76/craft4-ddev-project <dir> && cd <dir>`
* Run `bash setup/install`. This will create a user with the credentials `admin/password`.

## System

* Added modules/_faux to enable autocompletion for some most frequently used variables in twig
* Moves example module to modules/main
* Set system timezone to Europe/Berlin
* Added /web/cpresources, /node_modules to .gitignore
* Added some settings to config/general.php
* Added config/redactor/Custom.json as a safe Redactor config
* Added code to prevent password managers like Bitdefender Wallet from falsely inserting credentials into user form
* Added code to prevent creating search index for drafts/revisions
* Added frontend tooling that installs Tailwind CSS and Alpine JS via Vite
* Added custom css for the control panel

## Custom Config

* Added Home/Page sections
* Added SiteInfo single.
* Added a matrix field with blocktypes text, heading, image, quote
* Added volumes/file systems
* Added simple twig templates that follow proven conventions
* Added img macro for advanced image handling, prepared for Imager-X plugin
