<?php

use App\Http\Controllers\UrlManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/short-url',[UrlManager::class, 'createShortUrl'])
    ->name('url.short');
Route::get('/{code}', [UrlManager::class, 'redirectToOriginalUrl'])
    ->name('url.redirect');

