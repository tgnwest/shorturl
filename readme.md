#ShortURL
## Install

###requirements
- PHP >= 7.0.0
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

```
$ git clone https://github.com/tgnwest/shorturl.git
$ composer install
$ php artisan key:gen
$ php artisan migrate
$ chmod -R 777 storage/
$ chmod -R 777 bootstrap/cache/
```


## Features

- Url shortener
- Original url validation
- The user can choose any short url name
- Application count amount of short url usage. 
- Configuration via .env file
- Logging system. All user actions are recorded in the log file storage/logs/laravel.log
-  Application remove origin-short url pair from DB on the 15th day after its creation
Sets how many days to keep links in the database (default 15 days)
```
DAYS_BEFORE_DELETED=15
```
You only need to add the following Cron entry to your server:
```
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

## API for short url creations

Base url - domain.com/api/v1
### Urls

#### Url creation

POST /urls

Request:
```

    origin = "http://google.com" - required
    short ="myName"

```
Response:
```
{

  "user_id": "1",
  "origin": "http://google.com",
  "short": "http://url.com/dfdDFdf",
  "count": 0,
  "created_at": date

}
```
error
```
{
  "data": {
    "origin": [
      "The origin field is required."
    ]
  },
  "status": "error"
}
```

#### Get all urls

GET /urls

Response:
```
{

  "id": 1
  "user_id": 1,
  "origin": "http://google.com",
  "short": "http://url.com/dfdDFdf",
  "count": 0,
  "created_at": date

},
{

  "id": 2
  "user_id": 2,
  "origin": "http://google.com",
  "short": "http://url.com/dfdDFdf",
  "count": 0,
  "created_at": date

}
```
error
```
{
  "data": "Something went wrong",
  "status": "error"
}
```

#### Get url by ID

GET /urls/1

Response:
```
{
  "id": "1",
  "user_id": "1",
  "origin": "http://google.com",
  "short": "http://url.com/dfdDFdf",
  "count": 0,
  "created_at": date

}
```
error
```
{
  "data": "Not found",
  "status": "error"
}
```

#### Get url by ID

DELETE /urls/1

Response:
```
{
  "data": "Url deleted",
  "status": "OK"

}
```
error
```
{
  "data": "Not found",
  "status": "error"
}
```



## License

The ShortURL is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
