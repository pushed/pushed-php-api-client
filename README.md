# Pushed Official PHP API Client

How to Install
--------------

### Using [Composer](http://getcomposer.org/) (Recommended)

1. Add `"pushed/pushed-php-api-client": "dev-master"`, to your composer.json file at the `"require":` section. ([Find more about composer](http://getcomposer.org/).)


2. Run the `composer update pushed/pushed-php-api-client --no-dev` command in your shell from your root directory.

### Manual Installation

1.  Download and extract the [latest Pushed Official PHP API Client source code](https://github.com/pushed/pushed-php-api-client/archive/master.zip)
    to your PHP project.

2.  Require it in your app using the provided autoloader.

    ```php
    require_once "/path/to/Pushed/Pushed.php";
    ```

Basic Usage
--------------

### App Notification

```php
$params = [
	'app_key' => 'your_app_key',
	'app_secret' => 'your_app_secret',
	'content' => 'Your notification content',
];
		
(new Pushed())->push->toApp($params);
```

### Channel Notification

```php
$params = [
	'app_key' => 'your_app_key',
	'app_secret' => 'your_app_secret',
	'content' => 'Your notification content',
	'target_alias' => 'your_channel_alias',
];

(new Pushed())->push->toChannel($params);
```

### User Notification

```php
$params = [
	'app_key' => 'your_app_key',
	'app_secret' => 'your_app_secret',
	'content' => 'Your notification content',
	'target_alias' => 'destination_user_alias',
	'access_token' => 'destination_user_access_token',
];

(new \Pushed())->push->toUser($params);
```

### Pushed-ID Notification

```php
$params = [
	'app_key' => 'your_app_key',
	'app_secret' => 'your_app_secret',
	'content' => 'Your notification content',
	'target_alias' => 'destination_user_alias',
	'pushed_id' => 'destination_user_pushed_id',	
];

(new \Pushed())->push->toUser($params);
```

About Pushed
--------------

Pushed is your personal notification center with super awesome services. The app allows you to receive notifications when something important happens. Learn more aboute Pushed: [pushed.co](https://pushed.co). If you find a bug or you think you can improve this script feel free to reach us at [dev@pushed.co](dev@pushed.co).

Packagist Site: [https://packagist.org/packages/pushed/pushed-php-api-client](https://packagist.org/packages/pushed/pushed-php-api-client)