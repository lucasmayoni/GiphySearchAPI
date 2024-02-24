
# GiphySearch API

This is a REST api that interacts with GiphyPublicAPI (with a given key) and allows you to search gifs with some variables and also get the information of a particular gif (using the id)

It also allow you to add your favorite gifs to a databse in order to get information later. You'll only need the gifId and provide an 'alias' to identify it later



## Run Locally

Clone the project

```bash
  git clone https://link-to-project
```

Go to the project directory

```bash
  cd my-project
```

Generate env file
```bash
mv .env.example .env
```

Install using docker



```bash
  docker build (install with composer)
```

Start the server

```bash
  ./vendor/bin/sail up
```

Run the migrations

```bash
  ./vendor/bin/sail php artisan migrate
```

Generate project KEY

```bash
  ./vendor/bin/sail php artisan key:generate
```

Install Passport (to ensure Authentication)
```bash
  ./vendor/bin/sail php artisan passport:install
```

## Running Tests

To run tests, run the following command

```bash
  ./vendor/bin/sail php artisan test
```

## Using with Postman

You can download and import this [Postman Collection]({{file name='doc/Giphy_Search_API.postman_collection.json'}}) 

## Documentation

Related documentation and schemas [API Documentation]({{file name='doc/API_Documentation.pdf}})
