# api 용 ArticleController 추가

-   php artisan make:controller API/PhotoController --api
-   Route::apiResource('articles', ArticleController::class);

# 마이그레이트 후 서버실행

-   ./artisan migrate:refresh --seed && ./artisan serve

# 텔레스코프 설치

-   composer require laravel/telescope
-   php artisan telescope:install
-   php artisan migrate
-   http://localhost:8000/telescope
