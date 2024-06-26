<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inventory');
});

Route::post('/products',[Product::class, 'store']);
