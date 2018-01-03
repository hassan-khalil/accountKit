<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Facebook Account Kit Implimentation in Laravel 5.4

In this project facebook account kit is implimented. this is only for phone verification. :

to create facebook app go to [Facebook Developer](https://developers.facebook.com/) and create your app.

 


## How to install

get clone of this project create database and add detail in `.env` file 
then run these commands 
```
- composer install
- php artisan migrate
```

after this you need to create facebook app from [Facebook For Developers](https://developers.facebook.com/)
to get facebook account kit app id and secret .

set app id and app secret in `.env` file 

```
ACCOUNTKIT_APP_ID=
ACCOUNTKIT_APP_SECRET=
```

also you need to set `appId` in `public/js/accountKit.js`

```
AccountKit_OnInteractive = function() {
  AccountKit.init({
    appId: 'xxxxxxxxxx',
    state: document.getElementById('_token').value,
    version: 'v1.0'
  });
};
```