# ReactPHP + Symfony 6.4 Sample Application For Benchmark

## Running The Server With Different Options
* PHP-FPM + Nginx:

```shell
$ docker compose -f compose.yml up --build 
```

* PHP-FPM + Opcache + Nginx:

```shell
$ docker compose -f compose-reactphp-opcache.yml up --build 
```

* ReactPHP:

```shell
$ docker compose -f compose-reactphp.yml up --build 
```

* ReactPHP + OpCache:

```shell
$ docker compose -f compose-reactphp-opcache.yml up --build 
```

* Multiple ReactPHP Instance + Nginx:

```shell
$ docker compose -f compose-multiple-reactphp.yml up --build 
```

## Generating The Test Data

Run the following command that creates ~1M row on the postgreSQL instance
```shell
$ docker compose  exec php bin/console  --no-debug --env=dev doctrine:fixtures:load --purge-with-truncate -q
```
## Applied siege tests for each setup
```shell
siege --verbose --internet --concurrent=25 --no-parser --time=30S  -f urls.txt
siege --verbose --internet --concurrent=50 --no-parser --time=30S  -f urls.txt
siege --verbose --internet --concurrent=100 --no-parser --time=30S  -f urls.txt
siege --verbose --internet --concurrent=200 --no-parser --time=30S  -f urls.txt
```

Check the benchmark results [here](/benchmark-results.pdf). 