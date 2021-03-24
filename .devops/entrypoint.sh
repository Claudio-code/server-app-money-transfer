#!/bin/bash

#On error no such file entrypoint.sh, execute in terminal - dos2unix .docker\entrypoint.sh --env=test
# chmod -R 777 .cli
chown -R www-data:www-data .

composer install

php bin/console server:start

php bin/console doctrine:migrations:migrate --no-interaction latest
