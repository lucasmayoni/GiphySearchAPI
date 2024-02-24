
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

Install using docker

```bash
  docker build (install with composer)
```

Start the server

```bash
  docker compose up
```

Run the migrations

```bash
  ./vendor/bin/sail php artisan migrate
```

## Running Tests

To run tests, run the following command

```bash
  ./vendor/bin/sail php artisan test
```

