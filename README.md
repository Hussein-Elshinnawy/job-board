# job-board

## Installation

Follow these steps to get the project up and running on your local machine.

### 1. Clone the Repository

```bash
git clone https://github.com/Hussein-Elshinnawy/job-board.git
```
or
```bash
git clone git@github.com:Hussein-Elshinnawy/job-board.git/
```
### 2. Adjust the .env file in root to connnect the database

Remove the old database configuration and replace with\
(NOTE replace the values with your actual values) 

DB_CONNECTION=mysql\
DB_HOST=127.0.0.1\
DB_PORT= YOUR_PORT (usually 3306)\
DB_DATABASE= YOURDATABASE_NAME\
DB_USERNAME= YOURDATABASE_USER\
DB_PASSWORD= YOURDATABASE_PASSWORD

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. create the necessary tables.

```bash
php artisan migrate
```

### 5.  Install laravel/ui & ui bootstrap Packages

```bash
composer require laravel/ui
php artisan ui bootstrap --auth
npm install && npm run dev
```
