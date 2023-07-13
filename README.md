## Instruction

### SMS providers. How to check
1. Check app/Http/Controllers/AuthController.php:28
2. When we run UserResetPasswordEvent we trigger all Listeners for this event
3. The list for events you can check in the event service provider:
   app/Providers/EventServiceProvider.php:25
4. I've added possible listeners for the future
5. The list of all providers https://prnt.sc/9MvCz5nO2H7Q
6. We have one Abstract class and realisations

### Auth 
I use php-open-source-saver/jwt-auth as JWT auth package.<br/>

Instruction:
- cp .env.example .env
- docker-compose up --build -d
- docker exec uny_fpm_1 composer install
- php artisan jwt:secret
- php artisan jwt:generate-certs
- docker exec uny_fpm_1 php artisan migrate
- docker exec uny_fpm_1 php artisan db:seed --class=InterestSeeder

And you are ready to use API with Postman.
1. Register - will create a new user in DB.
2. Login - will login current user and return the bearer token, 
which we store in the UNY Environment at the tests step: https://prnt.sc/UhWSmDITQFv_
3. Now you can check if it works with ME (/api/auth/me) request
4. Now you can interact with CRUD for interests
