<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['App\Http\Controllers\ClientController', 'home'])->name('home');
Route::get('/sobre', ['App\Http\Controllers\ClientController', 'sobre'])->name('sobre');
Route::get('/produtos', ['App\Http\Controllers\ClientController', 'produtos'])->name('produtos');
Route::get('/contato', ['App\Http\Controllers\ClientController', 'contato'])->name('contato');
Route::get('/construcao', ['App\Http\Controllers\ClientController', 'construcao'])->name('construcao');
Route::post('/registercustom', ['App\Http\Controllers\RegisterController', 'store']);
Auth::routes(['verify' => true]);

//email
Route::post('/contato_email', ['App\Http\Controllers\EmailController', 'contatoEmail'])->name('contato_email');

// Route group for admin
Route::group(['prefix' => 'admin',  'middleware' => 'checkAdmin'], function () {
    Route::get('/', ['App\Http\Controllers\AdminController', 'index'])->name('admin_index');
    Route::group(['middleware' => 'isNotRepresentante'], function () {

        Route::get('/administradores', ['App\Http\Controllers\AdminController', 'administradores'])->name('admin_administradores');
        Route::post('/admin/add', ['App\Http\Controllers\AdminController', 'admin_add'])->name('admin_add');
        Route::post('/admin/add/respponsavel', ['App\Http\Controllers\AdminController', 'admin_add_responsavel'])->name('admin_add_responsavel');

        Route::post('/admin/remove', ['App\Http\Controllers\AdminController', 'admin_remove'])->name('admin_remove');
        Route::post('/admin/user/delete', ['App\Http\Controllers\AdminController', 'user_delete'])->name('user_delete');
        Route::post('/admin/user/edit', ['App\Http\Controllers\AdminController', 'user_edit'])->name('user_edit');
        Route::post('/admin/user/search', ['App\Http\Controllers\AdminController', 'user_search'])->name('admin_user_search');

        Route::post('/create_user', ['App\Http\Controllers\RegisterController', 'create_user'])->name('admin_add_user');
    });

    Route::get('/controle', ['App\Http\Controllers\AdminController', 'admin_controle'])->name('admin_controle');
    Route::get('/controle/search', ['App\Http\Controllers\AdminController', 'controle_search'])->name('controle_search');

    Route::get('/configuracao', ['App\Http\Controllers\RegisterController', 'configuracao'])->name('admin_configuracao');
    Route::post('/configuracao/edit', ['App\Http\Controllers\RegisterController', 'configuracao_edit'])->name('admin_configuracao_edit');
});

Route::get('/error', function () {
    if (Auth::user()->level == 1) {
        if (Auth::user()->email_verified_at != '') {
            return redirect()->route('admin_index');
        }
    } else {
        return view('site.error');
    }
})->name('error');
