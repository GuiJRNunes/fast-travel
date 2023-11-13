# Fast Travel

This repository contains a simple website for a fictional travel agency company created for the class IT310 System Paradigms taken at the Concordia University of Edmonton.

## Necessary resources to run the project

- [PHP 8.2.4](https://www.php.net/)
- [MySQL](https://www.mysql.com/)
- [Composer](https://getcomposer.org/)
- [Node.js 20.0.0](https://nodejs.org/dist/v20.0.0/)

## Installing the project

- Clone the repository
    
        git clone <repository_link>

- Install the dependencies

        composer install
        npm install

- Set up the configuration file
    
        cp .env.example .env
        php artisan key:generate
    
    - To run without debug information change the key **APP_DEBUG** in the .env file to **false**

- Set up the database

        php artisan migrate

    - To reset the database add **:fresh** after **migrate** 
    
            php artisan migrate:fresh
    
    - To seed the database add **--seed**

            php artisan migrate --seed

    - To create a admin user without seeding the database use the following command

            php artisan create-admin admin@test.com 12345678

- Configure resources

        npm run build

- Start the server
        
        php artisan serve

- Access localhost:8000