#UTECOM Laravel
=========================
<p align="center"><img src="https://www.google.com/url?sa=i&source=images&cd=&cad=rja&uact=8&ved=2ahUKEwijmd3FtPLgAhWOsRQKHaRlCHMQjRx6BAgBEAU&url=https%3A%2F%2Fen.wikipedia.org%2Fwiki%2FLaravel&psig=AOvVaw0YYNXhdkDEnfY6J96SUIAZ&ust=1552129885267926"></p>


## Requirements
- PHP 7.2
- Composer
- Git
- Redis / Redis-php
- Mbstring
- Tokenizer

## Installation

    git clone git@github.com:makremdelly/utecomVoyage.git
    composer install
    create .env file
    php artisan key:generate
    php artisan migrate
    npm install
    npm run watch/dev/production


## Api Installation

    php artisan jwt:secret
    //generate X-API-KEY
    startupact:generate_x_api_key {--s|show : Display the keys instead of modifying files.}

##### Api Documentation
- {api-base-url}/api-documentation

## Coding standards

PHP Guides and code standards:

* [PSR 4 Coding Standards](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md)
* [PSR 2 Coding Style Guide](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
* [PSR 1 Coding Standards](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)
