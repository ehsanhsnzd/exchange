cp .env.docker .env
docker-compose up -d
docker-compose run --rm --no-deps app composer install
sleep 20s
docker-compose run --rm --no-deps app php dbseed.php
echo app is runnig on localhost:3000
docker-compose run --rm --no-deps app php queue_server.php
