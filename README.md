
# GiphySearch API

This is a REST api that interacts with GiphyPublicAPI (with a given key) and allows you to search gifs with some variables and also get the information of a particular gif (using the id)

It also allows you to add your favorite gifs to a database in order to get information later. You'll only need the gifId and provide an 'alias' to identify it later


## Run Locally

Clone the project

```bash
  $ git clone https://github.com/lucasmayoni/GiphySearchAPI.git
```

Go to the project directory

```bash
  $ cd GiphySearchAPI
```

Generate env file
```bash
  $ mv .env.example .env
```

Install using Sail (docker wrapper). This following commands allows to install dependencies without having composer installed


```bash
  $ chmod +x configure_composer.sh
  $ ./configure_composer.sh
```

Start the server (and attach as daemon)

```bash
  $ ./vendor/bin/sail up -d
```

Run the migrations

```bash
  $ ./vendor/bin/sail php artisan migrate
```

Generate project KEY

```bash
  $ ./vendor/bin/sail php artisan key:generate
```

Install Passport (to ensure Authentication)
```bash
  $ ./vendor/bin/sail php artisan passport:install
```

To stop the server
```bash
$ ./vendor/bin/sail stop
```

## Running Tests

To run tests, run the following command

```bash
  $ ./vendor/bin/sail php artisan test
```


## Using with Postman

You can download and import this [Postman Collection](https://github.com/lucasmayoni/GiphySearchAPI/blob/master/doc/Giphy_Search_API.postman_collection.json) 

## Documentation

Related documentation and schemas [API Documentation](https://github.com/lucasmayoni/GiphySearchAPI/blob/master/doc/API_Documentation.pdf)
