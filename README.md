# URL Shortener

This script shortens any URL into a neat and readable format.

| [English](README.md) | [简体中文](README_zh.md) |

## Features
  - Customized short url
  - Generate related QR code
  - Support expiration time
  - Support available time
  - Update after created
  - Pause & Resume
  - Various forms of visit log analytics
  - Able to export your short urls
  - Remove confusing chars (l, I etc.)
  - Use 307 status code to preserve request method
  - Block unhealthy short links


## Requirements
  - [Redis](https://redis.io/)
  - [PHP] (>=5.1) (https://www.php.net/)
  - [Mysql](https://www.mysql.com/downloads/)(>=5.7.8, or MariaDB >=10.2)
  - [Apache](https://www.apache.org/) (with Rewrite module enabled)

## Setup
Want to deploy this service quickly? Try out this [one click setup](https://github.com/QuickDeploy/url-shortener) 
in [QuickDeploy](https://github.com/QuickDeploy/).

  - Install the requirements listed above
  - Clone the latest version of the repository
  ```
  git clone https://github.com/newnius/short-link.git
  cd short-link
  ```
  - Rename `config-sample.inc.php` to `config.inc.php`
  - Customize `config.inc.php` & `static/config.js`
  `./install.php`
  
#### Configuration Options

| Option | Description |
| --- | --- |
| DB_HOST | Mysql host, normally localhost | `define('DB_HOST', 'localhost');`|
| DB_PORT | Mysql port, normally 3306 | `define('DB_PORT', '3306');`|
| DB_NAME | Mysql database name | `define('DB_NAME', 'name');`|
| DB_USER | Mysql user | `define('DB_USER', 'userid');`|
| DB_PASSWORD | Mysql password | `define('DB_PASSWORD', 'password');`|
| REDIS_HOST | Redis host, normally localhost | `define('REDIS_HOST', 'localhost');`|
| REDIS_PORT| Redis listen port, normally 6379 | `define('REDIS_PORT', '6379');`|
| BASE_URL | Base URL of your site | `define('BASE_URL', 'url of my website');`|
| OAUTH_CLIENT_ID | ClientID |
| OAUTH_CLIENT_SECRET | ClientSecret |

If you want to run this service not only on localhost, it is required to update the OAuth properties
`OAUTH_CLIENT_ID` and `OAUTH_CLIENT_SECRET`.

To get your own configuration, login to [QuickAuth](https://quickauth.newnius.com/) and register for an account.

After login, visit `Sites` > `Add` , and add your server ip / domain (without `http://`, `/` or `sub dir`)

Click `View`, you can see the `ClientID` and `ClientSecret`.

The OAuth related functions are located at `auth.php`, `user.logic.php`.
