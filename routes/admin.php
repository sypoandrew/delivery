<?php

use Illuminate\Support\Facades\Route;
use Sypo\Delivery\Http\Controllers\ModuleController;
use Sypo\Delivery\Http\Controllers\WarehouseModuleController;

Route::get('delivery', [ModuleController::class, 'index'])->name('admin.modules.delivery');
Route::post('delivery', [ModuleController::class, 'update'])->name('admin.modules.delivery');

Route::get('warehouse', [WarehouseModuleController::class, 'index'])->name('admin.modules.warehouse');
Route::get('warehouse/edit/{id}', [WarehouseModuleController::class, 'edit'])->name('admin.modules.warehouse.edit');
Route::get('warehouse/new', [WarehouseModuleController::class, 'add'])->name('admin.modules.warehouse.new');
Route::post('warehouse/update', [WarehouseModuleController::class, 'update'])->name('admin.modules.warehouse.update');
