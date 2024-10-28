<?php

use App\Models\listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

//All Listing
Route::get('/', [ListingController::class, 'index']);


// Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//Store Listings data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');
;

//Show Edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');
;

//Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');
;

//Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//Manage Listings
Route::get('/manage', [ListingController::class, 'manage'])->middleware('auth');


//Single listing with id
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//Create New User
Route::post('/users', [UserController::class, 'store']);

//Logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
;

//Show Login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//Login User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

