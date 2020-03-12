<?php

use Illuminate\Support\Facades\Route;
use Sypo\Delivery\Http\Controllers\ModuleController;

Route::get('delivery', [ModuleController::class, 'index'])->name('admin.modules.delivery');
Route::post('delivery', [ModuleController::class, 'update'])->name('admin.modules.delivery');
