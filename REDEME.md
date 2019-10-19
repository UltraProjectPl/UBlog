## Installation
1. Prepare `.env` based on `.env.local`.
2. `cd view && yarn && yarn run start`
3. `docker-compose up`
4. `docker-compose exec -u www-data web composer install`
5. `docker-compose exec -u www-data web bin/console doctrine:migrations:migrate`
