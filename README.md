# Yu-Gi-Oh Card Scrapper

The Yu-Gi-Oh Card Scrapper is a PHP library that provides functions to retrieve information about Yu-Gi-Oh trading cards. It allows you to fetch a list of card names and retrieve the image of a specific card.

## Installation

You can install the library using Composer. Run the following command in your project directory:

```shell
composer require rzwilliam/td3
````

## Local

```bash
composer install
```

```bash
php vendor/bin/phpstan analyse src --level=max
```

```bash
php vendor/bin/phpunit tests
```

## Usage
### Retrieving a List of Card Names
To retrieve a list of all card names, use the GetAllCardsName function. This function accepts optional parameters to specify the start and end page numbers for fetching the cards. By default, it will retrieve cards from page 1 to page 143.


```php
$api = new Api();
$cardNames = $api->GetAllCardsName();
```


### Retrieving the Image of a Card
To retrieve the image of a specific card, use the GetCardImage function. Pass the name of the card as the parameter, and it will return an array with the card's name and image URL.

```php
$api = new Api();
$cardName = 'Blue-Eyes White Dragon';
$cardDetails = $api->GetCardImage($cardName);
```



