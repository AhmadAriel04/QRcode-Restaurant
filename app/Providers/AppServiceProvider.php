<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Repositories
use App\Services\HomeService;
use App\Services\HomeServiceInterface;

use App\Repositories\MenuRepository;
use App\Repositories\MenuRepositoryInterface;
use App\Services\MenuService;
use App\Services\Interfaces\MenuServiceInterface;

use App\Repositories\CartRepository;
use App\Repositories\CartRepositoryInterface;
use App\Services\CartService;
use App\Services\Interfaces\CartServiceInterface;

use App\Repositories\OrderRepository;
use App\Repositories\OrderRepositoryInterface;
use App\Services\OrderService;
use App\Services\Interfaces\OrderServiceInterface;

use App\Repositories\PaymentRepository;
use App\Repositories\PaymentRepositoryInterface;
use App\Services\PaymentService;
use App\Services\Interfaces\PaymentServiceInterface;

use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Services\CategoryService;
use App\Services\Interfaces\CategoryServiceInterface;

use App\Services\CheckoutService;
use App\Services\Interfaces\CheckoutServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    
    public function register(): void
    {
    //Home
    $this->app->bind(HomeServiceInterface::class, HomeService::class);    

    //Menu
    $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
    $this->app->bind(MenuServiceInterface::class, MenuService::class);

    //Cart
    $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
    $this->app->bind(CartServiceInterface::class, CartService::class);

    //Order
    $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    $this->app->bind(OrderServiceInterface::class, OrderService::class);

    //Payment
    $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
    $this->app->bind(PaymentServiceInterface::class, PaymentService::class);

    //Category
    $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    $this->app->bind(CategoryServiceInterface::class, CategoryService::class);

    //Checkout
    $this->app->bind(CheckoutServiceInterface::class, CheckoutService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
