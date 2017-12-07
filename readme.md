# ShortURL
## Install

### requirements
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
    user_id = 1 - required
    short ="myName"

```
Response:
```
{
    "origin": "http://google.com",
    "user_id": "1",
    "short": "G43WgUZD6k",
    "updated_at": "2017-12-07 17:56:44",
    "created_at": "2017-12-07 17:56:44",
    "id": 8
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
[
  {
    "id": 5,
    "user_id": 1,
    "origin": "http://asdfasdfsd.com",
    "short": "3HOSgns6hF",
    "count": 1,
    "isShared": 1,
    "created_at": "2017-12-07 16:18:40",
    "updated_at": "2017-12-07 16:30:37",
    "user":{
        "id": 1,
        "name": "Alex",
        "email": "tgnwest@gmail.com",
        "created_at": "2017-12-07 14:42:27",
        "updated_at": "2017-12-07 14:42:27"
    }
  },
  {
    "id": 6,
    "user_id": 1,
    "origin": "http://google.com",
    "short": "sdgdfg",
    "count": 0,
    "isShared": 1,
    "created_at": "2017-12-07 16:46:11",
    "updated_at": "2017-12-07 16:46:11",
    "user":{"id": 1, "name": "Alex", "email": "tgnwest@gmail.com", "created_at": "2017-12-07 14:42:27",…}
  },
]
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
  "data": "Error msg",
  "status": "error"
}
```

#### Get url by ID

DELETE /urls/1

Response:
```
{
  "data": "Url deleted"

}
```
error
```
{
  "data": "Not found"
}
```



## License

The ShortURL is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
