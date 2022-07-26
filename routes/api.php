<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return 'Bienvenido a mi App de contactos.';
});

// Contacts
Route::group(
    [],
    function () {

        Route::get('/contacts', function () {
            return "GET contacts";
        });

        Route::get('/contacts/{id}', function ($id) {
            return "GET contact by id: " . $id;
        });

        Route::put('/contacts/{id}', function ($id) {
            return "Update contact by id: " . $id;
        });

        Route::post('/contacts', function () {
            return "Create contact";
        });

        Route::delete('/contacts/{id}', function ($id) {
            return "Delete contact by id: " . $id;
        });
    }
);
