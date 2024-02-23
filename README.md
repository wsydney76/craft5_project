# Craft 5 Simple Starter

This is a simple Craft CMS starter for use in DDEV with a minimum config, that can be useful as a starting point:

**Demo project only, not intended for production use.**

## Install with DDEV

* Clone this repository and `cd` into it.
* Run `bash setup/install`. This will create a user with the credentials `admin/password`.

## System

* Added modules/_faux to enable autocompletion for some most frequently used variables in twig
* Moves example module to modules/main
* Set system timezone to Europe/Berlin
* Added web assets, /node_modules to .gitignore
* Added some settings to config/general.php
* Added code to prevent password managers like Bitdefender Wallet from falsely inserting credentials into user form
* Added code to prevent creating search index for drafts/revisions
* Added frontend tooling that installs Tailwind CSS and Alpine JS via Vite

## Custom Config

* Added Home section with a simple list of entries
* Added Page section with matrix field
* Added Post section with CKEditor long form content
* Added SiteInfo single.
* Added a matrix field with types text, heading, image, quote, links
* Added a rich text field powered by CKEditor, with nested entries 
* Added volumes/file systems
* Added simple twig templates that follow proven conventions
* Added img macro for advanced image handling, prepared for Imager-X plugin

## Craft 5 experiments

* Colors and icons for entry types (risk of developing eye cancer)
* Reusable 'page' entry type with conditional fields
* Using field instances (like `singleLineText`)
* Cards for assets fields
* Uses a simple matrix content builder for 'page' sections
* * Matrix in Matrix (Links type)
* * Conditional fields and tabs in Images matrix type
* * Entry partials with `render()` method
* CKEditor field 
* * Nested entries
* * Type option (from docs)
* Disabled utilities


