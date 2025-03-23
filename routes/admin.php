
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\BroadcastMessageController;
use App\Http\Controllers\Admin\WageController;

Route::middleware(['role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        Route::get('/wages', [WageController::class, 'index'])->name('wages.index');
        Route::post('/wages', [WageController::class, 'store'])->name('wages.store');
        Route::delete('/wages/{id}', [WageController::class, 'destroy'])->name('wages.destroy');
        Route::put('/wages/{wage}', [WageController::class, 'update'])->name('wages.update');

        Route::resource('users', UserController::class);
        Route::resource('currencies', CurrencyController::class);
        Route::resource('broadcast', BroadcastMessageController::class);

        Route::delete('/users/{user}/terminate', [UserController::class, 'terminateSession'])->name('users.terminate');




});

