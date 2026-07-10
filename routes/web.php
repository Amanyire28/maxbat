<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\Customer\ChatController as CustomerChat;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\FileSubmissionController as AdminFileController;
use App\Http\Controllers\Admin\ChatController as AdminChat;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\FileSubmissionController;
use App\Http\Controllers\VehicleApiController;
use App\Http\Controllers\Admin\VehicleController;

// ===== PUBLIC ROUTES =====
Route::get('/',         [PageController::class, 'home'])->name('home');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/projects', [PageController::class, 'projects'])->name('projects');
Route::get('/about',    [PageController::class, 'about'])->name('about');
Route::get('/blog',     [PageController::class, 'blog'])->name('blog');
Route::get('/contact',  [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

// File upload
Route::get('/api/upload-services', [FileSubmissionController::class, 'services'])->name('upload.services');
Route::post('/submit-file',        [FileSubmissionController::class, 'store'])->name('upload.store');

// Vehicle API cascading dropdowns
Route::get('/api/vehicles/types',   [VehicleApiController::class, 'types'])->name('api.vehicles.types');
Route::get('/api/vehicles/brands',  [VehicleApiController::class, 'brands'])->name('api.vehicles.brands');
Route::get('/api/vehicles/series',  [VehicleApiController::class, 'series'])->name('api.vehicles.series');
Route::get('/api/vehicles/models',  [VehicleApiController::class, 'models'])->name('api.vehicles.models');
Route::get('/api/vehicles/engines', [VehicleApiController::class, 'engines'])->name('api.vehicles.engines');

// ===== CUSTOMER AUTH =====
Route::get('/register',  [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.post');
Route::get('/login',     [LoginController::class, 'show'])->name('login');
Route::post('/login',    [LoginController::class, 'login'])->name('login.post');
Route::post('/logout',   [LoginController::class, 'logout'])->name('logout');

// ===== CUSTOMER PROTECTED =====
Route::middleware('customer')->prefix('my')->name('customer.')->group(function () {
    Route::get('/dashboard',    [CustomerDashboard::class, 'index'])->name('dashboard');
    Route::post('/chat/send',   [CustomerChat::class, 'send'])->name('chat.send');
    Route::get('/chat/poll',    [CustomerChat::class, 'poll'])->name('chat.poll');
    Route::post('/orders',      [CustomerOrderController::class, 'store'])->name('orders.store');
    Route::get('/orders',       [CustomerOrderController::class, 'index'])->name('orders.index');
});

// ===== ADMIN AUTH =====
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',  [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Chats
        Route::get('/chats',                 [AdminChat::class, 'index'])->name('chats.index');
        Route::get('/chats/{chatRoom}',       [AdminChat::class, 'show'])->name('chats.show');
        Route::post('/chats/{chatRoom}/send', [AdminChat::class, 'send'])->name('chats.send');
        Route::get('/chats/{chatRoom}/poll',  [AdminChat::class, 'poll'])->name('chats.poll');

        // Orders
        Route::get('/orders',                       [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}',                [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status',       [AdminOrderController::class, 'updateStatus'])->name('orders.status');

        // File Submissions
        Route::get('/file-submissions',                           [AdminFileController::class, 'index'])->name('file-submissions.index');
        Route::get('/file-submissions/{fileSubmission}',          [AdminFileController::class, 'show'])->name('file-submissions.show');
        Route::patch('/file-submissions/{fileSubmission}/status', [AdminFileController::class, 'updateStatus'])->name('file-submissions.status');
        Route::get('/file-submissions/{fileSubmission}/download', [AdminFileController::class, 'download'])->name('file-submissions.download');
        Route::delete('/file-submissions/{fileSubmission}',       [AdminFileController::class, 'destroy'])->name('file-submissions.destroy');

        // Inquiries
        Route::get('/inquiries',                    [InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/{inquiry}',          [InquiryController::class, 'show'])->name('inquiries.show');
        Route::patch('/inquiries/{inquiry}/status', [InquiryController::class, 'updateStatus'])->name('inquiries.status');
        Route::delete('/inquiries/{inquiry}',       [InquiryController::class, 'destroy'])->name('inquiries.destroy');

        // Products
        Route::resource('products', ProductController::class)->names('products');

        // Services
        Route::resource('services-manage', ServiceController::class)
            ->parameters(['services-manage' => 'service'])
            ->names('services');

        // Vehicle Database
        Route::get('/vehicles', [VehicleController::class, 'typesIndex'])->name('vehicles.index');
        Route::post('/vehicles/types', [VehicleController::class, 'typeStore'])->name('vehicles.types.store');
        Route::put('/vehicles/types/{vehicleType}', [VehicleController::class, 'typeUpdate'])->name('vehicles.types.update');
        Route::delete('/vehicles/types/{vehicleType}', [VehicleController::class, 'typeDestroy'])->name('vehicles.types.destroy');
        Route::get('/vehicles/types/{vehicleType}/brands', [VehicleController::class, 'brandsIndex'])->name('vehicles.brands.index');
        Route::post('/vehicles/types/{vehicleType}/brands', [VehicleController::class, 'brandStore'])->name('vehicles.brands.store');
        Route::put('/vehicles/types/{vehicleType}/brands/{vehicleBrand}', [VehicleController::class, 'brandUpdate'])->name('vehicles.brands.update');
        Route::delete('/vehicles/types/{vehicleType}/brands/{vehicleBrand}', [VehicleController::class, 'brandDestroy'])->name('vehicles.brands.destroy');
        Route::get('/vehicles/types/{vehicleType}/brands/{vehicleBrand}/series', [VehicleController::class, 'seriesIndex'])->name('vehicles.series.index');
        Route::post('/vehicles/types/{vehicleType}/brands/{vehicleBrand}/series', [VehicleController::class, 'seriesStore'])->name('vehicles.series.store');
        Route::put('/vehicles/types/{vehicleType}/brands/{vehicleBrand}/series/{vehicleSeries}', [VehicleController::class, 'seriesUpdate'])->name('vehicles.series.update');
        Route::delete('/vehicles/types/{vehicleType}/brands/{vehicleBrand}/series/{vehicleSeries}', [VehicleController::class, 'seriesDestroy'])->name('vehicles.series.destroy');
        Route::get('/vehicles/types/{vehicleType}/brands/{vehicleBrand}/series/{vehicleSeries}/models', [VehicleController::class, 'modelsIndex'])->name('vehicles.models.index');
        Route::post('/vehicles/types/{vehicleType}/brands/{vehicleBrand}/series/{vehicleSeries}/models', [VehicleController::class, 'modelStore'])->name('vehicles.models.store');
        Route::put('/vehicles/types/{vehicleType}/brands/{vehicleBrand}/series/{vehicleSeries}/models/{vehicleModel}', [VehicleController::class, 'modelUpdate'])->name('vehicles.models.update');
        Route::delete('/vehicles/types/{vehicleType}/brands/{vehicleBrand}/series/{vehicleSeries}/models/{vehicleModel}', [VehicleController::class, 'modelDestroy'])->name('vehicles.models.destroy');
        Route::get('/vehicles/types/{vehicleType}/brands/{vehicleBrand}/series/{vehicleSeries}/models/{vehicleModel}/engines', [VehicleController::class, 'enginesIndex'])->name('vehicles.engines.index');
        Route::post('/vehicles/types/{vehicleType}/brands/{vehicleBrand}/series/{vehicleSeries}/models/{vehicleModel}/engines', [VehicleController::class, 'engineStore'])->name('vehicles.engines.store');
        Route::put('/vehicles/types/{vehicleType}/brands/{vehicleBrand}/series/{vehicleSeries}/models/{vehicleModel}/engines/{vehicleEngine}', [VehicleController::class, 'engineUpdate'])->name('vehicles.engines.update');
        Route::delete('/vehicles/types/{vehicleType}/brands/{vehicleBrand}/series/{vehicleSeries}/models/{vehicleModel}/engines/{vehicleEngine}', [VehicleController::class, 'engineDestroy'])->name('vehicles.engines.destroy');
    });
});
