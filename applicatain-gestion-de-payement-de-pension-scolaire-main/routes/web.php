<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MyController;
use App\Http\Controllers\utilisateur\UserControleur; 
use App\Http\Controllers\CinetPayController;
Route::patch('/cinetpay/{id}/', [CinetPayController::class, 'markAsPaid'])
     ->name('cinetpay.index');
// Route::patch('/cinetpay/', [CinetPayController::class, 'index'])->name('cinetpay.index');
Route::post('/cinetpay', [CinetPayController::class, 'Payment'])->name('cinetpay.payment');
Route::post('/cinetpay/notify', [CinetPayController::class, 'notify_url'])->name('notify_url');
Route::get('/cinetpay/return', [CinetPayController::class, 'return_url'])->name('return_url');

Route::get('/forgot-password', function () {
    return view('forgot_password');
})->name('forgot-password-form');
// routes/web.php


Route::get('/student/{id}', [UserControleur::class, 'showStudent'])
     ->name('student.show')
     ->where('id', '[0-9]+'); // Validation numérique
//Route::get('/student/{id}', [UserControleur::class, 'showStudent'])->name('student.show');
Route::post('/forgot-password', [UserControleur::class, 'forgotPassword'])->name('forgot-password');
Route::get('hom/',[UserControleur::class,'home'])->name('user.home');
Route::post('verifier/',[UserControleur::class,'verifier'])->name('verifier');
Route::get('userlog/',[UserControleur::class,'login'])->name('userlog');
Route::get('/', action: [MyController::class, 'login'])->name('login');
Route::post('/login',[MyController::class, 'connexion'])->name('connexion');
Route::get('/home', [MyController::class, 'home'])->name('home');
Route::get('/add', [MyController::class, 'add'])->name('add');
Route::get('/afficher', [MyController::class, 'afficher'])->name('afficher');
Route::post('/ajout',[MyController::class, 'ajout'])->name('ajout');
Route::delete('/delete-student/{id}', [MyController::class, 'destroy'])->name('delete.student');
Route::get('/edit-student/{id}', [MyController::class, 'edit'])->name('edit-student');
Route::put('/update-student/{id}', [MyController::class, 'update'])->name('update-student');
Route::get('/download-list/{classId}', [MyController::class, 'downloadStudentListPDF'])->name('download-student-list');
Route::post('/logout', [MyController::class, 'logout'])->name('logout');
Route::get('/mode', [MyController::class, 'mode'])->name('mode');
// Route pour gérer la soumission du formulaire et afficher la première page des étudiants
Route::post('/afficheclass', [MyController::class, 'afficheclass'])->name('afficheclass.post');

// Route pour afficher la liste des étudiants (y compris pour la pagination)
Route::get('/afficheclass', [MyController::class, 'afficheclass'])->name('afficheclass.get');