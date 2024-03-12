docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)
docker compose up -d
php artisan serve &
php artisan migrate:fresh --seed
npm run dev
