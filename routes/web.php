<?php

use Illuminate\Support\Facades\Route;

// use controllers
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\AuthController as UserAuthController;



// admin controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;

use App\Http\Controllers\Admin\StandardController as AdminStandardController;
use App\Http\Controllers\Admin\SubjectController as AdminSubjectController;
use App\Http\Controllers\Admin\ChapterController as AdminChapterController;
use App\Http\Controllers\Admin\TopicController as AdminTopicController;

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
    return view('welcome');
});



Route::get('/login', [UserAuthController::class, 'login'])->name('user-login');
Route::post('/login', [UserAuthController::class, 'loginAction'])->name('user-login-action');
Route::get('/logout', [UserAuthController::class, 'logout'])->name('user-logout');
Route::middleware('auth')->group(function(){
    Route::get('/', [UserDashboardController::class, 'index'])->name('user-dashboard');
    Route::get('/profile', [UserProfileController::class, 'index'])->name('user-profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('user-profile-update');
    Route::get('/change-password', [UserProfileController::class, 'changePassword'])->name('user-change-password');
    Route::post('/change-password', [UserProfileController::class, 'changePasswordAction'])->name('user-change-password-action');
});


Route::prefix('admin')->group(function(){
    Route::get('/login', [AdminAuthController::class, 'login'])->name('admin-login');
    Route::post('/login', [AdminAuthController::class, 'loginAction'])->name('admin-login-action');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin-logout');
    Route::middleware('auth:admin')->group(function(){
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
        Route::get('/profile', [AdminProfileController::class, 'index'])->name('admin-profile');
        Route::post('/profile', [AdminProfileController::class, 'update'])->name('admin-profile-update');
        Route::get('/change-password', [AdminProfileController::class, 'changePassword'])->name('admin-change-password');
        Route::post('/change-password', [AdminProfileController::class, 'changePasswordAction'])->name('admin-change-password-action');
        
        Route::get('/question-create', [AdminQuestionController::class, 'questionCreate'])->name('admin-question-create');
        Route::post('/question-create', [AdminQuestionController::class, 'questionCreateAction'])->name('admin-question-create-action');
        Route::post('/image-upload', [AdminQuestionController::class, 'imageUpload'])->name('admin-question-image-upload');
        Route::get('/question-edit/{question_id}', [AdminQuestionController::class, 'questionEdit'])->name('admin-question-edit');
        Route::post('/question-edit/{question_id}', [AdminQuestionController::class, 'questionEditAction'])->name('admin-question-edit-action');

        Route::get('/question-list', [AdminQuestionController::class, 'index'])->name('admin-question-list');
        // Route::get('/question-list-data', [AdminQuestionController::class, 'data'])->name('admin-question-list-data');
        Route::get('/question-destroy/{id}', [AdminQuestionController::class, 'destroy'])->name('admin-question-destroy');


        Route::prefix('standard')->group(function(){
            Route::get('/', [AdminStandardController::class, 'index'])->name('admin-standard-list');
            Route::post('/', [AdminStandardController::class, 'store'])->name('admin-standard-store');
            // Route::get('/create', [AdminStandardController::class, 'create'])->name('admin-standard-create');
            // Route::post('/create', [AdminStandardController::class, 'store'])->name('admin-standard-store');
            Route::get('/edit/{id}', [AdminStandardController::class, 'edit'])->name('admin-standard-edit');
            Route::post('/edit/{id}', [AdminStandardController::class, 'update'])->name('admin-standard-update');
            Route::get('/destroy/{id}', [AdminStandardController::class, 'destroy'])->name('admin-standard-destroy');
        });

        Route::prefix('subject')->group(function(){
            Route::get('/{standard_id}', [AdminSubjectController::class, 'index'])->name('admin-subject-list');
            Route::post('/{standard_id}', [AdminSubjectController::class, 'store'])->name('admin-subject-store');
            // Route::get('/create', [AdminSubjectController::class, 'create'])->name('admin-subject-create');
            // Route::post('/create', [AdminSubjectController::class, 'store'])->name('admin-subject-store');
            Route::get('/edit/{id}', [AdminSubjectController::class, 'edit'])->name('admin-subject-edit');
            Route::post('/edit/{id}', [AdminSubjectController::class, 'update'])->name('admin-subject-update');
            Route::get('/destroy/{id}', [AdminSubjectController::class, 'destroy'])->name('admin-subject-destroy');
        });

        Route::prefix('chapter')->group(function(){
            Route::get('/{subject_id}', [AdminChapterController::class, 'index'])->name('admin-chapter-list');
            Route::post('/{subject_id}', [AdminChapterController::class, 'store'])->name('admin-chapter-store');
            // Route::get('/create', [AdminChapterController::class, 'create'])->name('admin-chapter-create');
            // Route::post('/create', [AdminChapterController::class, 'store'])->name('admin-chapter-store');
            Route::get('/edit/{id}', [AdminChapterController::class, 'edit'])->name('admin-chapter-edit');
            Route::post('/edit/{id}', [AdminChapterController::class, 'update'])->name('admin-chapter-update');
            Route::get('/destroy/{id}', [AdminChapterController::class, 'destroy'])->name('admin-chapter-destroy');
        });

        Route::prefix('topic')->group(function(){
            Route::get('/{chapter_id}', [AdminTopicController::class, 'index'])->name('admin-topic-list');
            Route::post('/{chapter_id}', [AdminTopicController::class, 'store'])->name('admin-topic-store');
            // Route::get('/create', [AdminTopicController::class, 'create'])->name('admin-topic-create');
            // Route::post('/create', [AdminTopicController::class, 'store'])->name('admin-topic-store');
            Route::get('/edit/{id}', [AdminTopicController::class, 'edit'])->name('admin-topic-edit');
            Route::post('/edit/{id}', [AdminTopicController::class, 'update'])->name('admin-topic-update');
            Route::get('/destroy/{id}', [AdminTopicController::class, 'destroy'])->name('admin-topic-destroy');
        });
    });
});