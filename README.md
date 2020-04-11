# product-crud

Multi language product CRUD in Laravel 7.

## Development installation steps

Requirements: [https://laravel.com/docs/7.x/installation#server-requirements](https://laravel.com/docs/7.x/installation#server-requirements)

### 1. Clone project

```console
git clone https://github.com/bala92x/product-crud.git
```

### 2. Navigate into the project folder

```console
cd product-crud
```

### 3. Install dependencies

```console
composer install
```

### 4. Create a database of your choice

### 5. Configurate environment variables

Create .env file

```console
cp .env.example .env
```

Generate application key

```console
php artisan key:generate
```

The application needs the following environment variables:

```console
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### 6. Migrate the tables and seed the database with mock data

```console
php artisan migrate --seed
```

### 7. Start a development server

```console
php artisan serve
```

## Endpoints

### Products

-   Products index - `GET|HEAD /api/products/` - `Params: page|limit`
-   Product store - `POST /api/products/`
-   Product show - `GET|HEAD /api/products/:id`
-   Product update - `PUT|PATCH /api/products/:id`
-   Product destroy - `DELETE /api/products/:id`

### Images

-   Images index - `GET|HEAD /api/products/` - `Params: page|limit`
-   Image upload - `POST /api/products/` - `Content-Type: multipart/form-data`
-   Image store - `POST /api/products/`
-   Image show - `GET|HEAD /api/products/:id`
-   Image update - `PUT|PATCH /api/products/:id`
-   Image destroy - `DELETE /api/products/:id`

### Other

-   Version - `GET /api`
-   Page not found - `GET /api/404`

## Examples requests and responses

All example requests and responses can be found in the `postman_collection.json` file.

## DB schema

The DB schema plan can be found here: [https://dbdiagram.io/d/5d9c6358ff5115114db505a1](https://dbdiagram.io/d/5d9c6358ff5115114db505a1)

## Feature tests

```console
composer test
```
