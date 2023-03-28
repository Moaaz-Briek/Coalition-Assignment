## Installation
1. Clone the repository to the local machine:

        git clone https://github.com/your-username/your-repo.git
2. Install the required dependencies using Composer:

        composer install
3. Create a new MySQL database and update the .env file with your database credentials:

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=your-database-name
        DB_USERNAME=your-database-username
        DB_PASSWORD=your-database-password
4. Run the database migrations to create the necessary tables:

        php artisan migrate
5. Start the development server:
   
        php artisan serve
6. You should now be able to access the application at:
 
       http://localhost:8000.

## Deployment
To deploy the application to a production server, you can follow these steps:
1. Set up a new server with PHP and MySQL installed.
2. Clone the repository to the server:
   
       git clone https://github.com/your-username/your-repo.git
3. Install the required dependencies using Composer:

       composer install --no-dev --optimize-autoloader 
4. Create a new MySQL database and update the <code>.env</code> file with your database credentials.
5. Run the database migrations to create the necessary tables:

       php artisan migrate --force
6. Configure your web server to serve the application from the public directory.
7. Restart your web server.
