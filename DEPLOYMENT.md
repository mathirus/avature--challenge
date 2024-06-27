
# Deployment Guide for Jobberwocky

This guide provides steps to deploy the Jobberwocky project, which is built with Laravel 10 and uses SQLite for database storage.

## Prerequisites

1. **Server Requirements:**
    - PHP >= 8.0
    - Composer

2. **Environment Configuration:**
    - Ensure you have the necessary environment variables set up in your `.env` file.

## Steps to Deploy

### 1. Install Dependencies

Ensure you have Composer installed on your server. Then, run:

```sh
composer install
```

### 2. Set Up Environment Variables

Copy the `.env.example` file to `.env` and modify it according to your environment.

```sh
cp .env.example .env
```

Update the following key settings in your `.env` file:

```env
APP_NAME=Jobberwocky
APP_ENV=production
APP_KEY=base64:your-production-app-key
APP_DEBUG=false
APP_URL=http://your-production-url

DB_CONNECTION=sqlite
DB_DATABASE=/path/to/your/database/database.sqlite

MAIL_MAILER=smtp
MAIL_HOST=smtp.your-email-provider.com
MAIL_PORT=587
MAIL_USERNAME=your-email@example.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
```

### 3. Generate Application Key

Run the following command to generate a new application key:

```sh
php artisan key:generate
```

### 4. Set Up Database

Ensure the SQLite database file exists and has the correct permissions:

```sh
touch /path/to/your/database/database.sqlite
chmod 755 /path/to/your/database/database.sqlite
```

Run migrations to set up the database schema:

```sh
php artisan migrate:refresh --seed
```

### 5. Set Up Storage Links

Ensure the storage directories are properly linked:

```sh
php artisan storage:link
```

### 6. Start the Server

Start the Laravel development server:

```sh
php artisan serve
```

### Additional Information

- This project uses SQLite for database storage.
- Refer to the `documentation.md` file for detailed API documentation and endpoint usage.

# Deployment Guide for Jobberwocky

This guide provides steps to deploy the Jobberwocky project, which is built with Laravel 10 and uses SQLite for database storage.

## Prerequisites

1. **Server Requirements:**
    - PHP >= 8.0
    - Composer

2. **Environment Configuration:**
    - Ensure you have the necessary environment variables set up in your `.env` file.

## Steps to Deploy

### 1. Install Dependencies

Ensure you have Composer installed on your server. Then, run:

```sh
composer install
```

### 2. Set Up Environment Variables

Copy the `.env.example` file to `.env` and modify it according to your environment.

```sh
cp .env.example .env
```

Update the following key settings in your `.env` file:

```env
APP_NAME=Jobberwocky
APP_ENV=production
APP_KEY=base64:your-production-app-key
APP_DEBUG=false
APP_URL=http://your-production-url

DB_CONNECTION=sqlite
DB_DATABASE=/path/to/your/database/database.sqlite

MAIL_MAILER=log
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

### 3. Generate Application Key

Run the following command to generate a new application key:

```sh
php artisan key:generate
```

### 4. Set Up Database

Ensure the SQLite database file exists and has the correct permissions. Create a file named `database.sqlite` in the `database` folder:


Run migrations to set up the database schema:

```sh
php artisan migrate:refresh --seed
```

### 5. Set Up Storage Links

Ensure the storage directories are properly linked:

```sh
php artisan storage:link
```

### 6. Start the Server

Start the Laravel development server:

```sh
php artisan serve
```

**Note:** The external job service must be running. You can modify the URL of the external job service in the `.env` file using the `EXTERNAL_JOB_SERVICE_URL` variable:

```sh
EXTERNAL_JOB_SERVICE_URL=http://localhost:8081/jobs
```

### Additional Information

- This project uses SQLite for database storage.
- Refer to the `documentation.md` file for detailed API documentation and endpoint usage.
