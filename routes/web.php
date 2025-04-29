<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
Route::patch('/orders/{order}/validate', [OrderController::class, 'validateOrder'])->name('orders.validate');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

