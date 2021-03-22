# W1 - PHP : Tweet Academy
Student project for [W@C by Epitech](https://www.webacademie.org/). Promo 2022 Strasbourg

## Install

Close this repos
```
git clone https://github.com/adrimarn/tweetacademy.git
```

Navigate in the folder
```
cd tweetacademy
```

Generate the .env
```shell
cp .env.example .env
```

Install project dependencies
```shell
composer install
```

Database Migrations (config the .env file before)
```shell
php artisan db:create
php artisan migrate
```
Create storage link for avatar picture
```shell
php artisan storage:link
```

Launch web application in localhost
```shell
php artisan serve
```

## Contributor

- Adrien Marion (<adrien.marion@epitech.eu>)
- Faycal Allouache (<faycal.allouache@epitech.eu>)
- Pierre Schaefer (<pierre.schaefer@epitech.eu>)
