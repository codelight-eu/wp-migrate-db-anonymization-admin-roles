# wp-migrate-db-pro-extended
This super simple mu-plugin extends [WP Migrate DB Pro](https://deliciousbrains.com/wp-migrate-db-pro/) and [WP Migrate DB Anonymization](https://github.com/deliciousbrains/wp-migrate-db-anonymization) plugin.

* prevents anonymizing users with Administrator, Editor, Shop Manager roles or `manage_options` capability during a migration. Never accidentally lose access to your staging or development site again!
* Uses example.org domains for user emails instead of random domains. This way no real existing emails are accidentally generated. 

## Installation
1. Install the mu-plugin:  
`composer require codelight-eu/wp-migrate-db-pro-extended`

2. Install the mu-plugin loader:  
`composer require lkwdwrd/wp-muplugin-loader`

**IMPORTANT!** If the site crashes after installing the mu-plugin loader, run `composer dump-autoload`.

## What is this black magic??
[Read about composer and mu-plugins](https://deliciousbrains.com/wordpress-must-use-plugins-composer/).
