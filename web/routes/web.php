<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\KegiatanController;
use App\Http\Controllers\admin\KonsultanController;
use App\Http\Controllers\admin\MenuActionController;
use App\Http\Controllers\admin\MenuBodyController;
use App\Http\Controllers\admin\MenuHeadController;
use App\Http\Controllers\admin\PaketController;
use App\Http\Controllers\admin\PenyediaController;
use App\Http\Controllers\admin\PptkController;
use App\Http\Controllers\admin\ProfilController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\RoleMenuController;
use App\Http\Controllers\admin\SatuanController;
use App\Http\Controllers\admin\TeknislapAnggotaController;
use App\Http\Controllers\admin\TeknislapController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// begin:: auth
Route::get('/', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/check', [AuthController::class, 'check'])->name('auth.check');
// end:: auth

Route::group(['middleware' => ['session.auth', 'prevent.back.history']], function () {
    // begin:: admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('/profil')->group(function () {
            Route::get('/', [ProfilController::class, 'index'])->name('profil');
            Route::post('/save_picture', [ProfilController::class, 'save_picture'])->name('profil.save_picture');
            Route::post('/save_account', [ProfilController::class, 'save_account'])->name('profil.save_account');
            Route::post('/save_security', [ProfilController::class, 'save_security'])->name('profil.save_security');
        });

        // begin:: menu
        Route::group(['prefix' => 'menu', 'as' => 'menu.'], function () {
            Route::prefix('/head')->group(function () {
                Route::get('/', [MenuHeadController::class, 'index'])->name('head');
                Route::get('/get_data_dt', [MenuHeadController::class, 'get_data_dt'])->name('head.get_data_dt');
                Route::get('/get_all', [MenuHeadController::class, 'get_all'])->name('head.get_all');
                Route::post('/show', [MenuHeadController::class, 'show'])->name('head.show');
                Route::post('/save', [MenuHeadController::class, 'save'])->name('head.save');
                Route::post('/del', [MenuHeadController::class, 'del'])->name('head.del');
            });

            Route::prefix('/body')->group(function () {
                Route::get('/', [MenuBodyController::class, 'index'])->name('body');
                Route::get('/get_data_dt', [MenuBodyController::class, 'get_data_dt'])->name('body.get_data_dt');
                Route::post('/show', [MenuBodyController::class, 'show'])->name('body.show');
                Route::post('/save', [MenuBodyController::class, 'save'])->name('body.save');
                Route::post('/del', [MenuBodyController::class, 'del'])->name('body.del');
            });

            Route::prefix('/action')->group(function () {
                Route::get('/', [MenuActionController::class, 'index'])->name('action');
                Route::get('/get_data_dt', [MenuActionController::class, 'get_data_dt'])->name('action.get_data_dt');
                Route::post('/show', [MenuActionController::class, 'show'])->name('action.show');
                Route::post('/save', [MenuActionController::class, 'save'])->name('action.save');
                Route::post('/del', [MenuActionController::class, 'del'])->name('action.del');
            });
        });
        // end:: menu

        // begin:: role
        Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('role');
            Route::get('/get_data_dt', [RoleController::class, 'get_data_dt'])->name('role.get_data_dt');
            Route::get('/get_all', [RoleController::class, 'get_all'])->name('role.get_all');
            Route::post('/show', [RoleController::class, 'show'])->name('role.show');
            Route::post('/save', [RoleController::class, 'save'])->name('role.save');
            Route::post('/del', [RoleController::class, 'del'])->name('role.del');

            Route::prefix('/menu')->group(function () {
                Route::get('/', [RoleMenuController::class, 'index'])->name('menu');
                Route::get('/create', [RoleMenuController::class, 'create'])->name('menu.create');
                Route::get('/update/{any}', [RoleMenuController::class, 'update'])->name('menu.update');
                Route::get('/get_data_dt', [RoleMenuController::class, 'get_data_dt'])->name('menu.get_data_dt');
                Route::post('/save', [RoleMenuController::class, 'save'])->name('menu.save');
                Route::post('/del', [RoleMenuController::class, 'del'])->name('menu.del');
            });
        });
        // end:: role

        // begin:: users
        Route::prefix('/users')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('users');
            Route::get('/get_data_dt', [UsersController::class, 'get_data_dt'])->name('users.get_data_dt');
            Route::post('/save', [UsersController::class, 'save'])->name('users.save');
            Route::post('/active', [UsersController::class, 'active'])->name('users.active');
            Route::post('/reset_password', [UsersController::class, 'reset_password'])->name('users.reset_password');
        });
        // end:: users

        // begin:: satuan
        Route::controller(SatuanController::class)->prefix('satuan')->as('satuan.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get_all', 'get_all')->name('get_all');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });
        // end:: satuan

        // begin:: penyedia
        Route::controller(PenyediaController::class)->prefix('penyedia')->as('penyedia.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get_all', 'get_all')->name('get_all');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });
        // end:: penyedia

        // begin:: konsultan
        Route::controller(KonsultanController::class)->prefix('konsultan')->as('konsultan.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get_all', 'get_all')->name('get_all');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });
        // end:: konsultan

        // begin:: pptk
        Route::controller(PptkController::class)->prefix('pptk')->as('pptk.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get_all', 'get_all')->name('get_all');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });
        // end:: pptk

        // begin:: teknis lapangan koordinator & anggota
        Route::group(['prefix' => 'teknislap', 'as' => 'teknislap.'], function () {
            Route::controller(TeknislapController::class)->prefix('kordinator')->as('kordinator.')->group(function () {
                Route::get('/', 'index')->name('kordinator');
                Route::get('/detail/{any}', 'detail')->name('detail');
                Route::get('/get_all', 'get_all')->name('get_all');
                Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
                Route::post('/show', 'show')->name('show');
                Route::post('/save', 'save')->name('save');
                Route::post('/del', 'del')->name('del');
            });

            Route::controller(TeknislapAnggotaController::class)->prefix('anggota')->as('anggota.')->group(function () {
                Route::get('/', 'index')->name('anggota');
                Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
                Route::post('/show', 'show')->name('show');
                Route::post('/save', 'save')->name('save');
                Route::post('/del', 'del')->name('del');
            });
        });
        // end:: teknis lapangan koordinator & anggota

        // begin:: kegiatan
        Route::controller(KegiatanController::class)->prefix('kegiatan')->as('kegiatan.')->group(function () {
            Route::get('/', 'index')->name('kegiatan');
            Route::get('/detail/{id}', 'detail')->name('detail');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });
        // end:: kegiatan

        // begin:: paket
        Route::controller(PaketController::class)->prefix('paket')->as('paket.')->group(function () {
            Route::get('/', 'index')->name('paket');
            Route::get('/add/{id}', 'add')->name('add');
            Route::get('/upd/{id}', 'upd')->name('upd');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });
        // end:: paket
    });
    // end:: admin
});
