
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Teachers\CourseController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\TransferReportController; // Route لتسجيل الخروج
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
Route::get('/', function () {
    return view('welcome');
});




// لوحة التحكم للمستخدمين المسجلين فقط
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::middleware(['role:student'])->prefix('student')->name('student.')->group(function () {
        Route::get('/friend-request', function () {
            return view('student.friend-request'); // تأكد من أن اسم ملف الـ Blade صحيح
        })->name('friend-request');
    });
    Route::get('/received-transfers', function () {
        return view('livewire.received-transfers');
    });
    // مسارات المدرس
    Route::middleware(['role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
        Route::resource('courses', CourseController::class);
    });
});

/* حماية ضد التلاعب بالروابط
Route::fallback(function () {
    return redirect()->route('dashboard');
});*/
