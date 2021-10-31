#rename .env.example to .env
cd src
cp .env.example .env

#install vendors and setup vue
composer install
npm install
npm run dev

php artisan migrate
php artisan serve