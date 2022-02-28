<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

Route::get('/', function () {
   dd(request()->user());
});

Route::get('/username', function (Request $request) {

   $user = User::find(1);

   $token = $user->createToken(Str::random(32));

   return [
      'user' => $user,
      'plainTextToken' => $token->plainTextToken
   ];
});
