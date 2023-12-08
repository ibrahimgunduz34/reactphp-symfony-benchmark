# ReactPHP + Symfony 6.4 Sample Application For Benchmark

## Running The Server With Different Options
* PHP-FPM + Nginx:

| For PostgreSQL | For MySQL |
|-------------------|-------------------|
| $ docker compose -f docker/compose-pgsql.yml --env-file=.env-pgsql up --build | docker compose -f docker/compose-mysql.yml --env-file=.env-mysql up --build | 


* PHP-FPM + Opcache + Nginx:

| For PostgreSQL | For MySQL |
|-------------------|-------------------|
| $ docker compose -f docker/compose-opcache-pgsql.yml  --env-file=.env-pgsql up --build | $ docker compose -f docker/compose-opcache-mysql.yml  --env-file=.env-mysql up --build | 

* ReactPHP:

| For PostgreSQL | For MySQL |
|-------------------|-------------------|
| $ docker compose -f docker/compose-reactphp-pgsql.yml  --env-file=.env-pgsql up --build | $ docker compose -f docker/compose-reactphp-mysql.yml  --env-file=.env-mysql up --build | 


* ReactPHP + OpCache:

| For PostgreSQL | For MySQL |
|-------------------|-------------------|
| $ docker compose -f docker/compose-reactphp-opcache-pgsql.yml  --env-file=.env-pgsql up --build | $ docker compose -f docker/compose-reactphp-opcache-mysql.yml  --env-file=.env-mysql up --build | 


* Multiple ReactPHP Instance + Nginx:

| For PostgreSQL | For MySQL |
|-------------------|-------------------|
| $ docker compose -f docker/compose-multiple-reactphp-pgsql.yml  --env-file=.env-pgsql up --build | $ docker compose -f docker/compose-multiple-reactphp-mysql.yml  --env-file=.env-mysql up --build |

## Generating The Test Data

Create the database schema

| For PostgreSQL | For MySQL |
|-------------------|-------------------|
| $ docker compose -f docker/compose-pgsql.yml --env-file=.env-pgsql exec php bin/console  --no-debug --env=dev doctrine:schema:update --force --complete | $ docker compose -f docker/compose-mysql.yml --env-file=.env-mysql exec php bin/console  --no-debug --env=dev doctrine:schema:update --force --complete |


Run the following command that creates ~1M row on the postgreSQL instance

| For PostgreSQL | For MySQL |
|-------------------|-------------------|
| $ docker compose -f docker/compose-pgsql.yml --env-file=.env-pgsql exec php bin/console --no-debug --env=dev doctrine:fixtures:load --purge-with-truncate -q | $ docker compose -f docker/compose-mysql.yml --env-file=.env-mysql exec php bin/console  --no-debug --env=dev doctrine:fixtures:load --purge-with-truncate -q |


Check the benchmark results [here](/benchmark-results.pdf). 