<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiCtrl;

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

Route::get("/menu/{kategori?}",[ApiCtrl::class,'get_menu']);
Route::get("/menu_fav",[ApiCtrl::class,'menu_fav']);
Route::get("/favorite/{id}/{fav}",[ApiCtrl::class,'update_menu_fav']);
Route::post("/login",[ApiCtrl::class,'login']);
Route::post("/registrasi",[ApiCtrl::class,'registrasi']);
Route::post("/member",[ApiCtrl::class,'member']);
Route::post("/user",[ApiCtrl::class,'user']);
Route::get("/transaksi/{id_member}",[ApiCtrl::class,'get_transaksi']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
