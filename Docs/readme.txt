Hi,

The machine completed in Laravel.

Please check the following details.

Project Code : 

# sign up

How to test :

# Config

Change Db and Mail settings

# Migration

Run this : `php artisan migrate`


# Queue Execution

For testing purpose QUEUE_CONNECTION is in sync mode.

We can change to QUEUE_CONNECTION=database to make the queue function in background.

Run this : `php artisan queue:work`

# To Test the App

Change env.example to .env Change Mailer and DB and Queue Setting
composer install
Create the Schema
php artisan migrate
php artisan serve

Invitee Login Link : 

http://127.0.0.1:8001/invites-token/8Z3VA9Z3BHbljW

We can login using this email and token also  Login :  newmail@gmail.com / 8Z3VA9Z3BHbljW 

