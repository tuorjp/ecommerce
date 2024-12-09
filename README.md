# Ecommerce Project
This is a project made with DCodeMania classes

## To run this project, you need to:

### Install php dependecies
```
composer install
```

### Install js dependecies
```
npm install
```

### Configure .env variables
```
cp .env.example .env
```

### Generate application key
```
php artisan key:generate
```

### Run database migrations
```
php artisan migrate
```

### Build front-end assets
```
npm run dev
```

```
npm run build
```

### Start development server
```
php artisan serve
```

It's also important to configure a server like xampp or a local database like sqlite, and indicate it
in the .env file.