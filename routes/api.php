<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\MRequestController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VaultController;
use App\Http\Controllers\RefererController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TicketController;
use \Spatie\WebhookClient\Http\Controllers\WebhookController;







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
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/', [AuthController::class, 'allUser']);
    Route::post('/user/update', [AuthController::class, 'updateUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::apiResource('activities', 'ActivityController');
Route::apiResource('messages', 'MessageController');
Route::apiResource('settings', 'SettingsController');
Route::apiResource('cards', 'CardController');
Route::apiResource('banks', 'BankController');
Route::apiResource('transactions', 'TransactionController');
Route::apiResource('referers', 'RefererController');
Route::apiResource('vaults', 'VaultController');
Route::post('vault/fund',[VaultController::class, 'topup']);
Route::post('vault/withdrawal',[VaultController::class, 'withdrawal']);
});
Route::apiResource('categories', CategoryController::class);
Route::apiResource('items', ItemController::class);
Route::apiResource('images', ImagesController::class);
Route::apiResource('reviews', ReviewsController::class);
Route::apiResource('mrequests', MRequestController::class);
Route::apiResource('bookings', BookingController::class);

Route::apiResource('tickets', 'TicketController');

// Route::webhooks('paystack-webhook');
