<?php

use Illuminate\Support\Facades\Route;

// This handles the root URL "/" of your website
Route::get('/', function () {
    return view('index'); // This will now load resources/views/index.blade.php
});
// When a user goes to /login, Laravel renders resources/views/login.blade.php
Route::get('/login', function () {
    return view('login'); // Do NOT put 'login.blade.php' here, just 'login'
});
Route::get('/register', function () {
    return view('register'); // Do NOT put 'register.blade.php' here, just 'register'
});
// admin page
Route::get('/admin', function () {
    return view('admin');
});
Route::get('/customers', function () {
    return view('customers');
});
Route::get('/expenses', function () {
    return view('expenses');
});
Route::get('/orders', function () {
    return view('orders');
});
Route::get('/settings', function () {
    return view('settings');
});
Route::get('/items', function () {
    return view('items');
});


Route::get('/shop', function () {
    return view('shop');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/cart', function () {
    return view('cart');
});