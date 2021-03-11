## CARSinDFW

Execute project first
- clone repository
- cp .env.example .env  
- composer install --optimize-autoloader --no-dev
- php artisan key:generate
- include DB_DATABASE, DB_USERNAME, DB_PASSWORD
- php artisan migrate
- php artisan passport:install
